<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Session\Middleware\StartSession;

class AuthSession extends StartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next): Response
    {
        // 1. Biarkan parent (StartSession) memulai session dulu
        $response = parent::handle($request, $next);
        
        // 2. Sekarang session sudah siap, baru cek kondisinya
        // Tambahkan pengecekan agar tidak redirect jika memang sudah di halaman login
        if (!session('admin_id') && !$request->is('login*')) {
            return redirect('/login');
        }
        
        return $response;
    }
}