<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index()
    {
        // Nanti bisa ambil data berita dari database, sekarang dummy saja
        return view('login'); // Pastikan kamu punya file resources/views/pages/berita.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        Log::info('Login attempt', ['username' => $credentials['username']]);

        // Try admin guard first
        if (Auth::guard('admin')->attempt($credentials)) {
            Log::info('Admin login success', ['username' => $credentials['username']]);
            return redirect()->route('berita.index');
        }

        // Try alumni guard
        if (Auth::guard('alumni')->attempt($credentials)) {
            Log::info('Alumni login success', ['username' => $credentials['username']]);
            return redirect()->route('alumni.dashboard'); // Define this route
        }

        // Try siswa guard
        if (Auth::guard('siswa')->attempt($credentials)) {
            Log::info('Siswa login success', ['username' => $credentials['username']]);
            return redirect()->route('siswa.dashboard'); // Define this route
        }

        // Try default web guard for other users
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            Log::info('User login success', ['username' => $credentials['username'], 'role' => $user->role]);
            if ($user->role === 'alumni') {
                return redirect()->route('alumni.dashboard'); // Define this route
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard'); // Define this route
            } else {
                Auth::guard('web')->logout();
                return back()->withErrors(['loginError' => 'Role tidak dikenali']);
            }
        }

        Log::warning('Login failed', ['username' => $credentials['username']]);
        return back()->withErrors(['loginError' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login');
        } elseif (Auth::guard('alumni')->check()) {
            $alumni = Auth::guard('alumni')->user();
            $alumni->markAsOffline(); // Mark as offline before logout
            Auth::guard('alumni')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        } elseif (Auth::guard('siswa')->check()) {
            $siswa = Auth::guard('siswa')->user();
            $siswa->markAsOffline(); // Mark as offline before logout
            Auth::guard('siswa')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        } else {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('landingpage');
        }
    }
}
