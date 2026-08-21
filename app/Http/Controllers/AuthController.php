<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'ada yang harus diisi',
            'password.required' => 'ada yang harus diisi',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['login' => 'Username atau password salah, silahkan hubungi tim IT anda']);
        }

        session(['admin_id' => $admin->id_admin]); // atau $admin->id sesuai nama kolom
        Session::put('admin_name', $admin->nama_lengkap ?? $admin->username);

        return redirect('/home');
    }

    public function logout()
    {
        Session::forget('admin_id');
        Session::forget('admin_name');
        Session::flush();

        return redirect('/login');
    }
}
