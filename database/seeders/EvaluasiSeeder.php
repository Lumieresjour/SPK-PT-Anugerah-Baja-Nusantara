<?php

namespace Database\Seeders;

use App\Models\Evaluasi;
use Illuminate\Database\Seeder;

class EvaluasiSeeder extends Seeder
{
    public function run(): void
    {
        $evaluasi = [
            'PRS001' => ['C1' => 100, 'C2' => 480, 'C3' => 7, 'C4' => 100],
            'PRS002' => ['C1' => 75, 'C2' => 455, 'C3' => 10, 'C4' => 75],
            'PRS003' => ['C1' => 100, 'C2' => 510, 'C3' => 8, 'C4' => 100],
            'PRS004' => ['C1' => 50, 'C2' => 435, 'C3' => 14, 'C4' => 50],
            'PRS005' => ['C1' => 75, 'C2' => 465, 'C3' => 9, 'C4' => 75],
        ];

        foreach ($evaluasi as $kodePerusahaan => $nilaiKriteria) {
            foreach ($nilaiKriteria as $kodeKriteria => $nilai) {
                Evaluasi::updateOrCreate(
                    [
                        'kode_prs' => $kodePerusahaan,
                        'kode_kriteria' => $kodeKriteria,
                    ],
                    ['nilai' => $nilai]
                );
            }
        }
    }
}
