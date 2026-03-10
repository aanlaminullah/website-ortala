<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModul
{
    public function handle(Request $request, Closure $next, string $modul): Response
    {
        if (!setting_bool($modul)) {
            abort(404);
        }

        return $next($request);
    }
}
