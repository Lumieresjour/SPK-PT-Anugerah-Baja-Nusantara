@extends('layouts.app')

@section('title', 'Daftar Klasifikasi')

@section('content')
<div class="mb-3">
    <a href="{{ route('klasifikasi.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus"></i> Tambah Klasifikasi
    </a>
</div>

@if ($klasifikasi->isEmpty())
    <div class="empty-state">
        <i class="fas fa-list"></i>
        <p>Belum ada data</p>
    </div>
@else
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kode Klasifikasi</th>
                    <th>Kriteria</th>
                    <th>Nama Klasifikasi</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($klasifikasi as $item)
                    <tr>
                        <td><strong>{{ $item->kode_klasifikasi }}</strong></td>
                        <td>{{ $item->kriteria->nama_kriteria ?? '-' }}</td>
                        <td>{{ $item->nama_klasifikasi }}</td>
                        <td>
                            <span class="badge" style="background-color: #44A340;">{{ $item->nilai }}</span>
                        </td>
                        <td>
                            <a href="{{ route('klasifikasi.edit', $item->kode_klasifikasi) }}" class="btn btn-warning-custom btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('klasifikasi.destroy', $item->kode_klasifikasi) }}" style="display: inline;" onsubmit="return confirm('Hapus data?');">
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
@endsection
