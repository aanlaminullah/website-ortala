<?php

namespace App\Http\Controllers;

use App\Models\LensaKegiatan;

class LensaKegiatanController extends Controller
{
    public function index()
    {
        $lensaKegiatan = LensaKegiatan::where('aktif', true)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('lensa-kegiatan.index', compact('lensaKegiatan'));
    }
}
