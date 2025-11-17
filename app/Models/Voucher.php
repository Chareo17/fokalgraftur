<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use App\Models\User;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'diskon',
        'tipe_diskon',
        'minimal_belanja',
        'tanggal_kadaluarsa',
        'deskripsi',
        'gambar',
        'batas_penggunaan',
        'status',
        'dibuat_oleh',
        'jumlah_digunakan'
    ];

    protected $casts = [
        'tanggal_kadaluarsa' => 'date',
        'minimal_belanja' => 'integer',
        'diskon' => 'integer',
        'batas_penggunaan' => 'integer',
        'jumlah_digunakan' => 'integer'
    ];

    /**
     * Get the user who created this voucher
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    /**
     * Get all usages of this voucher
     */
    public function usages(): HasMany
    {
        return $this->hasMany(\App\Models\VoucherUsage::class);
    }

    /**
     * Check if voucher is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active' &&
               (!$this->batas_penggunaan || $this->usages()->count() < $this->batas_penggunaan) &&
               $this->tanggal_kadaluarsa >= Carbon::today();
    }

    /**
     * Check if voucher is expired
     */
    public function isExpired(): bool
    {
        return $this->tanggal_kadaluarsa < Carbon::today() ||
               ($this->batas_penggunaan && $this->usages()->count() >= $this->batas_penggunaan);
    }

    /**
     * Get formatted discount value
     */
    public function getFormattedDiscountAttribute(): string
    {
        if ($this->tipe_diskon === 'percentage') {
            return $this->diskon . '%';
        } else {
            return 'Rp ' . number_format($this->diskon, 0, ',', '.');
        }
    }

    /**
     * Get formatted minimum purchase
     */
    public function getFormattedMinimalBelanjaAttribute(): string
    {
        if (!$this->minimal_belanja) {
            return 'Tanpa minimum belanja';
        }
        return 'Rp ' . number_format($this->minimal_belanja, 0, ',', '.');
    }

    /**
     * Get usage status text
     */
    public function getUsageStatusAttribute(): string
    {
        if (!$this->batas_penggunaan) {
            return 'Tidak terbatas';
        }
        return $this->usages()->count() . '/' . $this->batas_penggunaan;
    }

    /**
     * Check if a specific user has already used this voucher
     * Supports different user types (admin, alumni, siswa)
     */
    public function isUsedByUser(?int $userId, ?string $userType = null): bool
    {
        if (!$userId) {
            return false;
        }

        $query = \App\Models\VoucherUsage::where('voucher_id', $this->id)
                           ->where('user_id', $userId);

        // If user type is specified, also check user_type
        if ($userType) {
            $query->where('user_type', $userType);
        }

        return $query->exists();
    }

    /**
     * Get the current usage count for this voucher
     */
    public function getCurrentUsageCount(): int
    {
        return $this->usages()->count();
    }

    /**
     * Scope for active vouchers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('tanggal_kadaluarsa', '>=', Carbon::today())
                    ->where(function ($q) {
                        $q->whereNull('batas_penggunaan')
                          ->orWhereRaw('(SELECT COUNT(*) FROM voucher_usages WHERE voucher_usages.voucher_id = vouchers.id) < batas_penggunaan');
                    });
    }

    /**
     * Scope for expired vouchers
     */
    public function scopeExpired($query)
    {
        return $query->where(function ($q) {
            $q->where('tanggal_kadaluarsa', '<', Carbon::today())
              ->orWhere(function ($q2) {
                  $q2->whereNotNull('batas_penggunaan')
                     ->whereRaw('(SELECT COUNT(*) FROM voucher_usages WHERE voucher_usages.voucher_id = vouchers.id) >= batas_penggunaan');
              });
        });
    }
}
