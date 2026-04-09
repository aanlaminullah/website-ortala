<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Carousel;
use App\Models\InstansiTerkait;
use App\Models\LensaKegiatan;
use App\Models\PublikasiDokumen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Stat cards
        $totalDokumen      = PublikasiDokumen::where('aktif', true)->count();
        $totalPengumuman   = Announcement::count();
        $totalInstansi     = InstansiTerkait::count();
        $totalCarousel     = Carousel::count();
        $totalLensa        = LensaKegiatan::where('aktif', true)->count();

        // Chart: dokumen diterbitkan per bulan (tahun berjalan)
        $tahun = date('Y');
        $dokumenPerBulan = PublikasiDokumen::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total')
            ->whereYear('tanggal', $tahun)
            ->where('aktif', true)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        // Lengkapi semua 12 bulan
        $chartData = collect(range(1, 12))->map(fn($m) => $dokumenPerBulan->get($m, 0))->values();

        // 5 pengumuman terbaru
        $pengumumanTerbaru = Announcement::orderByDesc('date')->limit(5)->get();

        return view('dashboard.index', compact(
            'totalDokumen',
            'totalPengumuman',
            'totalInstansi',
            'totalCarousel',
            'totalLensa',
            'tahun',
            'chartData',
            'pengumumanTerbaru'
        ));
    }
}
