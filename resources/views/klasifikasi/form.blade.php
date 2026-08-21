@extends('layouts.app')

@section('title', isset($klasifikasi) ? 'Edit Klasifikasi' : 'Tambah Klasifikasi')

@section('content')
<form method="POST" action="{{ isset($klasifikasi) ? route('klasifikasi.update', $klasifikasi->kode_klasifikasi) : route('klasifikasi.store') }}">
    @csrf
    @if (isset($klasifikasi))
        @method('PUT')
    @endif

    <div class="form-group">
        <label class="form-label">Kode Klasifikasi</label>
        <input 
            type="text" 
            class="form-control @error('kode_klasifikasi') is-invalid @enderror" 
            name="kode_klasifikasi" 
            placeholder="Contoh: KLS001"
            value="{{ old('kode_klasifikasi', $klasifikasi->kode_klasifikasi ?? '') }}"
            {{ isset($klasifikasi) ? 'readonly' : '' }}
        >
        @error('kode_klasifikasi')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Kriteria</label>
        <select class="form-control @error('kode_kriteria') is-invalid @enderror" name="kode_kriteria">
            <option value="">Pilih Kriteria</option>
            @foreach ($kriteria as $item)
                <option value="{{ $item->kode_kriteria }}" {{ old('kode_kriteria', $klasifikasi->kode_kriteria ?? '') === $item->kode_kriteria ? 'selected' : '' }}>
                    {{ $item->nama_kriteria }}
                </option>
            @endforeach
        </select>
        @error('kode_kriteria')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Nama Klasifikasi</label>
        <input 
            type="text" 
            class="form-control @error('nama_klasifikasi') is-invalid @enderror" 
            name="nama_klasifikasi" 
            placeholder="Masukkan nama klasifikasi"
            value="{{ old('nama_klasifikasi', $klasifikasi->nama_klasifikasi ?? '') }}"
        >
        @error('nama_klasifikasi')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Nilai</label>
        <input 
            type="number" 
            class="form-control @error('nilai') is-invalid @enderror" 
            name="nilai" 
            placeholder="Masukkan nilai"
            value="{{ old('nilai', $klasifikasi->nilai ?? '') }}"
        >
        @error('nilai')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div style="margin-top: 30px;">
        <button type="submit" class="btn btn-primary-custom">
            <i class="fas fa-save"></i> {{ isset($klasifikasi) ? 'Perbarui' : 'Simpan' }}
        </button>
        <a href="{{ route('klasifikasi.index') }}" class="btn btn-secondary" style="background-color: #6c757d; color: white;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</form>
@endsection
