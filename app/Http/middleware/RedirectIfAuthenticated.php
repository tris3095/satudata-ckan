<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        // Jika pengguna sudah login, arahkan langsung ke dashboard
        if (Auth::check()) {
            $lastAccessedUrl = session()->get('last_accessed_url', route('admin.dashboard.index'));
            return redirect()->intended($lastAccessedUrl);
        }

        // Jika pengguna belum login, teruskan request ke halaman login
        $response = $next($request);
        return $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
