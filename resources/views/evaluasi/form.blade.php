@extends('layouts.app')

@section('title', isset($kode_prs) ? 'Edit Evaluasi' : 'Tambah Evaluasi')

@section('content')
<form method="POST" action="{{ isset($kode_prs) ? route('evaluasi.update', $kode_prs) : route('evaluasi.store') }}">
    @csrf
    @if (isset($kode_prs))
        @method('PUT')
    @endif

    <div class="form-group mb-4">
        <label class="form-label">Pilih Perusahaan</label>
        <select class="form-control @error('kode_prs') is-invalid @enderror" name="kode_prs" id="kode_prs" {{ isset($kode_prs) ? 'disabled' : '' }} required>
            <option value="">-- Pilih Perusahaan --</option>
            @foreach ($perusahaan as $item)
                <option value="{{ $item->kode_prs }}" {{ old('kode_prs', $kode_prs ?? '') === $item->kode_prs ? 'selected' : '' }}>
                    {{ $item->nama_prs }}
                </option>
            @endforeach
        </select>
        @if (isset($kode_prs))
            <input type="hidden" name="kode_prs" value="{{ $kode_prs }}">
        @endif
        @error('kode_prs')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> <strong>Input Nilai Evaluasi untuk Semua Kriteria</strong>
        <p class="mb-0 mt-2">Isi nilai untuk setiap kriteria. Klik dropdown untuk memilih dari kategori yang tersedia, atau input nilai manual jika tidak ada kategori.</p>
    </div>

    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="width: 25%;">Kriteria</th>
                    <th style="width: 15%;">Bobot</th>
                    <th style="width: 15%;">Jenis</th>
                    <th style="width: 45%;">Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteria as $item)
                    @php
                        $klasifikasi = $klasifikasiByKriteria[$item->kode_kriteria] ?? [];
                        $currentValue = $evaluasiData[$item->kode_kriteria] ?? '';
                    @endphp
                    <tr>
                        <td>
                            <strong>{{ $item->nama_kriteria }}</strong>
                        </td>
                        <td>
                            <span class="badge" style="background-color: #667eea;">{{ $item->bobot }}%</span>
                        </td>
                        <td>
                            @if ($item->jenis === 'benefit')
                                <span class="badge bg-success">Benefit</span>
                            @else
                                <span class="badge bg-warning text-dark">Cost</span>
                            @endif
                        </td>
                        <td>
                            @if ($klasifikasi->count() > 0)
                                <!-- Ada Klasifikasi → Dropdown -->
                                <select name="nilai[{{ $item->kode_kriteria }}]" class="form-control @error('nilai.' . $item->kode_kriteria) is-invalid @enderror" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($klasifikasi as $klas)
                                        <option value="{{ $klas->nilai }}" 
                                            {{ $currentValue == $klas->nilai ? 'selected' : '' }}>
                                            {{ $klas->nama_klasifikasi }} ({{ $klas->nilai }})
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <!-- Tidak Ada Klasifikasi → Input Number -->
                                <input type="int" 
                                       name="nilai[{{ $item->kode_kriteria }}]" 
                                       class="form-control @error('nilai.' . $item->kode_kriteria) is-invalid @enderror"
                                       min="0" 
                                       max="1000" 
                                       step="0.01" 
                                       value="{{ $currentValue }}"
                                       placeholder="0 - 1000"
                                       required>
                            @endif
                            @error('nilai.' . $item->kode_kriteria)
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin-top: 30px;">
        <button type="submit" class="btn btn-primary-custom">
            <i class="fas fa-save"></i> {{ isset($kode_prs) ? 'Perbarui' : 'Simpan' }} Evaluasi
        </button>
        <a href="{{ route('evaluasi.index') }}" class="btn btn-secondary" style="background-color: #6c757d; color: white;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</form>

<style>
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    table.table {
        margin-bottom: 0;
    }
    
    .form-control {
        font-size: 14px;
    }
</style>
@endsection
