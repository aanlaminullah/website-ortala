<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublikasiDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublikasiDokumenController extends Controller
{
    public function index()
    {
        $dokumen = PublikasiDokumen::orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.publikasi-dokumen.index', compact('dokumen'));
    }

    public function create()
    {
        return view('admin.publikasi-dokumen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'kategori'  => 'nullable|string|max:100',
            'file'      => 'required|file|max:20480',
            'tahun'     => 'required|digits:4',
            'tanggal'   => 'required|date',
        ]);

        $file = $request->file('file');
        $data = $request->only('judul', 'deskripsi', 'kategori', 'tahun', 'tanggal');
        $data['slug'] = $this->generateSlug($request->judul, $request->tahun);
        $data['aktif']       = $request->boolean('aktif', true);
        $data['file']        = $file->store('publikasi-dokumen', 'public');
        $data['tipe_file']   = $file->getMimeType();
        $data['ukuran_file'] = $file->getSize();

        PublikasiDokumen::create($data);

        return redirect()->route('admin.publikasi-dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(PublikasiDokumen $publikasiDokumen)
    {
        return view('admin.publikasi-dokumen.edit', compact('publikasiDokumen'));
    }

    public function update(Request $request, PublikasiDokumen $publikasiDokumen)
    {
        $request->validate([
            'judul'     => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'kategori'  => 'nullable|string|max:100',
            'file'      => 'nullable|file|max:20480',
            'tahun'     => 'required|digits:4',
            'tanggal'   => 'required|date',
        ]);

        $data = $request->only('judul', 'deskripsi', 'kategori', 'tahun', 'tanggal');
        $data['slug'] = $this->generateSlug($request->judul, $request->tahun, $publikasiDokumen->id);
        $data['aktif'] = $request->boolean('aktif');

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($publikasiDokumen->file);
            $file = $request->file('file');
            $data['file']        = $file->store('publikasi-dokumen', 'public');
            $data['tipe_file']   = $file->getMimeType();
            $data['ukuran_file'] = $file->getSize();
        }

        $publikasiDokumen->update($data);

        return redirect()->route('admin.publikasi-dokumen.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(PublikasiDokumen $publikasiDokumen)
    {
        Storage::disk('public')->delete($publikasiDokumen->file);
        $publikasiDokumen->delete();

        return redirect()->route('admin.publikasi-dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }

    private function generateSlug(string $judul, string $tahun, ?int $excludeId = null): string
    {
        $base = \Illuminate\Support\Str::slug($judul) . '-' . $tahun;
        $slug = $base;
        $counter = 1;

        while (true) {
            $query = \App\Models\PublikasiDokumen::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            if (!$query->exists()) break;
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
