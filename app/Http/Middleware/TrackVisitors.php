<?php


namespace App\Http\Middleware;

use App\Models\SiteVisit;
use Closure;

class TrackVisitors
{
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('GET') && !$request->ajax()) {
            SiteVisit::track($request->ip());
        }
        return $next($request);
    }
}
