<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PreventBackMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Jika pengguna sudah login, lanjutkan ke halaman tujuan
            return $next($request)
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }

        // Jika belum login, arahkan ke halaman login
        return redirect('/auth/login');
    }
}
