<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminGuest
{
    public function handle($request, Closure $next)
    {
        if (Session::has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
