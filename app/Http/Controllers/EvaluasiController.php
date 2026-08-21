<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\Perusahaan;
use App\Models\Kriteria;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluasiController extends Controller
{
    public function index()
    {
        // Ambil semua kriteria
        $kriteria = Kriteria::all();
        $totalKriteria = $kriteria->count();

        // Group evaluasi by perusahaan dengan detail
        $perusahaanWithEval = DB::table('evaluasi')
            ->select(
                'evaluasi.kode_prs',
                DB::raw('COUNT(DISTINCT evaluasi.kode_kriteria) as totalKriteria'),
                DB::raw('MAX(evaluasi.updated_at) as updated_at'),
                'perusahaan.nama_prs'
            )
            ->join('perusahaan', 'evaluasi.kode_prs', '=', 'perusahaan.kode_prs')
            ->groupBy('evaluasi.kode_prs', 'perusahaan.nama_prs')
            ->orderByDesc('evaluasi.updated_at')
            ->get();

        // Enrichment: Ambil detail nilai per kriteria untuk setiap perusahaan
        $evaluasiDetail = [];
        foreach ($perusahaanWithEval as $prs) {
            $evaluasiDetail[$prs->kode_prs] = Evaluasi::where('kode_prs', $prs->kode_prs)
                ->with('kriteria')
                ->get()
                ->keyBy('kode_kriteria');
        }

        return view('evaluasi.index', compact('perusahaanWithEval', 'totalKriteria', 'kriteria', 'evaluasiDetail'));
    }

    public function create()
    {
        $perusahaan = Perusahaan::all();
        $kriteria = Kriteria::all();
        
        // Preload klasifikasi untuk setiap kriteria
        $klasifikasiByKriteria = [];
        foreach ($kriteria as $k) {
            $klasifikasiByKriteria[$k->kode_kriteria] = Klasifikasi::where('kode_kriteria', $k->kode_kriteria)
                ->orderBy('nilai', 'desc')
                ->get();
        }

        return view('evaluasi.form', compact('perusahaan', 'kriteria', 'klasifikasiByKriteria'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prs' => 'required|string|exists:perusahaan,kode_prs',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0|max:1000',
        ], [
            'kode_prs.required' => 'ini harus diisi',
            'nilai.required' => 'ini harus diisi',
        ]);

        DB::beginTransaction();
        try {
            $kode_prs = $validated['kode_prs'];

            // Hapus evaluasi lama untuk perusahaan ini (replace mode)
            Evaluasi::where('kode_prs', $kode_prs)->delete();

            // Insert evaluasi baru untuk SEMUA kriteria
            foreach ($validated['nilai'] as $kode_kriteria => $nilaiValue) {
                Evaluasi::create([
                    'kode_prs' => $kode_prs,
                    'kode_kriteria' => $kode_kriteria,
                    'nilai' => $nilaiValue,
                ]);
            }

            DB::commit();

            return redirect('/evaluasi')->with('success', 'Evaluasi perusahaan berhasil disimpan untuk SEMUA kriteria');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan evaluasi: ' . $e->getMessage()]);
        }
    }

    public function edit($kode_prs)
    {
        // Load perusahaan & kriteria
        $perusahaan = Perusahaan::all();
        $kriteria = Kriteria::all();

        // Load evaluasi yang sudah ada untuk perusahaan ini
        $evaluasiData = Evaluasi::where('kode_prs', $kode_prs)
            ->pluck('nilai', 'kode_kriteria')
            ->toArray();

        // Preload klasifikasi untuk setiap kriteria
        $klasifikasiByKriteria = [];
        foreach ($kriteria as $k) {
            $klasifikasiByKriteria[$k->kode_kriteria] = Klasifikasi::where('kode_kriteria', $k->kode_kriteria)
                ->orderBy('nilai', 'desc')
                ->get();
        }

        return view('evaluasi.form', compact('perusahaan', 'kriteria', 'klasifikasiByKriteria', 'kode_prs', 'evaluasiData'));
    }

    public function update(Request $request, $kode_prs)
    {
        $validated = $request->validate([
            'kode_prs' => 'required|string|exists:perusahaan,kode_prs',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0|max:100',
        ], [
            'kode_prs.required' => 'ini harus diisi',
            'nilai.required' => 'ini harus diisi',
        ]);

        DB::beginTransaction();
        try {
            $newKodePrs = $validated['kode_prs'];

            // Hapus evaluasi lama
            Evaluasi::where('kode_prs', $kode_prs)->delete();

            // Insert evaluasi baru untuk SEMUA kriteria
            foreach ($validated['nilai'] as $kode_kriteria => $nilaiValue) {
                Evaluasi::create([
                    'kode_prs' => $newKodePrs,
                    'kode_kriteria' => $kode_kriteria,
                    'nilai' => $nilaiValue,
                ]);
            }

            DB::commit();

            return redirect('/evaluasi')->with('success', 'Evaluasi perusahaan berhasil diperbarui untuk SEMUA kriteria');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui evaluasi: ' . $e->getMessage()]);
        }
    }

    public function destroy($kode_prs)
    {
        try {
            Evaluasi::where('kode_prs', $kode_prs)->delete();
            return redirect('/evaluasi')->with('success', 'Data evaluasi perusahaan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus evaluasi: ' . $e->getMessage()]);
        }
    }
}
