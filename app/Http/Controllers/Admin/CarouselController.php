<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousel = Carousel::orderBy('urutan')->get();
        return view('admin.carousel.index', compact('carousel'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:200',
            'deskripsi' => 'nullable|string|max:300',
            'gambar'    => 'required|image|max:5120',
        ]);

        $maxUrutan = Carousel::max('urutan') ?? 0;

        Carousel::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $request->file('gambar')->store('carousel', 'public'),
            'aktif'     => $request->boolean('aktif', true),
            'urutan'    => $maxUrutan + 1,
        ]);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Slide berhasil ditambahkan.');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'judul'     => 'required|string|max:200',
            'deskripsi' => 'nullable|string|max:300',
            'gambar'    => 'nullable|image|max:5120',
        ]);

        $data = [
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'aktif'     => $request->boolean('aktif'),
        ];

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($carousel->gambar);
            $data['gambar'] = $request->file('gambar')->store('carousel', 'public');
        }

        $carousel->update($data);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(Carousel $carousel)
    {
        Storage::disk('public')->delete($carousel->gambar);
        $carousel->delete();

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Slide berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:carousel,id',
        ]);

        foreach ($request->ids as $urutan => $id) {
            Carousel::where('id', $id)->update(['urutan' => $urutan + 1]);
        }

        return response()->json(['success' => true]);
    }
}
