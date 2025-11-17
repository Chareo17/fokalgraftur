<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Alumni;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;

class ProfilController extends Controller
{
    // Menampilkan halaman profil
    public function show()
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login');
        }
    
        $profile = Alumni::where('name', $user->name)->first();
    
        if ($profile) {
            $profile->role = 'alumni';
        } else {
            $profile = Siswa::where('name', $user->name)->first();
            $profile->role = 'siswa';
        }
    
        return view('profil', compact('profile'));
    }
    
    // Menampilkan halaman edit profil
    public function edit()
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        // Cari profil di alumni
        $profile = Alumni::where('name', $user->name)->first();
        if ($profile) {
            $profile->role = 'alumni';
        } else {
            // Kalau bukan alumni, cari di siswa
            $profile = Siswa::where('name', $user->name)->first();
            $profile->role = 'siswa';
        }

        return view('edit-profile', compact('profile'));
    }

    // Show the password change form
    public function changePasswordForm()
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        return view('change-password');
    }

    // Handle the password update
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login');
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }

        // Update password based on user role
        $hashedPassword = Hash::make($request->password);

        if ($user instanceof \App\Models\Alumni) {
            DB::table('alumni')->where('id', $user->id)->update(['password' => $hashedPassword]);
        } elseif ($user instanceof \App\Models\Siswa) {
            DB::table('siswa')->where('id', $user->id)->update(['password' => $hashedPassword]);
        } else {
            DB::table('users')->where('id', $user->id)->update(['password' => $hashedPassword]);
        }

        return redirect()->route('profil')->with('success', 'Password berhasil diubah.');
    }


    // Menangani update profil
    public function update(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login');
        }
    
        // Ambil data berdasarkan role
        $profile = Alumni::where('name', $user->name)->first();
        $isAlumni = true;
    
        if (!$profile) {
            $profile = Siswa::where('name', $user->name)->first();
            $isAlumni = false;
        }
    
        // Validasi sesuai jenis pengguna
        $rules = [
            'name' => ['required', 'string', 'max:35', 'regex:/^[\pL\s]+$/u'],
            'jurusan' => ['nullable', 'string', 'regex:/^[\pL\s]+$/u'],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ];
    
        if ($isAlumni) {
            $rules['alamat'] = 'nullable|string|max:255';
            $rules['tahun_lulusan'] = 'nullable|integer';
            $rules['tanggal_lahir'] = 'nullable|date';
            $rules['status'] = 'nullable|in:Bekerja,Tidak Bekerja,Studi Lanjut';
            $rules['nama_perusahaan'] = ['nullable', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'];
            $rules['universitas'] = ['nullable', 'string', 'max:50', 'regex:/^[\pL\s]+$/u'];
            $rules['no_hp'] = 'nullable|string|max:20'; // Add validation for no_hp
            $rules['username'] = ['required', 'string', 'max:35', 'regex:/^\S*$/u'];
        } else {
            $rules['username'] = ['required', 'string', 'max:35', 'regex:/^\S*$/u'];
            $rules['nis'] = 'required|string|max:50';
        }
    
        $messages = [
            'alamat.max' => 'Alamat tidak boleh lebih dari 50 karakter.',
            'tahun_lulusan.integer' => 'Tahun lulusan harus berupa angka.',
            'status.in' => 'Status harus salah satu dari: Bekerja, Tidak Bekerja, Studi Lanjut.',
            'nama_perusahaan.max' => 'Nama perusahaan tidak boleh lebih dari 50 karakter.',
            'universitas.max' => 'Nama universitas tidak boleh lebih dari 50 karakter.',
            'no_hp.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'jurusan.max' => 'Jurusan tidak boleh lebih dari 20 karakter.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'nis.max' => 'NIS tidak boleh lebih dari 50 karakter.',
            'name.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
            'jurusan.regex' => 'Jurusan hanya boleh berisi huruf dan spasi.',
            'nama_perusahaan.regex' => 'Nama perusahaan hanya boleh berisi huruf dan spasi.',
            'universitas.regex' => 'Nama universitas hanya boleh berisi huruf dan spasi.',
            'username.required' => 'Username wajib diisi.',
            'username.regex' => 'Username tidak boleh mengandung spasi.',
            'profile_image.max' => 'Ukuran gambar profil tidak boleh lebih dari 5 MB.',
        ];

        $validatedData = $request->validate($rules, $messages);
    
        // Upload foto profil jika ada
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/profile_images', $imageName);
            $validatedData['profile_image'] = 'profile_images/' . $imageName;
            $profile->profile_image = $validatedData['profile_image'];
            unset($validatedData['profile_image']);
        }
    
        // Alumni: ubah universitas & status
        if ($isAlumni) {
            if (isset($validatedData['universitas'])) {
                $validatedData['nama_universitas'] = $validatedData['universitas'];
                unset($validatedData['universitas']);
            }
    
            if (isset($validatedData['status'])) {
                DB::update('UPDATE alumni SET status = ? WHERE id = ?', [
                    trim($validatedData['status']), $profile->id
                ]);
                unset($validatedData['status']);
            }

            // Ensure nama_perusahaan, no_hp, and tanggal_lahir are updated
            if (isset($validatedData['nama_perusahaan'])) {
                $profile->nama_perusahaan = $validatedData['nama_perusahaan'];
                unset($validatedData['nama_perusahaan']);
            }
            if (isset($validatedData['no_hp'])) {
                $profile->no_hp = $validatedData['no_hp'];
                unset($validatedData['no_hp']);
            }
            if (isset($validatedData['tanggal_lahir'])) {
                $profile->tanggal_lahir = $validatedData['tanggal_lahir'];
                unset($validatedData['tanggal_lahir']);
            }
        }
    
        // Update data
        $profile->update($validatedData);
        $profile->save();
    
        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }

    // Download digital card
    public function downloadDigitalCard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $profile = Alumni::where('name', $user->name)->first();

        if (!$profile || !$profile->digital_card_available) {
            return redirect()->route('profil')->with('error', 'Digital card not available.');
        }

        $pdf = Pdf::loadView('pdf.digital_card', compact('profile'));
        return $pdf->download('Kartu_Digital_Alumni.pdf');
    }

    // Download ijazah
    public function downloadIjazah()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Silakan login terlebih dahulu.'], 401);
            }

            $profile = Alumni::where('name', $user->name)->first();

            if (!$profile) {
                return response()->json(['error' => 'Profile tidak ditemukan. Pastikan Anda login sebagai alumni.'], 404);
            }

            if (!$profile->ijazah) {
                return response()->json(['error' => 'File ijazah tidak tersedia di profil Anda.'], 404);
            }

            // Handle both single file path and array of file paths
            $ijazahFiles = $profile->ijazah;

            // Check if it's a JSON string and decode it
            if (is_string($ijazahFiles) && strpos($ijazahFiles, '[') === 0) {
                $decodedFiles = json_decode($ijazahFiles, true);
                if (is_array($decodedFiles) && !empty($decodedFiles)) {
                    $ijazahFiles = $decodedFiles;
                }
            }

            if (is_array($ijazahFiles) && !empty($ijazahFiles)) {
                // If multiple files, download the first one
                $ijazahPath = $ijazahFiles[0];
            } elseif (is_string($ijazahFiles)) {
                // Single file path
                $ijazahPath = $ijazahFiles;
            } else {
                return response()->json(['error' => 'Format file ijazah tidak valid.'], 400);
            }

            $filePath = storage_path('app/public/' . $ijazahPath);

            if (!file_exists($filePath)) {
                return response()->json(['error' => 'File ijazah tidak ditemukan di server. Path: ' . $filePath], 404);
            }

            $fileName = $profile->name . '_ijazah.' . pathinfo($filePath, PATHINFO_EXTENSION);

            return response()->download($filePath, $fileName);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
