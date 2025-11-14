<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the admin is logged in
        if (! Session::get('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        // Get the logged-in admin's role
        $userRole = Session::get('admin_role');

        // Allow if user role matches any of the allowed roles
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Deny access if role mismatch
        abort(403, 'Unauthorized access.');
    }
}
