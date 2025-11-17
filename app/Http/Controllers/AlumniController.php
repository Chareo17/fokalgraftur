<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;

class AlumniController extends Controller
{
    /**
     * Display the data pengguna view with alumni and siswa data.
     *
     * @return \Illuminate\View\View
     */
    public function pengguna(Request $request)
    {
        $role = $request->query('role', 'all');
        $search = $request->query('search', '');
        $tahunLulusan = $request->query('tahun_lulusan', '');
        $jurusan = $request->query('jurusan', '');
        $status = $request->query('status', '');
        $perPageAlumni = $request->query('per_page', 10);
        $perPageSiswa = $request->query('per_page_siswa', 10);

        // Validate and sanitize perPageAlumni to be integer >= 0
        if (!is_numeric($perPageAlumni) || intval($perPageAlumni) < 0) {
            $perPageAlumni = 10;
        } else {
            $perPageAlumni = intval($perPageAlumni);
        }

        // Validate and sanitize perPageSiswa to be integer >= 0
        if (!is_numeric($perPageSiswa) || intval($perPageSiswa) < 0) {
            $perPageSiswa = 10;
        } else {
            $perPageSiswa = intval($perPageSiswa);
        }

        $alumniQuery = Alumni::query();
        $siswaQuery = \App\Models\Siswa::query();

        if (!empty($search)) {
            $alumniQuery->where('name', 'like', '%' . $search . '%');
            $siswaQuery->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($tahunLulusan)) {
            $alumniQuery->where('tahun_lulusan', $tahunLulusan);
        }

        if (!empty($tanggalLahir = $request->query('tanggal_lahir', ''))) {
            $alumniQuery->whereDate('tanggal_lahir', $tanggalLahir);
        }

        if (!empty($jurusan)) {
            $alumniQuery->where('jurusan', 'like', '%' . $jurusan . '%');
        }

        if (!empty($status)) {
            $alumniQuery->where('status', $status);
        }

        $totalAlumniByYear = null;
        if (!empty($tahunLulusan)) {
            $totalAlumniByYear = $alumniQuery->count();
        }

        // Handle perPage = 0 as no pagination (show all)
        if ($perPageAlumni === 0 || $perPageSiswa === 0) {
            if ($role === 'alumni') {
                $alumni = $alumniQuery->get();
                $siswa = collect(); // empty collection
            } elseif ($role === 'siswa') {
                $alumni = collect(); // empty collection
                $siswa = $siswaQuery->get();
            } else {
                $alumni = $alumniQuery->get();
                $siswa = $siswaQuery->get();
            }
        } else {
            if ($role === 'alumni') {
                $alumni = $alumniQuery->paginate($perPageAlumni)->appends($request->query());
                $siswa = collect(); // empty collection
            } elseif ($role === 'siswa') {
                $alumni = collect(); // empty collection
                $siswa = $siswaQuery->paginate($perPageSiswa)->appends($request->query());
            } else {
                $alumni = $alumniQuery->paginate($perPageAlumni)->appends($request->query());
                $siswa = $siswaQuery->paginate($perPageSiswa)->appends($request->query());
            }
        }

return view('data-pengguna', compact('alumni', 'siswa', 'role', 'search', 'tahunLulusan', 'jurusan', 'status', 'totalAlumniByYear', 'perPageAlumni'));
    }

