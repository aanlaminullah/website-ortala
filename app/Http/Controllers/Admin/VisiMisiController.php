<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use App\Models\Misi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::with('misi')->latest()->first();

        return view('admin.visi-misi.index', compact('visiMisi'));
    }

    public function edit()
    {
        $visiMisi = VisiMisi::with('misi')->latest()->first();

        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'visi'     => 'required|string',
            'misi'     => 'nullable|array',
            'misi.*'   => 'nullable|string',
        ]);

        $visiMisi = VisiMisi::latest()->first();
        if ($visiMisi) {
            $visiMisi->update(['visi' => $request->visi]);
        } else {
            $visiMisi = VisiMisi::create(['visi' => $request->visi]);
        }

        $visiMisi->misi()->delete();

        if ($request->filled('misi')) {
            foreach (array_filter($request->misi) as $urutan => $isi) {
                Misi::create([
                    'visi_misi_id' => $visiMisi->id,
                    'isi'          => $isi,
                    'urutan'       => $urutan + 1,
                ]);
            }
        }

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi & Misi berhasil diperbarui.');
    }
}
