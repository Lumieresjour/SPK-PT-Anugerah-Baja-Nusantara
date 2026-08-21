@extends('layouts.app')

@section('title', 'Kalkulasi & Ranking')

@section('content')
<div class="mb-3">
    <form method="POST" action="{{ route('kalkulasi.calculate') }}" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-primary-custom">
            <i class="fas fa-calculator"></i> Hitung Ranking
        </button>
    </form>
    @if (!$results->isEmpty())
        <a href="{{ route('kalkulasi.pdf') }}" class="btn" style="background-color: #dc3545; color: white;">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
    @endif
</div>

@if ($results->isEmpty())
    <div class="empty-state">
        <i class="fas fa-calculator"></i>
        <p>Klik Hitung, jika tidak muncul, silahkan tambah data pada laman Perusahaan, Kriteria dan Evaluasi</p>
    </div>
@else
    <div class="table-container" style="overflow-x: auto;">
        <table class="table table-hover" style="font-size: 12px;">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Nama Perusahaan</th>
                    <!-- Dynamic kolom C1, C2, C3, C4 -->
                    @foreach ($kriteria as $index => $krit)
                        <th title="{{ $krit->nama_kriteria }} ({{ $krit->jenis }}, Bobot: {{ $krit->bobot }}%)">
                            <small>
                                C{{ $index + 1 }}<br>
                                <span style="font-weight: normal; font-size: 10px;">{{ $krit->nama_kriteria }}</span><br>
                                <span style="font-weight: normal; font-size: 10px;">Bobot: {{ $krit->bobot }}%</span>
                            </small>
                        </th>
                    @endforeach
                    <th>Skor Akhir</th>
                    <th>Tanggal Hitung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $item)
                    <tr>
                        <td>
                            <strong style="font-size: 16px;">
                                {{ $item->ranking }}
                            </strong>
                        </td>
                        <td>{{ $item->perusahaan->nama_prs ?? '-' }}</td>
                        <!-- Display C1, C2, C3, C4 (normalized × bobot) -->
                        @foreach ($kriteria as $krit)
                            @php
                                $detail = $item->detail_kriteria[$krit->kode_kriteria] ?? null;
                            @endphp
                            <td>
                                @if ($detail)
                                    <div style="line-height: 1.2;">
                                        <small>
                                            <span style="font-weight: bold;">{{ number_format($detail['weighted'], 4) }}</span><br>
                                            <span style="font-size: 9px; color: #666;">
                                                N: {{ number_format($detail['normalized'], 4) }}
                                            </span>
                                        </small>
                                    </div>
                                @else
                                    <span style="color: #999;">-</span>
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <span class="badge" style="background-color: #44A340; font-size: 12px;">
                                {{ number_format($item->skor_akhir, 4) }}
                            </span>
                        </td>
                        <td><small>{{ $item->tanggal_hitung->format('d-m-Y H:i') }}</small></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Penjelasan Kolom -->
    <div style="margin-top: 20px; padding: 15px; background-color: #f0f8ff; border-left: 4px solid #2196F3; border-radius: 4px;">
        <strong>Penjelasan Kolom C1, C2, C3, C4:</strong>
        <ul style="margin: 10px 0 0 20px; font-size: 12px;">
            <li><strong>C (Weighted Score)</strong>: Hasil normalisasi × bobot kriteria</li>
            <li><strong>N (Normalized)</strong>: Nilai ternormalisasi (benefit: nilai/max, cost: min/nilai)</li>
            <li><strong>Skor Akhir</strong>: Jumlah semua C1 + C2 + C3 + C4 + ...</li>
        </ul>
    </div>
@endif
@endsection
