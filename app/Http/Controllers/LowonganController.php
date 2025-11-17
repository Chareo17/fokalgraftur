<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LowonganController extends Controller
{
    // Menampilkan halaman daftar lowongan
    
    public function index()
        {
        $lowongans = Lowongan::latest()->paginate(6);
        return view('loker.lowongan', compact('lowongans')); // tampilkan daftar lowongan kerja dengan data
    }

    // Menampilkan halaman detail satu lowongan
    public function show($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('loker.lowongan-detail', compact('lowongan')); // tampilkan detail satu lowongan dengan data
    }

    // Menyimpan data lowongan baru
public function store(Request $request)
    {
        $user = auth('admin')->user() ?? auth('alumni')->user() ?? auth('siswa')->user();
        if (!$user || !(auth('admin')->check() || auth('alumni')->check())) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255|unique:lowongan,judul',
            'deskripsi' => 'required|string|max:6000',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:10048',
            'batas_pengumpulan' => 'nullable|date|after:today',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('lowongan_images', 'public');
            $validatedData['gambar'] = $imagePath;
        }

        // Set uploader name from authenticated user (admin, alumni, or siswa)
        if (auth('admin')->check()) {
            $validatedData['name'] = auth('admin')->user()->name ?? 'admin';
        } elseif (auth('alumni')->check()) {
            $validatedData['name'] = auth('alumni')->user()->name ?? 'alumni';
        } elseif (auth('siswa')->check()) {
            $validatedData['name'] = auth('siswa')->user()->name ?? 'siswa';
        } else {
            $validatedData['name'] = 'admin';
        }

        Lowongan::create($validatedData);

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diupload');
    }

    // Delete a lowongan by ID
    public function destroy($id)
    {
        try {
            $lowongan = Lowongan::findOrFail($id);
            $lowongan->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Failed to delete lowongan: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Gagal menghapus lowongan');
        }
    }
}
