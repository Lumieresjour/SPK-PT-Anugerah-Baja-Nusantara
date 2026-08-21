<?php

namespace App\Services;

use App\Models\Evaluasi;
use App\Models\Kalkulasi;
use App\Models\Kriteria;
use App\Models\Perusahaan;

class SAWService
{
    /**
     * Hitung ranking dengan metode SAW
     */
    public function calculateRanking($idAdmin)
    {
        // Hapus kalkulasi lama
        Kalkulasi::truncate();

        $perusahaan = Perusahaan::all();
        $kriteria = Kriteria::all();

        if ($perusahaan->isEmpty() || $kriteria->isEmpty()) {
            return [];
        }

        $results = [];

        foreach ($perusahaan as $prs) {
            $totalScore = 0;
            $detailKriteria = []; // Store C1, C2, C3, C4 values

            foreach ($kriteria as $krit) {
                // Ambil nilai evaluasi
                $evaluasi = Evaluasi::where('kode_prs', $prs->kode_prs)
                                    ->where('kode_kriteria', $krit->kode_kriteria)
                                    ->first();

                if (!$evaluasi) {
                    $detailKriteria[$krit->kode_kriteria] = [
                        'nilai' => 0,
                        'normalized' => 0,
                        'weighted' => 0,
                    ];
                    continue;
                }

                $nilai = $evaluasi->nilai;

                // Normalisasi berdasarkan jenis kriteria
                if ($krit->jenis === 'benefit') {
                    // Untuk benefit: nilai / max(nilai)
                    $maxValue = Evaluasi::where('kode_kriteria', $krit->kode_kriteria)
                                       ->max('nilai');
                    $normalized = $maxValue > 0 ? $nilai / $maxValue : 0;
                } else {
                    // Untuk cost: min(nilai) / nilai
                    $minValue = Evaluasi::where('kode_kriteria', $krit->kode_kriteria)
                                       ->min('nilai');
                    $normalized = $nilai > 0 ? $minValue / $nilai : 0;
                }

                // Kalikan dengan bobot
                $weighted = $normalized * $krit->bobot;
                $totalScore += $weighted;

                // Store detail untuk setiap kriteria
                $detailKriteria[$krit->kode_kriteria] = [
                    'nilai' => $nilai,
                    'normalized' => $normalized,
                    'weighted' => $weighted,
                ];
            }

            $results[] = [
                'kode_prs' => $prs->kode_prs,
                'nama_prs' => $prs->nama_prs,
                'skor_akhir' => $totalScore,
                'detail_kriteria' => $detailKriteria, // Detail C1, C2, C3, C4
            ];
        }

        // Urutkan berdasarkan skor (descending)
        usort($results, function ($a, $b) {
            return $b['skor_akhir'] <=> $a['skor_akhir'];
        });

        // Simpan ke database dengan ranking
        foreach ($results as $ranking => $result) {
            Kalkulasi::create([
                'id_admin' => $idAdmin,
                'kode_prs' => $result['kode_prs'],
                'skor_akhir' => $result['skor_akhir'],
                'ranking' => $ranking + 1,
            ]);
        }

        return $results;
    }

    /**
     * Ambil hasil kalkulasi dari database dengan detail per kriteria
     */
    public function getResults($idAdmin = Null)
    {
        
        $query = Kalkulasi::with('perusahaan');
    
        if ($idAdmin) {
            $query->where('id_admin', $idAdmin); }

        
        $kalkulasi = Kalkulasi::with('perusahaan')
                             ->orderBy('ranking', 'asc')
                             ->get();

        // Enrichment: tambah detail per kriteria
        $kriteria = Kriteria::all();
        
        foreach ($kalkulasi as $item) {
            $detailKriteria = [];
            
            foreach ($kriteria as $krit) {
                $evaluasi = Evaluasi::where('kode_prs', $item->kode_prs)
                                    ->where('kode_kriteria', $krit->kode_kriteria)
                                    ->first();

                if (!$evaluasi) {
                    $detailKriteria[$krit->kode_kriteria] = [
                        'nilai' => 0,
                        'normalized' => 0,
                        'weighted' => 0,
                        'nama_kriteria' => $krit->nama_kriteria,
                    ];
                    continue;
                }

                $nilai = $evaluasi->nilai;

                // Normalisasi
                if ($krit->jenis === 'benefit') {
                    $maxValue = Evaluasi::where('kode_kriteria', $krit->kode_kriteria)
                                       ->max('nilai');
                    $normalized = $maxValue > 0 ? $nilai / $maxValue : 0;
                } else {
                    $minValue = Evaluasi::where('kode_kriteria', $krit->kode_kriteria)
                                       ->min('nilai');
                    $normalized = $nilai > 0 ? $minValue / $nilai : 0;
                }

                $weighted = $normalized * $krit->bobot;

                $detailKriteria[$krit->kode_kriteria] = [
                    'nilai' => $nilai,
                    'normalized' => $normalized,
                    'weighted' => $weighted,
                    'nama_kriteria' => $krit->nama_kriteria,
                ];
            }
            
            $item->detail_kriteria = $detailKriteria;
        }

        return $kalkulasi;
    }
}
