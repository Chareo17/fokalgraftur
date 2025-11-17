<?php

namespace App\Http\Controllers;

use App\Models\Undangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class UndanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $undangans = Undangan::latest()->paginate(10);
        return view('admin.undangan.index', compact('undangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.undangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'role_target' => 'required|array',
            'role_target.*' => 'string',
            'name' => 'required|string|max:255',
            'gambar_barcode_tanda_tangan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'role_target', 'name']);

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('undangan', 'public');
            $data['gambar'] = $imagePath;
        }

        if ($request->hasFile('gambar_barcode_tanda_tangan')) {
            $barcodePath = $request->file('gambar_barcode_tanda_tangan')->store('undangan/barcode', 'public');
            $data['gambar_barcode_tanda_tangan'] = $barcodePath;
        }

        $undangan = Undangan::create($data);

        // Fire the event for notifications
        event(new \App\Events\UndanganCreated($undangan));

        return redirect()->route('admin.undangan.index')->with('success', 'Undangan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Undangan $undangan)
    {
        $author = $undangan->name ?? 'Admin';
        return view('admin.undangan.show', compact('undangan', 'author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Undangan $undangan)
    {
        return view('admin.undangan.edit', compact('undangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Undangan $undangan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'role_target' => 'required|array',
            'role_target.*' => 'string',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'role_target']);

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($undangan->gambar && Storage::disk('public')->exists($undangan->gambar)) {
                Storage::disk('public')->delete($undangan->gambar);
            }
            $imagePath = $request->file('gambar')->store('undangan', 'public');
            $data['gambar'] = $imagePath;
        }

        $undangan->update($data);

        return redirect()->route('admin.undangan.index')->with('success', 'Undangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Undangan $undangan)
    {
        // Delete image if exists
        if ($undangan->gambar && Storage::disk('public')->exists($undangan->gambar)) {
            Storage::disk('public')->delete($undangan->gambar);
        }

        $undangan->delete();

        return redirect()->route('admin.undangan.index')->with('success', 'Undangan berhasil dihapus.');
    }

    /**
     * Get counts for realtime update.
     */
    public function getCounts()
    {
        $total = Undangan::count();
        $alumni = Undangan::where('role_target', 'like', '%alumni%')->count();
        $siswa = Undangan::where('role_target', 'like', '%siswa%')->count();

        return response()->json([
            'total' => $total,
            'alumni' => $alumni,
            'siswa' => $siswa,
        ]);
    }

    /**
     * Download the undangan as PDF.
     */
    public function downloadPDF($id)
    {
        $undangan = Undangan::findOrFail($id);
        $author = $undangan->name ?? 'Admin';

        $gambar_base64 = null;
        if ($undangan->gambar) {
            $imagePath = storage_path('app/public/' . $undangan->gambar);
            if (File::exists($imagePath)) {
                $imageData = File::get($imagePath);
                $extension = strtolower(pathinfo($undangan->gambar, PATHINFO_EXTENSION));
                $mimeType = $extension === 'png' ? 'png' : ($extension === 'gif' ? 'gif' : 'jpeg');
                $gambar_base64 = 'data:image/' . $mimeType . ';base64,' . base64_encode($imageData);
            }
        }

        $pdf = Pdf::loadView('pdf.undangan-pdf', compact('undangan', 'author', 'gambar_base64'));

        $filename = Str::slug($undangan->judul) . '.pdf';

        return $pdf->download($filename);
    }
}
