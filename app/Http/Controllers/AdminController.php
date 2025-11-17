<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumni;
use App\Models\Siswa;
use App\Models\ForumTopic;
use App\Models\Lowongan;
use App\Models\Mentoring;
use App\Models\PerkembanganSekolah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Create this view
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard'); // Redirect to the dashboard
        }
        return back()->withErrors([
            'loginError' => 'Username atau password salah',
        ]);
    }

    public function dashboard(Request $request)
    {
        $totalAlumni = Alumni::count();
        $totalSiswa = Siswa::count();

        $alreadyWorking = Alumni::where('status', 'Bekerja')->count();

        $furtherStudy = Alumni::where('status', 'Studi Lanjut')->count();

        $notWorkingYet = Alumni::where('status', 'Tidak Bekerja')->count();

        $forumCount = ForumTopic::count();
        $lowonganCount = Lowongan::count();
        $mentoringCount = Mentoring::count();
        $beritaCount = DB::table('berita')->count();

        // Get alumni counts grouped by graduation year with optional filtering
        $alumniQuery = Alumni::select('tahun_lulusan', DB::raw('count(*) as total'))
            ->groupBy('tahun_lulusan')
            ->orderBy('tahun_lulusan', 'asc');

        // Apply year filters if provided
        if ($request->has('year_from') && $request->filled('year_from')) {
            $alumniQuery->where('tahun_lulusan', '>=', $request->year_from);
        }

        if ($request->has('year_to') && $request->filled('year_to')) {
            $alumniQuery->where('tahun_lulusan', '<=', $request->year_to);
        }

        $alumniByYear = $alumniQuery->get();

        $alumniYearLabels = $alumniByYear->pluck('tahun_lulusan')->map(function ($year) {
            return (string) $year;
        })->toArray();

        $alumniYearCounts = $alumniByYear->pluck('total')->toArray();

        $latestForumTopics = ForumTopic::latest()->get();
        $latestLowongan = Lowongan::latest()->get(['id', 'name', 'judul', 'created_at']);
        $latestMentoring = Mentoring::latest()->get(['id', 'name', 'judul_mentoring', 'created_at']);
        $latestBerita = DB::table('berita')->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact(
            'totalAlumni', 'totalSiswa', 'alreadyWorking', 'furtherStudy', 'notWorkingYet',
            'forumCount', 'lowonganCount', 'mentoringCount', 'beritaCount',
            'latestForumTopics', 'latestLowongan', 'latestMentoring', 'latestBerita',
            'alumniYearLabels', 'alumniYearCounts'
        ));
    }

    // Show form to create new user (alumni or siswa)
    public function createUser()
    {
        return view('admin.add-user');
    }

    // Delete user (alumni or siswa) by ID
    public function deleteUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'user_type' => 'required|string|in:alumni,siswa',
        ]);

        $userId = $request->input('user_id');
        $userType = $request->input('user_type');

        if ($userType === 'alumni') {
            $user = \App\Models\Alumni::find($userId);
        } elseif ($userType === 'siswa') {
            $user = \App\Models\Siswa::find($userId);
        } else {
            return redirect()->back()->withErrors(['Invalid user type']);
        }

        if (!$user) {
            return redirect()->back()->withErrors(['User not found']);
        }

        try {
            $user->delete();
return redirect()->back()->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Failed to delete user']);
        }
    }

    // Store new user (alumni or siswa)
    public function storeUser(Request $request)
    {
        $request->validate([
            'user_type' => 'required|string|in:alumni,siswa',
            'name' => 'required|string|max:200|unique:alumni,name|unique:siswa,name',
            // 'name' => 'required|string|max:200|unique:alumni,name|unique:siswa,name', 50max
            'username' => 'required|string|max:25|unique:alumni,username|unique:siswa,username',
            'password' => 'required|string|min:6|confirmed',
            'jurusan' => 'nullable|string|max:35',
            'nis' => 'nullable|string|max:10|unique:siswa,nis',
            'tahun_lulusan' => 'nullable|integer',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:18',
            'status' => 'nullable|string|max:25',
            'nama_perusahaan' => 'nullable|string|max:35',
            'nama_universitas' => 'nullable|string|max:100',
            'alamat' => 'nullable|string|max:100',
            'ijazah_files' => 'nullable|array|max:5',
            'ijazah_files.*' => 'nullable|file|mimes:pdf,jpeg,jpg,png,doc,docx|max:5120',
        ], [
            'ijazah_files.mimes' => 'Format file tidak didukung. Format yang didukung: PDF, JPG, PNG, DOC, DOCX.',
            'ijazah_files.max' => 'Ukuran file maksimal 5MB per file.',
        ]);

        $userType = $request->input('user_type');

        $data = $request->only([
            'name', 'username', 'nis', 'jurusan', 'tahun_lulusan', 'tanggal_lahir', 'no_hp', 'status', 'nama_perusahaan', 'nama_universitas', 'alamat'
        ]);
        $data['password'] = Hash::make($request->input('password'));

        // Handle ijazah file uploads for alumni
        if ($userType === 'alumni' && $request->hasFile('ijazah_files')) {
            $ijazahPaths = [];
            $files = $request->file('ijazah_files');

            // Debug logging
            Log::info('Ijazah upload debug info:', [
                'hasFiles' => $request->hasFile('ijazah_files'),
                'fileCount' => count($files),
                'allFiles' => $request->allFiles(),
                'fileDetails' => array_map(function($file) {
                    return [
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType(),
                        'extension' => $file->getClientOriginalExtension()
                    ];
                }, $files)
            ]);

            // Validate maximum 5 files
            if (count($files) > 5) {
                Log::warning('Too many ijazah files uploaded:', ['count' => count($files)]);
                return redirect()->back()->withErrors(['ijazah_files' => 'Maksimal 5 file dapat diunggah sekaligus.'])->withInput();
            }

            foreach ($files as $index => $file) {
                try {
                    // Validate file size (additional check)
                    if ($file->getSize() > 5 * 1024 * 1024) {
                        return redirect()->back()->withErrors(['ijazah_files' => 'Ukuran file maksimal 5MB per file.'])->withInput();
                    }

                    // Validate file type
                    $allowedMimes = ['pdf', 'jpeg', 'jpg', 'png', 'doc', 'docx'];
                    $extension = strtolower($file->getClientOriginalExtension());
                    if (!in_array($extension, $allowedMimes)) {
                        return redirect()->back()->withErrors(['ijazah_files' => "Format file {$file->getClientOriginalName()} tidak didukung."])->withInput();
                    }

                    $filename = time() . '_' . uniqid() . '.' . $extension;
                    $path = $file->storeAs('ijazah', $filename, 'public');

                    if ($path) {
                        $ijazahPaths[] = $path;
                        Log::info("Ijazah file uploaded successfully: {$path}");
                    } else {
                        Log::error("Failed to store ijazah file: {$file->getClientOriginalName()}");
                        return redirect()->back()->withErrors(['ijazah_files' => 'Gagal mengunggah file: ' . $file->getClientOriginalName()])->withInput();
                    }
                } catch (\Exception $e) {
                    Log::error("Error uploading ijazah file {$file->getClientOriginalName()}: " . $e->getMessage());
                    return redirect()->back()->withErrors(['ijazah_files' => 'Error mengunggah file: ' . $file->getClientOriginalName() . ' - ' . $e->getMessage()])->withInput();
                }
            }

            $data['ijazah'] = !empty($ijazahPaths) ? json_encode($ijazahPaths) : null;
        }

        if ($userType === 'alumni') {
            if (!empty($data['tahun_lulusan']) && !empty($data['jurusan'])) {
                $data['nia'] = \App\Models\Alumni::generateNia($data['tahun_lulusan'], $data['jurusan']);
            }
            $user = \App\Models\Alumni::create($data);
        } elseif ($userType === 'siswa') {
            $user = \App\Models\Siswa::create($data);
        } else {
            return redirect()->back()->withErrors(['Invalid user type']);
        }

        return redirect()->back()->with('success', 'Pengguna Berhasil Ditambahkan');
    }

    // Convert siswa to alumni
    public function convertToAlumni(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:siswa,id',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:alumni,username',
            'jurusan' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tahun_lulusan' => 'required|integer',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:18',
            'status' => 'required|string|max:25',
            'nama_perusahaan' => 'nullable|string|max:255',
            'nama_universitas' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'ijazah_files' => 'nullable|array|max:5',
            'ijazah_files.*' => 'nullable|file|mimes:pdf,jpeg,jpg,png,doc,docx|max:5120',
        ], [
            'ijazah_files.mimes' => 'Format file tidak didukung. Format yang didukung: PDF, JPG, PNG, DOC, DOCX.',
            'ijazah_files.max' => 'Ukuran file maksimal 5MB per file.',
            'profile_image.mimes' => 'Format gambar tidak didukung. Format yang didukung: JPG, PNG.',
            'profile_image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Find the siswa
        $siswa = \App\Models\Siswa::findOrFail($request->user_id);

        // Prepare alumni data
        $alumniData = [
            'name' => $request->name,
            'username' => $request->username,
            'jurusan' => $request->jurusan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tahun_lulusan' => $request->tahun_lulusan,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_universitas' => $request->nama_universitas,
            'password' => $siswa->password, // Keep the same password
        ];

        // Generate NIA
        $alumniData['nia'] = \App\Models\Alumni::generateNia($request->tahun_lulusan, $request->jurusan);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $filename = time() . '_' . uniqid() . '.' . $profileImage->getClientOriginalExtension();
            $path = $profileImage->storeAs('profile_images', $filename, 'public');
            $alumniData['profile_image'] = $path;
        }

        // Handle ijazah file uploads
        if ($request->hasFile('ijazah_files')) {
            $ijazahPaths = [];
            $files = $request->file('ijazah_files');

            foreach ($files as $file) {
                // Validate file size
                if ($file->getSize() > 5 * 1024 * 1024) {
                    return redirect()->back()->withErrors(['ijazah_files' => 'Ukuran file maksimal 5MB per file.'])->withInput();
                }

                // Validate file type
                $allowedMimes = ['pdf', 'jpeg', 'jpg', 'png', 'doc', 'docx'];
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, $allowedMimes)) {
                    return redirect()->back()->withErrors(['ijazah_files' => "Format file {$file->getClientOriginalName()} tidak didukung."])->withInput();
                }

                $filename = time() . '_' . uniqid() . '.' . $extension;
                $path = $file->storeAs('ijazah', $filename, 'public');

                if ($path) {
                    $ijazahPaths[] = $path;
                } else {
                    return redirect()->back()->withErrors(['ijazah_files' => 'Gagal mengunggah file: ' . $file->getClientOriginalName()])->withInput();
                }
            }

            $alumniData['ijazah'] = json_encode($ijazahPaths);
        }

        // Create alumni record
        $alumni = \App\Models\Alumni::create($alumniData);

        // Delete the siswa record
        $siswa->delete();

        return redirect()->route('data-pengguna')->with('success', 'Siswa berhasil dikonversi menjadi Alumni dengan NIA: ' . $alumni->nia);
    }

    // Update siswa user
    public function updateSiswa(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:siswa,id',
            'name' => 'required|string|max:255',
            // 'name' => 'required|string|max:255', 50max
            'username' => 'nullable|string|max:255|unique:siswa,username,' . $request->id,
            'jurusan' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $siswa = \App\Models\Siswa::findOrFail($request->id);
        $siswa->name = $request->name;
        $siswa->username = $request->username;
        $siswa->jurusan = $request->jurusan;

        if ($request->filled('password')) {
            $siswa->password = Hash::make($request->password);
        }

        $siswa->save();

        return redirect()->route('data-pengguna')->with('success', 'Siswa updated successfully.');
    }

    // Update alumni user
    public function updateAlumni(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:alumni,id',
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:alumni,username,' . $request->id,
            'jurusan' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'tahun_lulusan' => 'nullable|integer',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:25',
            'nama_perusahaan' => 'nullable|string|max:255',
            'nama_universitas' => 'nullable|string|max:255',
            'ijazah_files' => 'nullable|array|max:5',
            'ijazah_files.*' => 'nullable|file|mimes:pdf,jpeg,jpg,png,doc,docx|max:5120',
        ], [
            'ijazah_files.mimes' => 'Format file tidak didukung. Format yang didukung: PDF, JPG, PNG, DOC, DOCX.',
            'ijazah_files.max' => 'Ukuran file maksimal 5MB per file.',
            'ijazah_files.*.mimes' => 'Format file tidak didukung. Format yang didukung: PDF, JPG, PNG, DOC, DOCX.',
            'ijazah_files.*.max' => 'Ukuran file maksimal 5MB per file.',
        ]);

        $alumni = \App\Models\Alumni::findOrFail($request->id);

        // Handle ijazah file uploads
        if ($request->hasFile('ijazah_files')) {
            $ijazahPaths = [];

            // If alumni already has ijazah files, keep them
            if ($alumni->ijazah) {
                $existingPaths = json_decode($alumni->ijazah, true);
                if (is_array($existingPaths)) {
                    $ijazahPaths = $existingPaths;
                }
            }

            $files = $request->file('ijazah_files');

            // Debug logging for update
            Log::info('Ijazah update debug info:', [
                'hasFiles' => $request->hasFile('ijazah_files'),
                'fileCount' => count($files),
                'existingFiles' => count($ijazahPaths),
                'allFiles' => $request->allFiles(),
                'fileDetails' => array_map(function($file) {
                    return [
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize(),
                        'mime' => $file->getMimeType(),
                        'extension' => $file->getClientOriginalExtension()
                    ];
                }, $files)
            ]);

            // Validate maximum 5 files total (existing + new)
            $newFileCount = count($files);
            $existingFileCount = count($ijazahPaths);
            if (($existingFileCount + $newFileCount) > 5) {
                Log::warning('Too many ijazah files for update:', ['existing' => $existingFileCount, 'new' => $newFileCount]);
                return redirect()->back()->withErrors(['ijazah_files' => 'Total file ijazah tidak boleh lebih dari 5 file.'])->withInput();
            }

            // Add new files
            foreach ($files as $index => $file) {
                try {
                    // Validate file size (additional check)
                    if ($file->getSize() > 5 * 1024 * 1024) {
                        return redirect()->back()->withErrors(['ijazah_files' => 'Ukuran file maksimal 5MB per file.'])->withInput();
                    }

                    // Validate file type
                    $allowedMimes = ['pdf', 'jpeg', 'jpg', 'png', 'doc', 'docx'];
                    $extension = strtolower($file->getClientOriginalExtension());
                    if (!in_array($extension, $allowedMimes)) {
                        return redirect()->back()->withErrors(['ijazah_files' => "Format file {$file->getClientOriginalName()} tidak didukung."])->withInput();
                    }

                    $filename = time() . '_' . uniqid() . '.' . $extension;
                    $path = $file->storeAs('ijazah', $filename, 'public');

                    if ($path) {
                        $ijazahPaths[] = $path;
                        Log::info("Ijazah file uploaded successfully (update): {$path}");
                    } else {
                        Log::error("Failed to store ijazah file (update): {$file->getClientOriginalName()}");
                        return redirect()->back()->withErrors(['ijazah_files' => 'Gagal mengunggah file: ' . $file->getClientOriginalName()])->withInput();
                    }
                } catch (\Exception $e) {
                    Log::error("Error uploading ijazah file (update) {$file->getClientOriginalName()}: " . $e->getMessage());
                    return redirect()->back()->withErrors(['ijazah_files' => 'Error mengunggah file: ' . $file->getClientOriginalName() . ' - ' . $e->getMessage()])->withInput();
                }
            }

            $alumni->ijazah = json_encode($ijazahPaths);
        }

        $alumni->name = $request->name;
        $alumni->username = $request->username;
        $alumni->jurusan = $request->jurusan;
        $alumni->tahun_lulusan = $request->tahun_lulusan;
        $alumni->tanggal_lahir = $request->tanggal_lahir;
        $alumni->no_hp = $request->no_hp;
        $alumni->alamat = $request->alamat;
        $alumni->status = $request->status;
        $alumni->nama_perusahaan = $request->nama_perusahaan;
        $alumni->nama_universitas = $request->nama_universitas;

        if ($request->filled('password')) {
            $alumni->password = Hash::make($request->password);
        }

        $alumni->save();

        return redirect()->route('data-pengguna')->with('success', 'Alumni berhasil diperbarui.');
    }

    // Pintar methods
    public function indexPerkembanganSekolah()
    {
        $perkembangan = PerkembanganSekolah::orderBy('tanggal_publikasi', 'desc')->get();
        $editing = null;
        if (request('edit')) {
            $editing = PerkembanganSekolah::find(request('edit'));
        }
        return view('admin.pintar.pintar', compact('perkembangan', 'editing'));
    }

    public function storePerkembanganSekolah(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images' => 'nullable|array|max:3',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description']);
        $data['tanggal_publikasi'] = now();

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('perkembangan_sekolah', 'public');
                $imagePaths[] = $imagePath;
            }
            $data['images'] = json_encode($imagePaths);
        }

        PerkembanganSekolah::create($data);

        return redirect()->route('admin.pintar.index')->with('success', 'Pintar berhasil ditambahkan.');
    }

    public function updatePerkembanganSekolah(Request $request, $id)
    {
        $perkembangan = PerkembanganSekolah::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images' => 'nullable|array|max:3',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['title', 'description']);
        $data['tanggal_publikasi'] = now();

        if ($request->hasFile('images')) {
            // Delete old images if exist
            if ($perkembangan->images) {
                $oldImages = json_decode($perkembangan->images, true);
                if (is_array($oldImages)) {
                    foreach ($oldImages as $oldImage) {
                        if (Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                }
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('perkembangan_sekolah', 'public');
                $imagePaths[] = $imagePath;
            }
            $data['images'] = json_encode($imagePaths);
        }

        $perkembangan->update($data);

        return redirect()->route('admin.pintar.index')->with('success', 'Pintar berhasil diperbarui.');
    }

    public function showPerkembanganSekolah($id)
    {
        $perkembangan = PerkembanganSekolah::findOrFail($id);
        return view('admin.pintar.show', compact('perkembangan'));
    }

    public function destroyPerkembanganSekolah($id)
    {
        $perkembangan = PerkembanganSekolah::findOrFail($id);

        // Delete images if exist
        if ($perkembangan->images) {
            $images = json_decode($perkembangan->images, true);
            if (is_array($images)) {
                foreach ($images as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
        }

        $perkembangan->delete();

        return redirect()->route('admin.pintar.index')->with('success', 'Pintar berhasil dihapus.');
    }

    public function getAlumniChartData(Request $request)
    {
        // Get alumni counts grouped by graduation year with optional filtering
        $alumniQuery = Alumni::select('tahun_lulusan', DB::raw('count(*) as total'))
            ->groupBy('tahun_lulusan')
            ->orderBy('tahun_lulusan', 'asc');

        // Apply year filters if provided
        if ($request->has('year_from') && $request->filled('year_from')) {
            $alumniQuery->where('tahun_lulusan', '>=', $request->year_from);
        }

        if ($request->has('year_to') && $request->filled('year_to')) {
            $alumniQuery->where('tahun_lulusan', '<=', $request->year_to);
        }

        $alumniByYear = $alumniQuery->get();

        $alumniYearLabels = $alumniByYear->pluck('tahun_lulusan')->map(function ($year) {
            return (string) $year;
        })->toArray();

        $alumniYearCounts = $alumniByYear->pluck('total')->toArray();

        return response()->json([
            'labels' => $alumniYearLabels,
            'data' => $alumniYearCounts
        ]);
    }
}
