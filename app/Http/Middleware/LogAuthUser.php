<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogAuthUser
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
        $user = Auth::user();
        $guard = null;

        foreach (['admin', 'alumni', 'siswa', 'web'] as $g) {
            if (Auth::guard($g)->check()) {
                $guard = $g;
                break;
            }
        }

        if ($user) {
            Log::info("Authenticated user: {$user->name}, Guard: {$guard}, URL: {$request->fullUrl()}");
        } else {
            Log::info("No authenticated user, URL: {$request->fullUrl()}");
        }

        return $next($request);
    }
}
