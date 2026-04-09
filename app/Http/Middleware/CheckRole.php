<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Blokir akses jika user bukan role yang diizinkan.
     * Usage: middleware('role:admin')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Akses ditolak. Hanya ' . ucfirst($role) . ' yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
