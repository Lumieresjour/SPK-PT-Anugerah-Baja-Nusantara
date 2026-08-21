@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card" style="border-left: 4px solid #44A340;">
            <div class="card-body text-center">
                <i class="fas fa-building" style="font-size: 32px; color: #44A340;"></i>
                <h5 class="card-title mt-3">Perusahaan</h5>
                <p class="card-text display-6" style="color: #44A340;">
                    {{ \App\Models\Perusahaan::count() }}
                </p>
                <a href="{{ route('perusahaan.index') }}" class="btn btn-primary-custom btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card" style="border-left: 4px solid #44A340;">
            <div class="card-body text-center">
                <i class="fas fa-bars" style="font-size: 32px; color: #44A340;"></i>
                <h5 class="card-title mt-3">Kriteria</h5>
                <p class="card-text display-6" style="color: #44A340;">
                    {{ \App\Models\Kriteria::count() }}
                </p>
                <a href="{{ route('kriteria.index') }}" class="btn btn-primary-custom btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card" style="border-left: 4px solid #44A340;">
            <div class="card-body text-center">
                <i class="fas fa-list" style="font-size: 32px; color: #44A340;"></i>
                <h5 class="card-title mt-3">Klasifikasi</h5>
                <p class="card-text display-6" style="color: #44A340;">
                    {{ \App\Models\Klasifikasi::count() }}
                </p>
                <a href="{{ route('klasifikasi.index') }}" class="btn btn-primary-custom btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card" style="border-left: 4px solid #44A340;">
            <div class="card-body text-center">
                <i class="fas fa-chart-bar" style="font-size: 32px; color: #44A340;"></i>
                <h5 class="card-title mt-3">Evaluasi</h5>
                <p class="card-text display-6" style="color: #44A340;">
                    {{ \App\Models\Evaluasi::count() }}
                </p>
                <a href="{{ route('evaluasi.index') }}" class="btn btn-primary-custom btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background: linear-gradient(135deg, #44A340 100%, #D6E685 0%); color: white;">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle"></i> Informasi Sistem
                </h5>
            </div>
            <div class="card-body">
                <p><strong>Sistem Penunjang Keputusan (SPK)</strong> dengan metode <strong>SAW (Simple Additive Weighting)</strong></p>
                <p>Sistem ini dirancang untuk membantu dalam pengambilan keputusan dengan cara:</p>
                <ul>
                    <li>Memasukkan data perusahaan yang akan dievaluasi</li>
                    <li>Menentukan kriteria penilaian dengan bobot masing-masing</li>
                    <li>Mengelompokkan kriteria berdasarkan klasifikasi (untuk kriteria kualitatif)</li>
                    <li>Melakukan evaluasi perusahaan terhadap setiap kriteria</li>
                    <li>Sistem akan otomatis menghitung dan memberikan ranking</li>
                </ul>
                <p><strong>Fitur Utama:</strong></p>
                <ul>
                    <li>Manajemen Perusahaan, Kriteria, Klasifikasi, dan Evaluasi</li>
                    <li>Kalkulasi otomatis dengan metode SAW</li>
                    <li>Export hasil ranking ke PDF</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
