<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SitemapController extends Controller
{
    public function index()
    {
        // 1. URL Statis
        $urls = [
            ['loc' => url('/'), 'lastmod' => Carbon::now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('berita.index'), 'lastmod' => Carbon::now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('announcements.index'), 'lastmod' => Carbon::now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('visi-misi.index'), 'lastmod' => Carbon::now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('struktur-organisasi.index'), 'lastmod' => Carbon::now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('publikasi-data.index'), 'lastmod' => Carbon::now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('publikasi-dokumen.index'), 'lastmod' => Carbon::now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('lensa-kegiatan.index'), 'lastmod' => Carbon::now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.6'],
        ];

        // 2. Pengumuman (Dari Database)
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        foreach ($announcements as $announcement) {
            $urls[] = [
                'loc' => route('announcements.show', $announcement->id),
                'lastmod' => $announcement->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        // 3. Berita (Dari API PPID)
        try {
            $alias = setting('berita_alias', 'bpkd');
            $response = Http::timeout(5)
                ->withBasicAuth(env('PPID_API_USER'), env('PPID_API_PASS'))
                ->get('https://ppid.boltarakab.go.id/api/berita/' . $alias);

            if ($response->successful()) {
                $beritaList = $response->json();
                foreach ($beritaList as $berita) {
                    $date = Carbon::parse($berita['created_at'] ?? now())->toAtomString();
                    $urls[] = [
                        'loc' => route('berita.show', $berita['slug']),
                        'lastmod' => $date,
                        'changefreq' => 'monthly',
                        'priority' => '0.8',
                    ];
                }
            }
        } catch (\Exception $e) {
            // Abaikan berita jika API error, sitemap tetap berhasil di-generate untuk konten lainnya
        }

        return response()
            ->view('sitemap', [
                'urls' => $urls,
                'xml_header' => '<?xml version="1.0" encoding="UTF-8"?>'
            ])
            ->header('Content-Type', 'text/xml');
    }
}
