@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin-bottom: 32px; }
    .stat {
        display: flex; flex-direction: column; gap: 6px;
        padding: 18px 20px; border: 1px solid var(--line); border-radius: 12px;
        color: var(--ink); text-decoration: none;
        transition: border-color .2s, background-color .2s;
    }
    .stat:hover { border-color: #c7d9c1; background: #f8faf6; color: var(--ink); }
    .stat-label { display: flex; align-items: center; justify-content: space-between; font-size: 14px; color: var(--muted); font-weight: 500; }
    .stat-label i { color: var(--primary); }
    .stat-value { font-size: 36px; font-weight: 700; letter-spacing: -.03em; line-height: 1.1; font-variant-numeric: tabular-nums; }
    .stat-link { font-size: 13px; color: var(--primary-strong); font-weight: 500; }

    .info { display: grid; grid-template-columns: 1.2fr 1fr; gap: 32px; }
    .info h5 { font-size: 18px; font-weight: 600; letter-spacing: -.01em; margin-bottom: 10px; }
    .info p, .info li { color: var(--muted); line-height: 1.65; max-width: 65ch; }
    .info strong { color: var(--ink); font-weight: 600; }
    .steps { counter-reset: step; list-style: none; padding: 0; margin: 0; display: grid; gap: 10px; }
    .steps li { counter-increment: step; display: flex; gap: 12px; }
    .steps li::before {
        content: counter(step); flex: none; width: 26px; height: 26px; border-radius: 8px;
        display: grid; place-items: center; font-size: 13px; font-weight: 600;
        background: var(--primary-soft); color: var(--primary-strong);
    }
    @media (max-width: 900px) { .info { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
@php
    $stats = [
        ['Perusahaan', 'fa-building', \App\Models\Perusahaan::count(), 'perusahaan.index'],
        ['Kriteria', 'fa-bars', \App\Models\Kriteria::count(), 'kriteria.index'],
        ['Klasifikasi', 'fa-list', \App\Models\Klasifikasi::count(), 'klasifikasi.index'],
        ['Evaluasi', 'fa-chart-bar', \App\Models\Evaluasi::count(), 'evaluasi.index'],
    ];
@endphp

<div class="stats">
    @foreach ($stats as [$label, $icon, $count, $route])
        <a href="{{ route($route) }}" class="stat">
            <span class="stat-label">{{ $label }} <i class="fas {{ $icon }}" aria-hidden="true"></i></span>
            <span class="stat-value">{{ $count }}</span>
            <span class="stat-link">Lihat detail <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
        </a>
    @endforeach
</div>

<div class="info">
    <section>
        <h5>Tentang sistem</h5>
        <p><strong>Sistem Penunjang Keputusan (SPK)</strong> dengan metode <strong>SAW (Simple Additive Weighting)</strong> untuk memilih supplier bahan baku baja secara objektif berdasarkan kriteria dan bobot yang ditentukan perusahaan.</p>
        <p>Fitur utama: manajemen perusahaan, kriteria, klasifikasi, dan evaluasi; kalkulasi ranking otomatis; serta export hasil ranking ke PDF.</p>
    </section>
    <section>
        <h5>Cara penggunaan</h5>
        <ol class="steps">
            <li>Masukkan data perusahaan yang akan dievaluasi</li>
            <li>Tentukan kriteria penilaian beserta bobotnya</li>
            <li>Isi klasifikasi untuk kriteria kualitatif</li>
            <li>Lakukan evaluasi perusahaan terhadap setiap kriteria</li>
            <li>Buka Kalkulasi untuk melihat ranking</li>
        </ol>
    </section>
</div>
@endsection
