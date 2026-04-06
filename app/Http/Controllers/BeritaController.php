<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BeritaController extends Controller
{
    private string $apiUrl = 'https://ppid.boltarakab.go.id/api/berita/';

    public function index(Request $request)
    {
        $alias    = setting('berita_alias', 'bpkd');
        $page     = $request->get('page', 1);
        $search   = $request->get('search');

        try {
            $response = Http::timeout(10)
                ->withBasicAuth(env('PPID_API_USER'), env('PPID_API_PASS'))
                ->get($this->apiUrl . $alias);

            if ($response->failed()) {
                return view('berita.index', [
                    'berita'  => collect(),
                    'search'  => $search,
                    'error'   => 'Gagal memuat berita.',
                ]);
            }

            $semua = collect($response->json());

            // Filter search
            if ($search) {
                $semua = $semua->filter(function ($item) use ($search) {
                    return str_contains(
                        strtolower($item['judul_berita']),
                        strtolower($search)
                    );
                })->values();
            }

            // Manual paginate
            $perPage  = 9;
            $total    = $semua->count();
            $items    = $semua->forPage($page, $perPage)->values();

            $berita = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } catch (\Exception $e) {
            return view('berita.index', [
                'berita'  => collect(),
                'search'  => $search,
                'error'   => 'Koneksi ke server berita gagal.',
            ]);
        }

        return view('berita.index', compact('berita', 'search'));
    }

    public function show(string $slug)
    {
        $alias = setting('berita_alias', 'bpkd');

        try {
            $response = Http::timeout(10)
                ->withBasicAuth(env('PPID_API_USER'), env('PPID_API_PASS'))
                ->get($this->apiUrl . $alias);

            if ($response->failed()) {
                abort(404);
            }

            $semua  = collect($response->json());
            $item   = $semua->firstWhere('slug', $slug);

            if (!$item) abort(404);

            // Berita terkait (exclude current)
            $terkait = $semua->where('slug', '!=', $slug)->take(3)->values();
        } catch (\Exception $e) {
            abort(404);
        }

        return view('berita.show', compact('item', 'terkait'));
    }
}
