<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class TrackPageViews
{
    public function handle($request, Closure $next)
    {
        // Avoid admin or API routes
        if (
            ! $request->is('admin/*') &&
            ! $request->is('api/*') &&
            $request->routeIs('homepage') // Only increment on homepage route
        ) {
            DB::table('page_views')->where('id', 1)->increment('count');
        }

        return $next($request);
    }
}
