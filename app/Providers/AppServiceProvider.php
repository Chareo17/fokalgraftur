<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set Carbon locale to Indonesian
        \Carbon\Carbon::setLocale('id');

        // View composer to inject notifications into navbar
        View::composer('partials.navbar', function ($view) {
            $notifications = collect();
            $notificationCount = 0;
            $role = null;
            $userId = null;
            $authStatus = [];

            // Debug: Check all guards
            $authStatus['admin'] = Auth::guard('admin')->check();
            $authStatus['alumni'] = Auth::guard('alumni')->check();
            $authStatus['siswa'] = Auth::guard('siswa')->check();
            $authStatus['web'] = Auth::check();

            if (Auth::guard('admin')->check()) {
                $role = 'admin';
                $user = Auth::guard('admin')->user();
                $authStatus['active_guard'] = 'admin';
            } elseif (Auth::guard('alumni')->check()) {
                $role = 'alumni';
                $user = Auth::guard('alumni')->user();
                $authStatus['active_guard'] = 'alumni';
            } elseif (Auth::guard('siswa')->check()) {
                $role = 'siswa';
                $user = Auth::guard('siswa')->user();
                $authStatus['active_guard'] = 'siswa';
            } elseif (Auth::check()) {
                $role = 'user';
                $user = Auth::user();
                $authStatus['active_guard'] = 'web';
            } else {
                $user = null;
                $authStatus['active_guard'] = 'none';
            }

            if ($user) {
                $userId = $user->id;
                $userType = $role;
                $notificationService = new NotificationService();
                $notifications = $notificationService->getRecentNotifications($userType, $userId);
                $notificationCount = $notificationService->getUnreadCount($userType, $userId);
            }

          $view->with('notifications', $notifications)
                 ->with('notificationCount', $notificationCount)
                 ->with('authStatus', $authStatus); // Add debug info
        });
    }
}
