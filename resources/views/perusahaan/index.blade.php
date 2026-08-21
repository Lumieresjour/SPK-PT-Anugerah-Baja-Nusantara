@extends('layouts.app')

@section('title', 'Daftar Perusahaan')

@section('content')
<div class="mb-3">
    <a href="{{ route('perusahaan.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus"></i> Tambah Perusahaan
    </a>
</div>

@if ($perusahaan->isEmpty())
    <div class="empty-state">
        <i class="fas fa-building"></i>
        <p>Belum ada data</p>
    </div>
@else
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kode Perusahaan</th>
                    <th>Nama Perusahaan</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perusahaan as $item)
                    <tr>
                        <td><strong>{{ $item->kode_prs }}</strong></td>
                        <td>{{ $item->nama_prs }}</td>
                        <td>{{ $item->email ?? '-' }}</td>
                        <td>{{ Str::limit($item->alamat ?? '-', 30) }}</td>
                        <td>
                            <a href="{{ route('perusahaan.edit', $item->kode_prs) }}" class="btn btn-warning-custom btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('perusahaan.destroy', $item->kode_prs) }}" style="display: inline;" onsubmit="return confirm('Hapus data?');">
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
