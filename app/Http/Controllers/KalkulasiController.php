<?php

namespace App\Http\Controllers;

use App\Services\SAWService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KalkulasiController extends Controller
{
    protected $sawService;

    public function __construct(SAWService $sawService)
    {
        $this->sawService = $sawService;
    }

    public function index()
    {
        $idAdmin = session('admin_id');
        $results = $this->sawService->getResults($idAdmin);
    
    // Ambil semua kriteria untuk header kolom dinamis
        $kriteria = \App\Models\Kriteria::all();
    
        return view('kalkulasi.index', compact('results', 'kriteria'));
    }

    public function calculate()
    {
        $idAdmin = session('admin_id'); // ambil dari session saat login
        $this->sawService->calculateRanking($idAdmin);
        return redirect('/kalkulasi')->with('success', 'Kalkulasi berhasil dilakukan');
    }

    public function exportPdf()
    {
        $idAdmin = session('admin_id');
        $results = $this->sawService->getResults($idAdmin);
        $kriteria = \App\Models\Kriteria::all();
    
        $pdf = Pdf::loadView('kalkulasi.pdf', compact('results', 'kriteria'));
        return $pdf->download('hasil_ranking_saw.pdf');
    }
}
