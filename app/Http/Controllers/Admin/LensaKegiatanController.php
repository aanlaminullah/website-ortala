<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LensaKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LensaKegiatanController extends Controller
{
    public function index()
    {
        $lensa = LensaKegiatan::orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view('admin.lensa-kegiatan.index', compact('lensa'));
    }

    public function create()
    {
        return view('admin.lensa-kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'nullable|string|max:150',
            'foto'    => 'required|image|max:3072',
            'tanggal' => 'required|date',
        ]);

        $data = $request->only('judul', 'tanggal');
        $data['aktif'] = $request->boolean('aktif', true);
        $data['foto']  = $request->file('foto')->store('lensa-kegiatan', 'public');

        LensaKegiatan::create($data);

        return redirect()->route('admin.lensa-kegiatan.index')
            ->with('success', 'Foto kegiatan berhasil ditambahkan.');
    }

    public function edit(LensaKegiatan $lensaKegiatan)
    {
        return view('admin.lensa-kegiatan.edit', compact('lensaKegiatan'));
    }

    public function update(Request $request, LensaKegiatan $lensaKegiatan)
    {
        $request->validate([
            'judul'   => 'nullable|string|max:150',
            'foto'    => 'nullable|image|max:3072',
            'tanggal' => 'required|date',
        ]);

        $data = $request->only('judul', 'tanggal');
        $data['aktif'] = $request->boolean('aktif');

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($lensaKegiatan->foto);
            $data['foto'] = $request->file('foto')->store('lensa-kegiatan', 'public');
        }

        $lensaKegiatan->update($data);

        return redirect()->route('admin.lensa-kegiatan.index')
            ->with('success', 'Foto kegiatan berhasil diperbarui.');
    }

    public function destroy(LensaKegiatan $lensaKegiatan)
    {
        Storage::disk('public')->delete($lensaKegiatan->foto);
        $lensaKegiatan->delete();

        return redirect()->route('admin.lensa-kegiatan.index')
            ->with('success', 'Foto kegiatan berhasil dihapus.');
    }
}
