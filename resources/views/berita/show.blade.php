@extends('layouts.app')

@section('title', $item['judul_berita'] . ' - ' . setting('nama_dinas', 'Dinas Perikanan'))
@section('meta_description', Str::limit(strip_tags($item['isi_berita']), 150))
@if (!empty($item['tags']))
    @section('meta_keywords', str_replace('|', ', ', $item['tags']))
@endif
@section('og_type', 'article')
@if (!empty($item['gambar']))
    @section('meta_image', 'https://ppid.bolmutkab.go.id/img/' . $item['gambar'])
@endif

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6">
                <a href="{{ url('/') }}" class="hover:text-fish-blue transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('berita.index') }}" class="hover:text-fish-blue transition">Berita</a>
                <span>/</span>
                <span class="text-gray-600 line-clamp-1">{{ $item['judul_berita'] }}</span>
            </nav>

            {{-- Artikel --}}
            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- Gambar Header --}}
                @if ($item['gambar'])
                    <div class="aspect-video overflow-hidden">
                        <img src="https://ppid.bolmutkab.go.id/img/{{ $item['gambar'] }}"
                            alt="{{ $item['redaksi_foto'] ?? $item['judul_berita'] }}" class="w-full h-full object-cover" />
                    </div>
                    @if ($item['redaksi_foto'])
                        <p class="text-xs text-gray-400 text-center px-6 pt-2 italic">{{ $item['redaksi_foto'] }}</p>
                    @endif
                @endif

                <div class="p-6 sm:p-8">
                    {{-- Meta --}}
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="text-xs font-semibold text-fish-blue bg-blue-50 px-3 py-1 rounded-full">
                            {{ $item['unitkerja'] ?? $item['username'] }}
                        </span>
                        @if ($item['kategori'])
                            <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-full capitalize">
                                {{ $item['kategori'] }}
                            </span>
                        @endif
                    </div>

                    {{-- Judul --}}
                    <h1 class="text-2xl font-bold text-gray-900 mb-3 leading-snug">
                        {{ $item['judul_berita'] }}
                    </h1>

                    {{-- Info --}}
                    <div class="flex flex-wrap items-center gap-4 text-xs text-gray-400 mb-6 pb-6 border-b border-gray-100">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $item['created_at'] }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $item['name'] }}
                        </span>
                    </div>

                    {{-- Isi Berita --}}
                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed text-justify">
                        {!! $item['isi_berita'] !!}
                    </div>

                    {{-- Tags --}}
                    @if ($item['tags'])
                        <div class="flex flex-wrap gap-2 mt-6 pt-6 border-t border-gray-100">
                            @foreach (explode('|', $item['tags']) as $tag)
                                <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full">
                                    #{{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </article>

            {{-- Berita Terkait --}}
            @if ($terkait->count() > 0)
                <div class="mt-10">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Berita Lainnya</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach ($terkait as $rel)
                            <a href="{{ route('berita.show', $rel['slug']) }}"
                                class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:border-fish-blue/20 transition group">
                                <div class="aspect-video overflow-hidden bg-gray-100">
                                    @if ($rel['gambar'])
                                        <img src="https://ppid.bolmutkab.go.id/img/{{ $rel['gambar'] }}"
                                            alt="{{ $rel['judul_berita'] }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                            onerror="this.src='{{ asset('img/no-image.png') }}'" />
                                    @endif
                                </div>
                                <div class="p-3">
                                    <p
                                        class="text-xs font-bold text-gray-800 line-clamp-2 group-hover:text-fish-blue transition">
                                        {{ $rel['judul_berita'] }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $rel['created_at'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
