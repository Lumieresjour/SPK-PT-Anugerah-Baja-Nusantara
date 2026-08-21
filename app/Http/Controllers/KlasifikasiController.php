<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function index()
    {
        $klasifikasi = Klasifikasi::with('kriteria')->get();
        return view('klasifikasi.index', compact('klasifikasi'));
    }

    public function create()
    {
        $kriteria = Kriteria::all();
        return view('klasifikasi.form', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_klasifikasi' => 'required|string|unique:klasifikasi,kode_klasifikasi',
            'kode_kriteria' => 'required|string|exists:kriteria,kode_kriteria',
            'nama_klasifikasi' => 'required|string',
            'nilai' => 'required|integer',
        ], [
            'kode_klasifikasi.required' => 'ini harus diisi',
            'kode_klasifikasi.unique' => 'Kode klasifikasi sudah ada',
            'kode_kriteria.required' => 'ini harus diisi',
            'nama_klasifikasi.required' => 'ini harus diisi',
            'nilai.required' => 'ini harus diisi',
        ]);

        Klasifikasi::create($request->all());
        return redirect('/klasifikasi')->with('success', 'Data klasifikasi berhasil ditambahkan');
    }

    public function edit($kode_klasifikasi)
    {
        $klasifikasi = Klasifikasi::findOrFail($kode_klasifikasi);
        $kriteria = Kriteria::all();
        return view('klasifikasi.form', compact('klasifikasi', 'kriteria'));
    }

    public function update(Request $request, $kode_klasifikasi)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|exists:kriteria,kode_kriteria',
            'nama_klasifikasi' => 'required|string',
            'nilai' => 'required|integer',
        ], [
            'kode_kriteria.required' => 'ini harus diisi',
            'nama_klasifikasi.required' => 'ini harus diisi',
            'nilai.required' => 'ini harus diisi',
        ]);

        $klasifikasi = Klasifikasi::findOrFail($kode_klasifikasi);
        $klasifikasi->update($request->all());
        return redirect('/klasifikasi')->with('success', 'Data klasifikasi berhasil diubah');
    }

    public function destroy($kode_klasifikasi)
    {
        Klasifikasi::destroy($kode_klasifikasi);
        return redirect('/klasifikasi')->with('success', 'Data klasifikasi berhasil dihapus');
    }
}
