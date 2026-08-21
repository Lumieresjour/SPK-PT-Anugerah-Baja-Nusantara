<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('kriteria.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|unique:kriteria,kode_kriteria',
            'nama_kriteria' => 'required|string',
            'bobot' => 'required|numeric|between:0,1',
            'jenis' => 'required|in:cost,benefit',
        ], [
            'kode_kriteria.required' => 'ini harus diisi',
            'kode_kriteria.unique' => 'Kode kriteria sudah ada',
            'nama_kriteria.required' => 'ini harus diisi',
            'bobot.required' => 'ini harus diisi',
            'jenis.required' => 'ini harus diisi',
        ]);

        Kriteria::create($request->all());
        return redirect('/kriteria')->with('success', 'Data kriteria berhasil ditambahkan');
    }

    public function edit($kode_kriteria)
    {
        $kriteria = Kriteria::findOrFail($kode_kriteria);
        return view('kriteria.form', compact('kriteria'));
    }

    public function update(Request $request, $kode_kriteria)
    {
        $request->validate([
            'nama_kriteria' => 'required|string',
            'bobot' => 'required|numeric|between:0,1',
            'jenis' => 'required|in:cost,benefit',
        ], [
            'nama_kriteria.required' => 'ini harus diisi',
            'bobot.required' => 'ini harus diisi',
            'jenis.required' => 'ini harus diisi',
        ]);

        $kriteria = Kriteria::findOrFail($kode_kriteria);
        $kriteria->update($request->all());
        return redirect('/kriteria')->with('success', 'Data kriteria berhasil diubah');
    }

    public function destroy($kode_kriteria)
    {
        Kriteria::destroy($kode_kriteria);
        return redirect('/kriteria')->with('success', 'Data kriteria berhasil dihapus');
    }
}
