<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        // Ambil data testimoni dari database, urutkan berdasarkan yang terbaru
        $testimonials = Testimoni::orderBy('created_at', 'desc')->get();

        return view('testimoni', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tahun_lulusan' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'posisi' => 'nullable|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'testimoni' => 'required|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('testimonials', 'public');
        }

        $testimoni = Testimoni::create([
            'nama_alumni' => $request->nama,
            'jurusan' => $request->jurusan,
            'tahun_lulusan' => $request->tahun_lulusan,
            'posisi_pekerjaan' => $request->posisi,
            'nama_perusahaan' => $request->perusahaan,
            'testimoni' => $request->testimoni,
            'foto' => $fotoPath ? asset('storage/' . $fotoPath) : null
        ]);

        // Log successful creation for debugging
        Log::info('Testimoni created successfully', [
            'id' => $testimoni->id,
            'nama' => $request->nama,
            'timestamp' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Testimoni berhasil ditambahkan',
            'data' => [
                'id' => $testimoni->id,
                'nama_alumni' => $testimoni->nama_alumni,
                'jurusan' => $testimoni->jurusan,
                'tahun_lulusan' => $testimoni->tahun_lulusan,
                'posisi_pekerjaan' => $testimoni->posisi_pekerjaan,
                'nama_perusahaan' => $testimoni->nama_perusahaan,
                'testimoni' => $testimoni->testimoni,
                'foto' => $testimoni->foto
            ]
        ]);
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();

        return response()->json(['success' => true, 'message' => 'Testimoni berhasil dihapus']);
    }
}
