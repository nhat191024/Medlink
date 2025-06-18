<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRouteAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_LOG_API') === 'local') {
            $route = $request->route();
            $routeName = $route?->getName();
            $routeAction = $route?->getActionName();
            $url = $request->fullUrl();
            Log::info('[RouteAccess] Route accessed', [
                'route_name' => $routeName,
                'route_action' => $routeAction,
                'url' => $url,
                'method' => $request->method(),
                'ip' => $request->ip(),
            ]);
        }
        return $next($request);
    }
}
