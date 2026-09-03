<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Sertifikat Kelayakan / Mutu',
                'bobot' => 0.50,
                'jenis' => 'benefit',
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Harga Penawaran',
                'bobot' => 0.20,
                'jenis' => 'cost',
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Waktu Pengiriman (Lead Time)',
                'bobot' => 0.20,
                'jenis' => 'cost',
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Kapasitas Produksi',
                'bobot' => 0.10,
                'jenis' => 'benefit',
            ],
        ];

        foreach ($kriteria as $data) {
            Kriteria::updateOrCreate(
                ['kode_kriteria' => $data['kode_kriteria']],
                $data
            );
        }
    }
}
