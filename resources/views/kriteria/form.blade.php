@extends('layouts.app')

@section('title', isset($kriteria) ? 'Edit Kriteria' : 'Tambah Kriteria')

@section('content')
<form method="POST" action="{{ isset($kriteria) ? route('kriteria.update', $kriteria->kode_kriteria) : route('kriteria.store') }}">
    @csrf
    @if (isset($kriteria))
        @method('PUT')
    @endif

    <div class="form-group">
        <label class="form-label">Kode Kriteria</label>
        <input 
            type="text" 
            class="form-control @error('kode_kriteria') is-invalid @enderror" 
            name="kode_kriteria" 
            placeholder="Contoh: K001"
            value="{{ old('kode_kriteria', $kriteria->kode_kriteria ?? '') }}"
            {{ isset($kriteria) ? 'readonly' : '' }}
        >
        @error('kode_kriteria')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Nama Kriteria</label>
        <input 
            type="text" 
            class="form-control @error('nama_kriteria') is-invalid @enderror" 
            name="nama_kriteria" 
            placeholder="Masukkan nama kriteria"
            value="{{ old('nama_kriteria', $kriteria->nama_kriteria ?? '') }}"
        >
        @error('nama_kriteria')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Bobot (0-1)</label>
        <input 
            type="number" 
            step="0.01"
            class="form-control @error('bobot') is-invalid @enderror" 
            name="bobot" 
            placeholder="Masukkan bobot"
            value="{{ old('bobot', $kriteria->bobot ?? '') }}"
            min="0"
            max="1"
        >
        @error('bobot')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label class="form-label">Jenis Kriteria</label>
        <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
            <option value="">Pilih Jenis</option>
            <option value="benefit" {{ old('jenis', $kriteria->jenis ?? '') === 'benefit' ? 'selected' : '' }}>Benefit</option>
            <option value="cost" {{ old('jenis', $kriteria->jenis ?? '') === 'cost' ? 'selected' : '' }}>Cost</option>
        </select>
        @error('jenis')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div style="margin-top: 30px;">
        <button type="submit" class="btn btn-primary-custom">
            <i class="fas fa-save"></i> {{ isset($kriteria) ? 'Perbarui' : 'Simpan' }}
        </button>
        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary" style="background-color: #6c757d; color: white;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</form>
@endsection
