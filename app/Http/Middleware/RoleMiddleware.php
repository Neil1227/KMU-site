<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
public function handle(Request $request, Closure $next, ...$roles)
{
    $userRole = Session::get('admin_role');

    if (!$userRole || !in_array($userRole, $roles)) {
        abort(403, "Your role: $userRole. Allowed: ".implode(',', $roles));
    }

    return $next($request);
}
}
