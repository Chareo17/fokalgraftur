<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'alumni';
    protected $fillable = [
        'name',
        'tanggal_lahir',
        'alamat',
        'username',
        'jurusan',
        'tahun_lulusan',
        'nia',
        'no_hp',
        'status',
        'nama_perusahaan',
        'nama_universitas',
        'password',
        'digital_card_available',
        'user_id',
        'ijazah',
        'profile_image',
        'last_login_at',
        'is_online',
        'last_activity_at',
    ];

    /**
     * Generate a new NIA based on the graduation year.
     *
     * @param int $tahunLulusan
     * @return string
     */
    public static function generateNia(int $tahunLulusan, string $jurusan): string
    {
        // Map jurusan to codes
        $jurusanCodes = [
            'Teknik Grafika' => '01',
            'Desain Komunikasi Visual' => '02',
            'Teknik Komputer dan Jaringan' => '03',
        ];

        $jurusanCode = $jurusanCodes[$jurusan] ?? '00'; // default to '00' if not found

        $prefix = $tahunLulusan . $jurusanCode;

        // Find last nia with this prefix
        $lastNia = self::where('nia', 'like', $prefix . '%')
            ->orderBy('nia', 'desc')
            ->value('nia');

        if ($lastNia) {
            // Extract last 3 digits as sequence
            $lastSequence = (int)substr($lastNia, -3);
            $newSequence = $lastSequence + 1;
        } else {
            $newSequence = 1;
        }

        return $prefix . str_pad($newSequence, 3, '0', STR_PAD_LEFT);
    }

    protected $hidden = [
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the activity status of the alumni.
     *
     * @return string
     */
    public function getActivityStatusAttribute()
    {
        if ($this->is_online) {
            return 'Online';
        }

        if ($this->last_activity_at) {
            $minutesAgo = now()->diffInMinutes($this->last_activity_at);
            if ($minutesAgo < 1) {
                return 'Baru saja online';
            } elseif ($minutesAgo < 60) {
                return $minutesAgo . ' menit yang lalu';
            } elseif ($minutesAgo < 1440) { // 24 hours
                $hoursAgo = floor($minutesAgo / 60);
                return $hoursAgo . ' jam yang lalu';
            } else {
                $daysAgo = floor($minutesAgo / 1440);
                return $daysAgo . ' hari yang lalu';
            }
        }

        return 'Belum pernah login';
    }

    /**
     * Get the activity status color for UI.
     *
     * @return string
     */
    public function getActivityStatusColorAttribute()
    {
        if ($this->is_online) {
            return 'success'; // green
        }

        if ($this->last_activity_at) {
            $minutesAgo = now()->diffInMinutes($this->last_activity_at);
            if ($minutesAgo < 60) {
                return 'warning'; // yellow for recent activity
            } else {
                return 'secondary'; // gray for older activity
            }
        }

        return 'light'; // light gray for never logged in
    }

    /**
     * Update the last activity timestamp.
     */
    public function updateLastActivity()
    {
        $this->update([
            'last_activity_at' => now(),
            'is_online' => true
        ]);
    }

    /**
     * Mark user as offline.
     */
    public function markAsOffline()
    {
        $this->update([
            'is_online' => false
        ]);
    }
}
