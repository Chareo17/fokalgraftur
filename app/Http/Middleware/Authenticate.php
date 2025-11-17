<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Determine guard and redirect accordingly
        $guards = $this->guards ?? [];

        if (in_array('admin', $guards)) {
            return route('admin.login');
        }

        return route('login');
    }
}
