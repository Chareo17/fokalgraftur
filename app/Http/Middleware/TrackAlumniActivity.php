<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Alumni;

class TrackAlumniActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated as alumni
        if (Auth::guard('alumni')->check()) {
            $alumni = Auth::guard('alumni')->user();

            // Update last activity timestamp and mark as online
            $alumni->updateLastActivity();

            // Also update last_login_at if this is the first activity of the session
            if (!$alumni->last_login_at) {
                $alumni->update(['last_login_at' => now()]);
            }
        }

        return $next($request);
    }
}
