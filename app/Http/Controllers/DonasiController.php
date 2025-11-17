<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Events\DonationValidated;

class DonasiController extends Controller
{
    // Untuk admin melihat & memvalidasi donasi
    public function index()
    {
        $donations = \App\Models\Donasi::all();
        return view('donasi-admin', compact('donations'));
    }

    // Untuk user menampilkan form donasi
    // Untuk user menampilkan form donasi + riwayat
public function create()
{
    // Ambil user yang sedang login (bisa dari guard siswa, alumni, atau default)
    if (Auth::guard('siswa')->check()) {
        $user = Auth::guard('siswa')->user();
    } elseif (Auth::guard('alumni')->check()) {
        $user = Auth::guard('alumni')->user();
    } else {
        $user = Auth::user();
    }

    // Ambil riwayat donasi user yang sedang login
    $donasi = \App\Models\Donasi::where('user_id', $user->id)
                                ->latest()
                                ->get();

    return view('donasi', compact('donasi'));
}

    // Menyimpan donasi dari form
    public function store(Request $request)
    {
        // // Enforce authentication for storing donation
        // if (!Auth::check()) {
        //     return redirect()->route('login')->with('error', 'Anda harus login untuk melakukan donasi.');
        // }

        $request->validate([
            'nominal' => 'required|integer|min:1000 |max:1000000000',
            'bukti_donasi' => 'required|image|max:10048',
        ]);

        // Determine authenticated user from guards
        if (Auth::guard('siswa')->check()) {
            $user = Auth::guard('siswa')->user();
        } elseif (Auth::guard('alumni')->check()) {
            $user = Auth::guard('alumni')->user();
        } else {
            $user = Auth::user();
        }

        $nama = $user->name;

        $imagePath = $request->file('bukti_donasi')->store('donations', 'public');

        \App\Models\Donasi::create([
            'nama' => $nama,
            'gambar_donasi' => $imagePath,
            'nominal' => $request->nominal,
            'status' => 'belum divalidasi',
            'user_id' => $user->id,
        ]);

        return redirect()->route('donasi.form')->with('success', 'Donasi berhasil dikirim, menunggu validasi.');
    }

    // Validasi donasi (konfirmasi)
    public function validateDonation($id)
    {
        $donation = \App\Models\Donasi::findOrFail($id);
        $donation->status = 'divalidasi';
        $donation->save();

        event(new DonationValidated($donation));

        return redirect()->route('admin.donasi')->with('success', 'Donasi berhasil divalidasi.');
    }

    // Tolak donasi
    public function rejectDonation($id)
    {
        $donation = \App\Models\Donasi::findOrFail($id);
        $donation->status = 'ditolak';
        $donation->save();

        return redirect()->route('admin.donasi')->with('rejected', 'Donasi berhasil ditolak.');
    }

    // Simpan penarikan (withdrawal)
    public function storeWithdrawal(Request $request)
    {
        $request->validate([
            'nominal' => 'required|integer|min:1|max:1000000000',
            'alasan' => 'nullable|string|max:255',
        ]);

        \App\Models\Donasi::create([
            'nama' => 'Penarikan Admin' . ($request->alasan ? ' - ' . $request->alasan : ''),
            'gambar_donasi' => '', // Placeholder to avoid null constraint
            'nominal' => -$request->nominal, // Negative for withdrawal
            'status' => 'divalidasi',
            'user_id' => Auth::id(), // Use current authenticated user (admin)
        ]);

        return redirect()->route('admin.donasi')->with('success', 'Penarikan berhasil dicatat.');
    }
}
