<?php

namespace Database\Seeders;

use App\Models\Klasifikasi;
use Illuminate\Database\Seeder;

class KlasifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $klasifikasi = [
            [
                'kode_klasifikasi' => 'KLS001',
                'kode_kriteria' => 'C1',
                'nama_klasifikasi' => 'Sertifikat lengkap dan terakreditasi',
                'nilai' => 100,
            ],
            [
                'kode_klasifikasi' => 'KLS002',
                'kode_kriteria' => 'C1',
                'nama_klasifikasi' => 'Sertifikat lengkap',
                'nilai' => 75,
            ],
            [
                'kode_klasifikasi' => 'KLS003',
                'kode_kriteria' => 'C1',
                'nama_klasifikasi' => 'Sertifikat sebagian',
                'nilai' => 50,
            ],
            [
                'kode_klasifikasi' => 'KLS004',
                'kode_kriteria' => 'C1',
                'nama_klasifikasi' => 'Belum memiliki sertifikat',
                'nilai' => 25,
            ],
            [
                'kode_klasifikasi' => 'KLS005',
                'kode_kriteria' => 'C4',
                'nama_klasifikasi' => 'Kapasitas di atas 10.000 ton/bulan',
                'nilai' => 100,
            ],
            [
                'kode_klasifikasi' => 'KLS006',
                'kode_kriteria' => 'C4',
                'nama_klasifikasi' => 'Kapasitas 7.501 - 10.000 ton/bulan',
                'nilai' => 75,
            ],
            [
                'kode_klasifikasi' => 'KLS007',
                'kode_kriteria' => 'C4',
                'nama_klasifikasi' => 'Kapasitas 5.001 - 7.500 ton/bulan',
                'nilai' => 50,
            ],
            [
                'kode_klasifikasi' => 'KLS008',
                'kode_kriteria' => 'C4',
                'nama_klasifikasi' => 'Kapasitas sampai 5.000 ton/bulan',
                'nilai' => 25,
            ],
        ];

        foreach ($klasifikasi as $data) {
            Klasifikasi::updateOrCreate(
                ['kode_klasifikasi' => $data['kode_klasifikasi']],
                $data
            );
        }
    }
}
