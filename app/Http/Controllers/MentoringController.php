<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentoring;
use Illuminate\Support\Facades\Log;

class MentoringController extends Controller
{
    public function index()
    {
        // Fetch mentoring entries
        $mentorings = Mentoring::latest()->paginate(6);

        return view('mentoring', compact('mentorings'));
    }

    public function store(Request $request)
    {
        Log::info('Mentoring store called', $request->all());

        $request->validate([
            'judul_mentoring' => 'required|string|max:500|unique:mentoring,judul_mentoring',
            'deskripsi' => 'required|string',
            'path_gambar' => 'nullable|image|max:5048',
        ]);

        $pathGambar = null;
        if ($request->hasFile('path_gambar')) {
            try {
                $pathGambar = $request->file('path_gambar')->store('mentoring_images', 'public');
                Log::info('Image uploaded to: ' . $pathGambar);
            } catch (\Exception $e) {
                Log::error('Image upload failed: ' . $e->getMessage());
                return redirect()->route('mentoring')->withErrors('Gagal mengupload gambar.');
            }
        }

        $user = auth()->user();

        if (!$user) {
            Log::error('Mentoring store failed: User not authenticated');
            return redirect()->route('mentoring')->withErrors('User tidak terautentikasi.');
        }

        Log::info("Mentoring store by user: {$user->name}");

        try {
            $creatorName = 'Unknown';
            if (auth()->guard('admin')->check()) {
                $creatorName = 'admin';
            } elseif ($user) {
                $creatorName = $user->name;
            }

            $mentoring = Mentoring::create([
                'name' => $creatorName,
                'judul_mentoring' => $request->judul_mentoring,
                'deskripsi' => $request->deskripsi,
                'path_gambar' => $pathGambar,
            ]);
            Log::info('Mentoring created', ['id' => $mentoring->id]);
        } catch (\Exception $e) {
            Log::error('Mentoring store failed: ' . $e->getMessage());
            return redirect()->route('mentoring')->withErrors('Terjadi kesalahan saat menyimpan mentoring.');
        }

        return redirect()->route('mentoring')->with('success', 'Mentoring berhasil ditambahkan.');
    }

    public function show($id)
    {
        $mentoring = Mentoring::find($id);

        if (!$mentoring) {
            abort(404, 'Mentoring not found');
        }

        return view('mentor-detail', compact('mentoring'));
    }

    // Delete a mentoring by ID
    public function destroy($id)
    {
        try {
            $mentoring = Mentoring::findOrFail($id);
            $mentoring->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Failed to delete mentoring: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Gagal menghapus mentoring');
        }
    }
}
