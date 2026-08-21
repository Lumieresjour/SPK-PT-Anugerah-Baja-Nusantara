<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaan = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaan'));
    }

    public function create()
    {
        return view('perusahaan.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prs' => 'required|string|unique:perusahaan,kode_prs',
            'nama_prs' => 'required|string',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email',
        ], [
            'kode_prs.required' => 'ini harus diisi',
            'kode_prs.unique' => 'Kode perusahaan sudah ada',
            'nama_prs.required' => 'ini harus diisi',
        ]);

        Perusahaan::create($request->all());
        return redirect('/perusahaan')->with('success', 'Data perusahaan berhasil ditambahkan');
    }

    public function edit($kode_prs)
    {
        $perusahaan = Perusahaan::findOrFail($kode_prs);
        return view('perusahaan.form', compact('perusahaan'));
    }

    public function update(Request $request, $kode_prs)
    {
        $request->validate([
            'nama_prs' => 'required|string',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email',
        ], [
            'nama_prs.required' => 'ini harus diisi',
        ]);

        $perusahaan = Perusahaan::findOrFail($kode_prs);
        $perusahaan->update($request->all());
        return redirect('/perusahaan')->with('success', 'Data perusahaan berhasil diubah');
    }

    public function destroy($kode_prs)
    {
        Perusahaan::destroy($kode_prs);
        return redirect('/perusahaan')->with('success', 'Data perusahaan berhasil dihapus');
    }
}