    /**
     * Store a newly created alumni in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:alumni,username',
            'user_type' => 'required|in:alumni,siswa',
            'jurusan' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'tanggal_lahir' => 'nullable|date',
            'tahun_lulusan' => 'nullable|integer',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:25',
            'nama_perusahaan' => 'nullable|string|max:255',
            'nama_universitas' => 'nullable|string|max:255',
            'nis' => 'nullable|string|max:20',
            'ijazah_files.*' => 'nullable|file|mimes:pdf,jpeg,jpg,png,doc,docx|max:5120', // 5MB max per file
        ], [
            'ijazah_files.*.mimes' => 'Format file tidak didukung. Format yang didukung: PDF, JPG, PNG, DOC, DOCX.',
            'ijazah_files.*.max' => 'Ukuran file maksimal 5MB per file.',
            'username.unique' => 'Username sudah digunakan.',
        ]);

        // Handle file uploads first
        $ijazahPaths = [];
        if ($request->hasFile('ijazah_files')) {
            $files = $request->file('ijazah_files');

            // Validate maximum 5 files
            if (count($files) > 5) {
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
                        \Illuminate\Support\Facades\Log::info("Ijazah file uploaded successfully: {$path}");
                    } else {
                        \Illuminate\Support\Facades\Log::error("Failed to store ijazah file: {$file->getClientOriginalName()}");
                        return redirect()->back()->withErrors(['ijazah_files' => 'Gagal mengunggah file: ' . $file->getClientOriginalName()])->withInput();
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error("Error uploading ijazah file {$file->getClientOriginalName()}: " . $e->getMessage());
                    return redirect()->back()->withErrors(['ijazah_files' => 'Error mengunggah file: ' . $file->getClientOriginalName() . ' - ' . $e->getMessage()])->withInput();
                }
            }
        }

        // Create user based on type
        if ($request->user_type === 'alumni') {
            $alumni = Alumni::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'jurusan' => $request->jurusan,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tahun_lulusan' => $request->tahun_lulusan,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'status' => $request->status,
                'nama_perusahaan' => $request->nama_perusahaan,
                'nama_universitas' => $request->nama_universitas,
                'ijazah' => !empty($ijazahPaths) ? json_encode($ijazahPaths) : null,
            ]);

            $message = 'Alumni berhasil ditambahkan.';
        } else {
            // Create siswa
            $siswa = \App\Models\Siswa::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'jurusan' => $request->jurusan,
                'nis' => $request->nis,
            ]);

            $message = 'Siswa berhasil ditambahkan.';
        }

        return redirect()->route('data-pengguna')->with('success', $message);
    }

    /**
     * Update the specified alumni in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:alumni,id',
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tahun_lulusan' => 'nullable|integer',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:25',
            'nama_perusahaan' => 'nullable|string|max:255',
            'nama_universitas' => 'nullable|string|max:255',
            'ijazah_files.*' => 'nullable|file|mimes:pdf,jpeg,jpg,png,doc,docx|max:5120', // 5MB max per file
        ], [
            'ijazah_files.*.mimes' => 'Format file tidak didukung. Format yang didukung: PDF, JPG, PNG, DOC, DOCX.',
            'ijazah_files.*.max' => 'Ukuran file maksimal 5MB per file.',
        ]);

        $alumni = Alumni::findOrFail($request->id);

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

            // Validate maximum 5 files total (existing + new)
            $newFileCount = count($files);
            $existingFileCount = count($ijazahPaths);
            if (($existingFileCount + $newFileCount) > 5) {
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
                        \Illuminate\Support\Facades\Log::info("Ijazah file uploaded successfully (update): {$path}");
                    } else {
                        \Illuminate\Support\Facades\Log::error("Failed to store ijazah file (update): {$file->getClientOriginalName()}");
                        return redirect()->back()->withErrors(['ijazah_files' => 'Gagal mengunggah file: ' . $file->getClientOriginalName()])->withInput();
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error("Error uploading ijazah file (update) {$file->getClientOriginalName()}: " . $e->getMessage());
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
        $alumni->save();

        return redirect()->route('data-pengguna')->with('success', 'Alumni berhasil diperbarui.');
    }

    /**
     * Get ijazah files for a specific alumni.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIjazah($id)
    {
        $alumni = Alumni::findOrFail($id);

        if (!$alumni->ijazah) {
            return response()->json(['files' => []]);
        }

        $ijazahFiles = json_decode($alumni->ijazah, true);
        $files = [];

        if (is_array($ijazahFiles)) {
            foreach ($ijazahFiles as $filePath) {
                // Ensure the file exists before adding it to the response
                $fullPath = storage_path('app/public/' . $filePath);
                if (file_exists($fullPath)) {
                    $files[] = [
                        'name' => basename($filePath),
                        'path' => asset('storage/' . $filePath),
                        'size' => $this->getFileSize($filePath)
                    ];
                } else {
                    // Log missing file for debugging
                    \Illuminate\Support\Facades\Log::warning("Ijazah file not found: {$filePath}");
                }
            }
        }

        return response()->json(['files' => $files]);
    }

    /**
     * Get file size for a given file path.
     *
     * @param  string  $filePath
     * @return string
     */
    private function getFileSize($filePath)
    {
        $fullPath = storage_path('app/public/' . $filePath);

        if (file_exists($fullPath)) {
            $bytes = filesize($fullPath);
            $units = ['B', 'KB', 'MB', 'GB'];

            for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
                $bytes /= 1024;
            }

            return round($bytes, 2) . ' ' . $units[$i];
        }

        return 'Unknown';
    }
}
