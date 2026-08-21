@extends('layouts.app')

@section('title', isset($perusahaan) ? 'Edit Perusahaan' : 'Tambah Perusahaan')

@section('content')
<form method="POST" action="{{ isset($perusahaan) ? route('perusahaan.update', $perusahaan->kode_prs) : route('perusahaan.store') }}">
    @csrf
    @if (isset($perusahaan))
        @method('PUT')
    @endif

    <div class="form-group">
        <label class="form-label">Kode Perusahaan</label>
        <input 
            type="text" 
            class="form-control @error('kode_prs') is-invalid @enderror" 
            name="kode_prs" 
            placeholder="Contoh: PRZ001"
            value="{{ old('kode_prs', $perusahaan->kode_prs ?? '') }}"
            {{ isset($perusahaan) ? 'readonly' : '' }}
        >
        @error('kode_prs')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Nama Perusahaan</label>
        <input 
            type="text" 
            class="form-control @error('nama_prs') is-invalid @enderror" 
            name="nama_prs" 
            placeholder="Masukkan nama perusahaan"
            value="{{ old('nama_prs', $perusahaan->nama_prs ?? '') }}"
        >
        @error('nama_prs')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Email</label>
        <input 
            type="email" 
            class="form-control @error('email') is-invalid @enderror" 
            name="email" 
            placeholder="Masukkan email perusahaan"
            value="{{ old('email', $perusahaan->email ?? '') }}"
        >
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Alamat</label>
        <textarea 
            class="form-control @error('alamat') is-invalid @enderror" 
            name="alamat" 
            placeholder="Masukkan alamat perusahaan"
            rows="4"
        >{{ old('alamat', $perusahaan->alamat ?? '') }}</textarea>
        @error('alamat')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div style="margin-top: 30px;">
        <button type="submit" class="btn btn-primary-custom">
            <i class="fas fa-save"></i> {{ isset($perusahaan) ? 'Perbarui' : 'Simpan' }}
        </button>
        <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary" style="background-color: #6c757d; color: white;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</form>
@endsection
