<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\LensaKegiatan;
use App\Models\InstansiTerkait;
use App\Models\PublikasiDokumen;
use Illuminate\Support\Facades\Http;
use App\Models\Carousel;

class LandingController extends Controller
{
    public function index()
    {
        $latestAnnouncements = Announcement::orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        $lensaKegiatan = LensaKegiatan::where('aktif', true)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $instansiTerkait = InstansiTerkait::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        $latestDokumen = PublikasiDokumen::where('aktif', true)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Ambil berita dari API
        $latestBerita = collect();
        if (setting_bool('modul_berita')) {
            try {
                $alias    = setting('berita_alias', 'bpkd');
                $response = Http::timeout(10)
                    ->withBasicAuth(env('PPID_API_USER'), env('PPID_API_PASS'))
                    ->get("https://ppid.bolmutkab.go.id/api/berita/{$alias}");

                if ($response->successful()) {
                    $latestBerita = collect($response->json())->take(3);
                }
            } catch (\Exception $e) {
                $latestBerita = collect();
            }
        }

        $carouselItems = Carousel::where('aktif', true)
            ->orderBy('urutan')
            ->get();

        return view('home', compact(
            'latestAnnouncements',
            'lensaKegiatan',
            'instansiTerkait',
            'latestDokumen',
            'latestBerita',
            'carouselItems'
        ));
    }
}
