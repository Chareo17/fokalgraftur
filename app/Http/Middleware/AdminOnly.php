<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is authenticated
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // If not admin, check if user has admin role in web guard
        $user = Auth::guard('web')->user();
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // If not admin, check if user has admin role in alumni guard
        $alumni = Auth::guard('alumni')->user();
        if ($alumni && $alumni->role === 'admin') {
            return $next($request);
        }

        // If not admin, check if user has admin role in siswa guard
        $siswa = Auth::guard('siswa')->user();
        if ($siswa && $siswa->role === 'admin') {
            return $next($request);
        }

        // If no admin access found, redirect to login
        return redirect()->route('login')->withErrors(['access' => 'Akses ditolak. Anda tidak memiliki izin admin.']);
    }
}
