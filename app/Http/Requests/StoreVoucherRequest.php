<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreVoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check direct admin guard
        if (Auth::guard('admin')->check()) {
            return true;
        }

        // Check if alumni or siswa has admin role
        $user = $this->getCurrentUser();
        return $user && isset($user->role) && $user->role === 'admin';
    }

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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255|unique:vouchers,judul',
            'tipe_diskon' => 'required|in:percentage,fixed',
            'diskon' => 'required|integer|min:1|max:100',
            'minimal_belanja' => 'nullable|integer|min:0',
            'tanggal_kadaluarsa' => 'required|date|after:tomorrow',
            'batas_penggunaan' => 'nullable|integer|min:1',
            'deskripsi' => 'required|string|max:1000',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul voucher wajib diisi.',
            'judul.unique' => 'Judul voucher sudah digunakan.',
            'tipe_diskon.required' => 'Tipe diskon wajib dipilih.',
            'tipe_diskon.in' => 'Tipe diskon tidak valid.',
            'diskon.required' => 'Nilai diskon wajib diisi.',
            'diskon.integer' => 'Nilai diskon harus berupa angka.',
            'diskon.min' => 'Nilai diskon minimal 1.',
            'diskon.max' => 'Nilai diskon maksimal 100.',
            'minimal_belanja.integer' => 'Minimal belanja harus berupa angka.',
            'minimal_belanja.min' => 'Minimal belanja tidak boleh negatif.',
            'tanggal_kadaluarsa.required' => 'Tanggal kadaluarsa wajib diisi.',
            'tanggal_kadaluarsa.after' => 'Tanggal kadaluarsa harus setelah besok.',
            'batas_penggunaan.integer' => 'Batas penggunaan harus berupa angka.',
            'batas_penggunaan.min' => 'Batas penggunaan minimal 1.',
            'deskripsi.required' => 'Deskripsi voucher wajib diisi.',
            'deskripsi.max' => 'Deskripsi maksimal 1000 karakter.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
