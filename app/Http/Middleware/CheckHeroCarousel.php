<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Guard carousel routes: hanya bisa diakses jika hero_mode = 'carousel'
 * Didaftarkan sebagai alias 'modul:hero_carousel' tidak cocok —
 * maka ganti nama alias menjadi 'hero_carousel' di bootstrap/app.php
 */
class CheckHeroCarousel
{
    public function handle(Request $request, Closure $next): Response
    {
        if (setting('hero_mode', 'carousel') !== 'carousel') {
            abort(403, 'Halaman ini hanya tersedia saat Mode Tampilan diatur ke Carousel.');
        }

        return $next($request);
    }
}
