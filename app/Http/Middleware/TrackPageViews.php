<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class TrackPageViews
{
    public function handle($request, Closure $next)
    {
        // Avoid counting admin or API routes if needed
        if (!$request->is('admin/*') && !$request->is('api/*')) {
            DB::table('page_views')->where('id', 1)->increment('count');
        }

        return $next($request);
    }
}

