<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use App\Http\Requests\StoreVoucherRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class VoucherController extends Controller
{
    /**
     * Get the current authenticated user from any guard
     */
    private function getCurrentUser()
    {
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $user->user_type = 'admin';
            return $user;
        } elseif (Auth::guard('alumni')->check()) {
            $user = Auth::guard('alumni')->user();
            $user->user_type = 'alumni';
            return $user;
        } elseif (Auth::guard('siswa')->check()) {
            $user = Auth::guard('siswa')->user();
            $user->user_type = 'siswa';
            return $user;
        } elseif (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            $user->user_type = 'user';
            return $user;
        }

        return null;
    }

    /**
     * Check if current user is admin
     */
    private function isCurrentUserAdmin(): bool
    {
        // Check direct admin guard
        if (Auth::guard('admin')->check()) {
            return true;
        }

        // Check if alumni or siswa has admin role (though unlikely in this system)
        $user = $this->getCurrentUser();
        return $user && isset($user->role) && $user->role === 'admin';
    }

    /**
     * Check if current user is logged in (any guard)
     */
    private function isCurrentUserLoggedIn(): bool
    {
        return Auth::guard('admin')->check() ||
               Auth::guard('alumni')->check() ||
               Auth::guard('siswa')->check() ||
               Auth::guard('web')->check();
    }

    /**
     * Display the voucher management page
     */
    public function index(): View
    {
        $currentUser = $this->getCurrentUser();
        $isAdmin = $this->isCurrentUserAdmin();
        $isLoggedIn = $this->isCurrentUserLoggedIn();

        // Get vouchers with pagination
        $vouchers = Voucher::orderBy('created_at', 'desc')->paginate(12);

        // Add is_used_by_current_user flag
        if ($currentUser) {
            foreach ($vouchers as $voucher) {
                $voucher->is_used_by_current_user = $voucher->isUsedByUser($currentUser->id);
            }
        }

        return view('voucher', compact('vouchers', 'isAdmin', 'isLoggedIn'));
    }

    /**
     * Store a new voucher
     */
    public function store(StoreVoucherRequest $request): JsonResponse
    {
        try {
            // Check if current user is admin
            if (!$this->isCurrentUserAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: Only admin can create vouchers'
                ], 403);
            }

            $validated = $request->validated();

            // Handle file upload
            $gambarPath = null;
            if ($request->hasFile('gambar')) {
                $gambarPath = $request->file('gambar')->store('vouchers', 'public');
            }

            // Create voucher
            $voucher = Voucher::create([
                'judul' => $validated['judul'],
                'diskon' => $validated['diskon'],
                'tipe_diskon' => $validated['tipe_diskon'],
                'minimal_belanja' => $validated['minimal_belanja'] ?? null,
                'tanggal_kadaluarsa' => $validated['tanggal_kadaluarsa'],
                'deskripsi' => $validated['deskripsi'],
                'gambar' => $gambarPath,
                'batas_penggunaan' => $validated['batas_penggunaan'] ?? null,
                'status' => 'active',
                'dibuat_oleh' => $this->getCurrentUser()->id,
                'jumlah_digunakan' => 0
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Voucher berhasil dibuat!',
                'voucher' => $voucher
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to create voucher: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat voucher'
            ], 500);
        }
    }

    /**
     * Display a specific voucher
     */
    public function show(Voucher $voucher): JsonResponse
    {
        return response()->json([
            'success' => true,
            'voucher' => $voucher->load('creator')
        ]);
    }

    /**
     * Update a voucher
     */
    public function update(Request $request, Voucher $voucher): JsonResponse
    {
        try {
            // Check if current user is admin
            if (!$this->isCurrentUserAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: Only admin can update vouchers'
                ], 403);
            }

            $request->validate([
                'judul' => 'required|string|max:255|unique:vouchers,judul,' . $voucher->id,
                'tipe_diskon' => 'required|in:percentage,fixed',
                'diskon' => 'required|integer|min:1|max:100',
                'minimal_belanja' => 'nullable|integer|min:0',
                'tanggal_kadaluarsa' => 'required|date|after:today',
                'batas_penggunaan' => 'nullable|integer|min:1',
                'deskripsi' => 'required|string',
                'status' => 'required|in:active,inactive',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only([
                'judul', 'tipe_diskon', 'diskon', 'minimal_belanja',
                'tanggal_kadaluarsa', 'batas_penggunaan', 'deskripsi', 'status'
            ]);

            // Handle file upload
            if ($request->hasFile('gambar')) {
                // Delete old image
                if ($voucher->gambar && Storage::disk('public')->exists($voucher->gambar)) {
                    Storage::disk('public')->delete($voucher->gambar);
                }
                $path = $request->file('gambar')->store('vouchers', 'public');
                $data['gambar'] = $path;
            }

            $voucher->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Voucher berhasil diperbarui',
                'voucher' => $voucher
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Failed to update voucher: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui voucher'
            ], 500);
        }
    }

    /**
     * Delete a voucher
     */
    public function destroy(Voucher $voucher): JsonResponse
    {
        try {
            // Check if current user is admin
            if (!$this->isCurrentUserAdmin()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized: Only admin can delete vouchers'
                ], 403);
            }

            // Delete image file
            if ($voucher->gambar && Storage::disk('public')->exists($voucher->gambar)) {
                Storage::disk('public')->delete($voucher->gambar);
            }

            // Delete voucher usages
            $voucher->usages()->delete();

            $voucher->delete();

            return response()->json([
                'success' => true,
                'message' => 'Voucher berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to delete voucher: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus voucher'
            ], 500);
        }
    }

    /**
     * Get active vouchers for API
     */
    public function getActiveVouchers(): JsonResponse
    {
        $vouchers = Voucher::active()->get();

        $user = $this->getCurrentUser();
        if ($user) {
            foreach ($vouchers as $voucher) {
                $voucher->is_used_by_current_user = $voucher->isUsedByUser($user->id);
            }
        }

        return response()->json([
            'success' => true,
            'vouchers' => $vouchers
        ]);
    }

    /**
     * Use a voucher (download)
     */
    public function useVoucher(Request $request): BinaryFileResponse|JsonResponse
    {
        try {
            $request->validate([
                'voucher_id' => 'required|exists:vouchers,id'
            ]);

            $voucher = Voucher::findOrFail($request->voucher_id);
            $user = $this->getCurrentUser();

            // Ensure user is authenticated
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Check if voucher is active
            if (!$voucher->isActive()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Voucher tidak aktif atau sudah kedaluwarsa'
                ], 400);
            }

            // Check if user already used this voucher
            if ($voucher->isUsedByUser($user->id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah menggunakan voucher ini'
                ], 400);
            }

            // Create usage record
            VoucherUsage::create([
                'user_id' => $user->id,
                'user_type' => $user->user_type,
                'voucher_id' => $voucher->id,
                'used_at' => now(),
                'downloaded' => true
            ]);

            // Increment usage count
            $voucher->increment('jumlah_digunakan');

            // If image exists, trigger file download directly; otherwise return success JSON fallback
            if ($voucher->gambar && Storage::disk('public')->exists($voucher->gambar)) {
                $absPath = null;
                try {
                    $absPath = Storage::disk('public')->path($voucher->gambar);
                } catch (\Throwable $e) {
                    $absPath = null;
                }

                if ($absPath && file_exists($absPath)) {
                    $size = @filesize($absPath) ?: 0;
                    if ($size <= 0) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Voucher berhasil digunakan, namun file voucher rusak atau kosong',
                            'voucher' => $voucher->only(['id', 'judul', 'diskon', 'tipe_diskon'])
                        ]);
                    }

                    $ext = pathinfo($absPath, PATHINFO_EXTENSION) ?: 'bin';
                    $filename = 'voucher-' . $voucher->id . '.' . $ext;

                    // Determine MIME using finfo for better accuracy
                    $mime = 'application/octet-stream';
                    if (function_exists('finfo_open')) {
                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        if ($finfo) {
                            $detected = @finfo_file($finfo, $absPath);
                            if ($detected) {
                                $mime = $detected;
                            }
                            finfo_close($finfo);
                        }
                    }

                    return response()->download($absPath, $filename, [
                        'Content-Type' => $mime,
                        'Content-Length' => (string) $size,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Voucher berhasil digunakan, namun file voucher tidak tersedia untuk diunduh',
                'voucher' => $voucher->only(['id', 'judul', 'diskon', 'tipe_diskon'])
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to use voucher: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menggunakan voucher'
            ], 500);
        }
    }
}
