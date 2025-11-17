<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Berita;
use App\Events\BeritaCreated;

class BeritaController extends Controller
{

    public function index()
    {
        $berita = Berita::orderBy('created_at', 'desc')->paginate(6);
        return view('berita.berita', ['berita' => $berita]);
    }
    public function show($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            abort(404, 'Berita tidak ditemukan');
        }

        $author = $berita->name;

        return view('berita.news-detail', [
            'berita' => $berita,
            'author' => $author,
        ]);
    }

    public function create()
    {
        return view('berita.create'); // Create this view for news creation form
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:250|unique:berita,judul',
            'ringkasan' => 'required|string',
            'gambar' => 'nullable|image|max:10048',
        ]);

        $data = $request->only(['judul', 'ringkasan']);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('berita_images', 'public');
            $data['gambar'] = $path;
        }

        // Save authenticated user's name as name if available
        $userName = auth()->user() ? auth()->user()->name : null;
        if ($userName) {
            $data['name'] = $userName;
        } else {
            $data['name'] = 'admin';
        }

        $berita = Berita::create($data);

        // Fire the BeritaCreated event for real-time notification
        event(new BeritaCreated($berita));

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dibuat');
    }

    // Delete a berita by ID
    public function destroy($id)
    {
        try {
            $berita = Berita::find($id);
            if ($berita) {
                $berita->delete();
                return redirect()->route('admin.dashboard')->with('success', 'Data berhasil dihapus');
            } else {
                return redirect()->route('admin.dashboard')->with('error', 'Berita tidak ditemukan');
            }
        } catch (\Exception $e) {
            Log::error('Failed to delete berita: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Gagal menghapus berita');
        }
    }
}
