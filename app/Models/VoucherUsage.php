<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;


class VoucherUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'voucher_id',
        'used_at',
        'downloaded'
    ];

    protected $casts = [
        'used_at' => 'datetime',
        'downloaded' => 'boolean'
    ];

    /**
     * Get the user who used this voucher (polymorphic relationship for different user types)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the alumni who used this voucher
     */
    public function alumni(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Alumni::class, 'user_id');
    }

    /**
     * Get the siswa who used this voucher
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Siswa::class, 'user_id');
    }

    /**
     * Get the admin who used this voucher
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin::class, 'user_id');
    }

    /**
     * Get the voucher that was used
     */
    public function voucher(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Voucher::class);
    }
}
