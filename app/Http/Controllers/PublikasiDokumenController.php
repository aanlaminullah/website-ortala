<?php

namespace App\Http\Controllers;

use App\Models\PublikasiDokumen;
use Illuminate\Http\Request;

class PublikasiDokumenController extends Controller
{
    public function index(Request $request)
    {
        $tahun    = $request->get('tahun', date('Y'));
        $kategori = $request->get('kategori');
        $search   = $request->get('search');

        $query = PublikasiDokumen::where('aktif', true)
            ->where('tahun', $tahun);

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $dokumen = $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $tahunList = PublikasiDokumen::selectRaw('DISTINCT tahun')
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $kategoriList = PublikasiDokumen::whereNotNull('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('publikasi-dokumen.index', compact(
            'dokumen',
            'tahun',
            'tahunList',
            'kategori',
            'kategoriList',
            'search'
        ));
    }

    public function download(PublikasiDokumen $publikasiDokumen)
    {
        // Cek apakah di sesi ini user sudah mengunduh dokumen ini sebelumnya
        $sessionKey = 'downloaded_dokumen_' . $publikasiDokumen->id;

        if (!session()->has($sessionKey)) {
            $publikasiDokumen->increment('downloads');
            session()->put($sessionKey, true); // Tandai bahwa user ini sudah mengunduh
        }

        return response()->download(
            storage_path('app/public/' . $publikasiDokumen->file),
            $publikasiDokumen->judul . '.' . pathinfo($publikasiDokumen->file, PATHINFO_EXTENSION)
        );
    }

    public function share(PublikasiDokumen $publikasiDokumen)
    {
        $publikasiDokumen->increment('shares');
        return response()->json(['success' => true, 'shares' => $publikasiDokumen->shares]);
    }
}
