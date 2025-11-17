<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Siswa;

class TrackSiswaActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated as siswa
        if (Auth::guard('siswa')->check()) {
            $siswa = Auth::guard('siswa')->user();

            // Update last activity timestamp and mark as online
            $siswa->updateLastActivity();

            // Also update last_login_at if this is the first activity of the session
            if (!$siswa->last_login_at) {
                $siswa->update(['last_login_at' => now()]);
            }
        }

        return $next($request);
    }
}
