@extends('layouts.app')

@section('title', 'Daftar Kriteria')

@section('content')
<div class="mb-3">
    <a href="{{ route('kriteria.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus"></i> Tambah Kriteria
    </a>
</div>

@if ($kriteria->isEmpty())
    <div class="empty-state">
        <i class="fas fa-bars"></i>
        <p>Belum ada data</p>
    </div>
@else
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kode Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteria as $item)
                    <tr>
                        <td><strong>{{ $item->kode_kriteria }}</strong></td>
                        <td>{{ $item->nama_kriteria }}</td>
                        <td>
                            <span class="badge" style="background-color: #44A340;">{{ $item->bobot }}</span>
                        </td>
                        <td>
                            @if ($item->jenis === 'benefit')
                                <span class="badge bg-success">{{ ucfirst($item->jenis) }}</span>
                            @else
                                <span class="badge bg-warning">{{ ucfirst($item->jenis) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('kriteria.edit', $item->kode_kriteria) }}" class="btn btn-warning-custom btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('kriteria.destroy', $item->kode_kriteria) }}" style="display: inline;" onsubmit="return confirm('Hapus data?');">
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
