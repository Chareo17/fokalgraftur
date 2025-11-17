<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'name', 'username', 'jurusan', 'nis', 'profile_image' ,'password', 'user_id',
        'last_login_at', 'is_online', 'last_activity_at',
    ];

    protected $hidden = [
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the activity status of the siswa.
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
