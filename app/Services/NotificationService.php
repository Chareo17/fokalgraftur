<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationService
{
    /**
     * Get latest berita uploads.
     *
     * @param int|null $limit
     * @return \Illuminate\Support\Collection
     */
    public function getLatestBeritaUploads(?int $limit = 5)
    {
        $query = DB::table('berita')
            ->select('id', 'judul', 'name', 'gambar', 'created_at', 'updated_at')
            ->orderBy('created_at', 'desc');

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get latest undangan based on user role.
     *
     * @param string $userRole
     * @param int|null $limit
     * @return \Illuminate\Support\Collection
     */
    public function getLatestUndangan($userRole, ?int $limit = 5)
    {
        $query = DB::table('undangan')
            ->select('id', 'judul', 'name', 'gambar', 'role_target', 'created_at', 'updated_at')
            ->whereJsonContains('role_target', $userRole)
            ->orderBy('created_at', 'desc');

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get latest validated donations for a user.
     *
     * @param int $userId
     * @param int|null $limit
     * @return \Illuminate\Support\Collection
     */
    public function getLatestValidatedDonations($userId, ?int $limit = 5)
    {
        // Use Eloquent to eager load user relation for profile_image
        $query = \App\Models\Donasi::with('user')
            ->whereIn('status', ['divalidasi', 'ditolak'])
            ->where('user_id', $userId)
            ->orderBy('updated_at', 'desc');

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query->get();
    }

    /**
     * Get unread notification count based on user role and ID.
     *
     * @param string $role
     * @param int $userId
     * @return int
     */
    public function getUnreadCount($role, $userId)
    {
        // Get berita within 1 month
        $berita = $this->getLatestBeritaUploads(null)->filter(function ($item) {
            return Carbon::parse($item->updated_at)->gte(Carbon::now()->subMonth());
        });

        // Get undangan within 1 month based on user role
        $undangan = $this->getLatestUndangan($role, null)->filter(function ($item) {
            return Carbon::parse($item->updated_at)->gte(Carbon::now()->subMonth());
        });

        // Get validated donations within 1 month
        $donations = $this->getLatestValidatedDonations($userId, null)->filter(function ($item) {
            return Carbon::parse($item->updated_at)->gte(Carbon::now()->subMonth());
        });

        $count = 0;
        $readAt = session('notifications_read_at');

        foreach ($berita as $item) {
            if (!$readAt || strtotime($item->updated_at) > strtotime($readAt)) {
                $count++;
            }
        }

        foreach ($undangan as $item) {
            if (!$readAt || strtotime($item->updated_at) > strtotime($readAt)) {
                $count++;
            }
        }

        foreach ($donations as $item) {
            if (!$readAt || strtotime($item->updated_at) > strtotime($readAt)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Get recent notifications (up to 1 month old) based on user role and ID.
     *
     * @param string $role
     * @param int $userId
     * @return \Illuminate\Support\Collection
     */
    public function getRecentNotifications($role, $userId)
    {
        // Get berita within 1 month
        $berita = $this->getLatestBeritaUploads(null)->filter(function ($item) {
            return Carbon::parse($item->updated_at)->gte(Carbon::now()->subMonth());
        });

        // Get undangan within 1 month based on user role
        $undangan = $this->getLatestUndangan($role, null)->filter(function ($item) {
            return Carbon::parse($item->updated_at)->gte(Carbon::now()->subMonth());
        });

        // Get validated donations within 1 month
        $donations = $this->getLatestValidatedDonations($userId, null)->filter(function ($item) {
            return Carbon::parse($item->updated_at)->gte(Carbon::now()->subMonth());
        });

        $notifications = collect();

        foreach ($berita as $item) {
            $notifications->push([
                'type' => 'berita',
                'title' => $item->judul,
                'author' => $item->name ?? 'Admin',
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'id' => $item->id,
                'profile_image' => $item->gambar ? asset('storage/' . $item->gambar) : asset('assets/img/avatar-1.webp'),
            ]);
        }

        foreach ($undangan as $item) {
            $notifications->push([
                'type' => 'undangan',
                'title' => $item->judul,
                'author' => $item->name ?? 'Admin',
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'id' => $item->id,
                'role_target' => json_decode($item->role_target, true),
                'profile_image' => $item->gambar ? asset('storage/' . $item->gambar) : asset('assets/img/avatar-1.webp'),
                'download_url' => route('undangan.download-pdf', $item->id),
            ]);
        }

        foreach ($donations as $item) {
            $notifications->push([
                'type' => 'donasi',
                'name' => $item->nama,
                'nominal' => $item->nominal,
                'updated_at' => $item->updated_at,
                'id' => $item->id,
                'status' => $item->status,
                'profile_image' => $item->user && $item->user->profile_image ? asset('storage/' . $item->user->profile_image) : asset('assets/img/avatar-1.webp'),
            ]);
        }

        // Sort by latest update, limit to 50
        $sorted = $notifications->sortByDesc(function ($notif) {
            return strtotime($notif['updated_at']);
        })->take(50);

        return $sorted->values();
    }
}
