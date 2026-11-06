@extends('layouts.app')

@section('title', 'Kalkulasi & Ranking')

@section('content')
<div class="mb-3">
    <form method="POST" action="{{ route('kalkulasi.calculate') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-primary-custom">
            <i class="fas fa-calculator"></i> Hitung Ranking
        </button>
    </form>
    @if (!$results->isEmpty())
        <a href="{{ route('kalkulasi.pdf') }}" class="btn btn-pdf">
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
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Nama Perusahaan</th>
                    <!-- Dynamic kolom C1, C2, C3, C4 -->
                    @foreach ($kriteria as $index => $krit)
                        <th title="{{ $krit->nama_kriteria }} ({{ $krit->jenis }}, Bobot: {{ $krit->bobot }}%)">
                            <small>
                                C{{ $index + 1 }}<br>
                                <span class="fw-normal text-lowercase">{{ $krit->nama_kriteria }}</span><br>
                                <span class="fw-normal text-lowercase">Bobot: {{ $krit->bobot }}%</span>
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
                            <strong class="fs-5">
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
                                    <div class="lh-sm">
                                        <small>
                                            <span class="fw-semibold">{{ number_format($detail['weighted'], 4) }}</span><br>
                                            <span class="text-muted">
                                                N: {{ number_format($detail['normalized'], 4) }}
                                            </span>
                                        </small>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <span class="badge badge-brand fs-6">
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
    <div class="note">
        <strong>Penjelasan Kolom C1, C2, C3, C4:</strong>
        <ul>
            <li><strong>C (Weighted Score)</strong>: Hasil normalisasi × bobot kriteria</li>
            <li><strong>N (Normalized)</strong>: Nilai ternormalisasi (benefit: nilai/max, cost: min/nilai)</li>
            <li><strong>Skor Akhir</strong>: Jumlah semua C1 + C2 + C3 + C4 + ...</li>
        </ul>
    </div>
@endif
@endsection
