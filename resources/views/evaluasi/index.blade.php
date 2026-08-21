@extends('layouts.app')

@section('title', 'Daftar Evaluasi Perusahaan')

@section('content')
<div class="mb-3">
    <a href="{{ route('evaluasi.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus"></i> Tambah Evaluasi Perusahaan
    </a>
</div>

<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> <strong>Sistem Evaluasi Batch</strong>
    <p class="mb-0 mt-2">Setiap perusahaan dapat dievaluasi untuk semua kriteria dalam satu form. Kolom "Kriteria Terisi" menunjukkan jumlah kriteria yang sudah dievaluasi untuk perusahaan tersebut.</p>
</div>

@if ($perusahaanWithEval->isEmpty())
    <div class="empty-state">
        <i class="fas fa-chart-bar"></i>
        <p>Belum ada data evaluasi</p>
        <p style="font-size: 13px; color: #999; margin: 10px 0;">Pastikan sudah ada data perusahaan dan kriteria sebelum menambah evaluasi</p>
    </div>
@else
    <div class="table-container" style="overflow-x: auto;">
        <table class="table table-hover" style="font-size: 12px;">
            <thead>
                <tr>
                    <th>Nama Perusahaan</th>
                    <!-- Dynamic kolom C1, C2, C3, C4 -->
                    @foreach ($kriteria as $index => $krit)
                        <th title="{{ $krit->nama_kriteria }}">
                            <small>
                                C{{ $index + 1 }}<br>
                                <span style="font-weight: normal; font-size: 10px;">{{ substr($krit->nama_kriteria, 0, 10) }}</span>
                            </small>
                        </th>
                    @endforeach
                    <th style="text-align: center;">Kriteria Terisi</th>
                    <th>Tanggal Update</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perusahaanWithEval as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->nama_prs }}</strong>
                        </td>
                        <!-- Display C1, C2, C3, C4 (nilai dari evaluasi) -->
                        @foreach ($kriteria as $krit)
                            @php
                                $eval = $evaluasiDetail[$item->kode_prs][$krit->kode_kriteria] ?? null;
                            @endphp
                            <td>
                                @if ($eval)
                                    <span class="badge" style="background-color: #28a745; font-size: 11px;">
                                        {{ $eval->nilai }}
                                    </span>
                                @else
                                    <span style="color: #999; font-size: 10px;">-</span>
                                @endif
                            </td>
                        @endforeach
                        <td style="text-align: center;">
                            @php
                                $percentage = ($item->totalKriteria / $totalKriteria) * 100;
                                if ($item->totalKriteria == $totalKriteria) {
                                    $badgeColor = '#28a745'; // green - lengkap
                                } elseif ($item->totalKriteria >= ($totalKriteria * 0.5)) {
                                    $badgeColor = '#ffc107'; // yellow - setengah
                                } else {
                                    $badgeColor = '#dc3545'; // red - kurang
                                }
                            @endphp
                            <span class="badge" style="background-color: {{ $badgeColor }}; padding: 6px 10px; font-size: 11px;">
                                {{ $item->totalKriteria }} / {{ $totalKriteria }}
                            </span>
                            @if ($item->totalKriteria < $totalKriteria)
                                <small class="text-muted d-block mt-1">({{ $totalKriteria - $item->totalKriteria }} kurang)</small>
                            @endif
                        </td>
                        <td>
                            <small>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i') }}</small>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('evaluasi.edit', $item->kode_prs) }}" class="btn btn-warning-custom btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('evaluasi.destroy', $item->kode_prs) }}" style="display: inline;" onsubmit="return confirm('Hapus semua evaluasi untuk perusahaan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-custom btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<style>
    .badge {
        font-weight: 600;
    }
</style>
@endsection
