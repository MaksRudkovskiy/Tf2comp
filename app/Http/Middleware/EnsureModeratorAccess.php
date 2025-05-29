<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureModeratorAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->hasAccessToAdminPanel()) {
            abort(403, 'Доступ запрещен');
        }

        return $next($request);
    }
}
