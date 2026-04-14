@extends('layouts.app')

@section('title', $announcement->title . ' - Dinas Perikanan Bolmut')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
                <a href="{{ url('/') }}" class="hover:text-fish-blue transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('announcements.index') }}" class="hover:text-fish-blue transition">Pengumuman</a>
                <span>/</span>
                <span class="text-gray-800 font-medium truncate max-w-xs">{{ $announcement->title }}</span>
            </nav>

            {{-- Artikel Utama --}}
            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-10">

                {{-- Gambar --}}
                @if ($announcement->image)
                    <div class="w-full h-72 overflow-hidden">
                        <img src="{{ Storage::url($announcement->image) }}" alt="{{ $announcement->title }}"
                            class="w-full h-full object-cover" />
                    </div>
                @else
                    <div class="w-full h-48 bg-gradient-to-r from-fish-dark to-fish-blue flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                @endif

                <div class="p-8">
                    {{-- Kategori & Tanggal --}}
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span
                            class="bg-blue-50 text-fish-blue text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $announcement->category }}
                        </span>
                        <span class="flex items-center gap-1 text-gray-400 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($announcement->date)->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    {{-- Judul --}}
                    <h1 class="text-2xl sm:text-3xl font-heading font-bold text-gray-900 leading-snug mb-6">
                        {{ $announcement->title }}
                    </h1>

                    {{-- Garis Pemisah --}}
                    <div class="w-16 h-1 bg-fish-blue rounded-full mb-6"></div>

                    {{-- Konten --}}
                    <div
                        class="prose prose-gray max-w-none text-gray-700 leading-relaxed text-sm sm:text-base text-justify">
                        {!! nl2br(e($announcement->description)) !!}
                    </div>

                    {{-- Tombol Download --}}
                    @if ($announcement->attachment)
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <p class="text-sm font-medium text-gray-500 mb-3">Lampiran Terkait</p>
                            <a href="{{ route('announcements.download', $announcement->id) }}"
                                class="inline-flex items-center gap-2 bg-fish-blue text-white text-sm font-semibold px-5 py-2.5 rounded-lg hover:bg-sky-700 transition shadow-md shadow-blue-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Unduh Lampiran
                            </a>
                        </div>
                    @endif
                </div>
            </article>

            {{-- Tombol Aksi --}}
            <div class="flex flex-wrap items-center justify-between gap-3 mb-10">
                <a href="{{ route('announcements.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-fish-blue hover:text-sky-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Daftar Pengumuman
                </a>
            </div>

            {{-- Pengumuman Terkait --}}
            @if ($related->count() > 0)
                <div>
                    <h2 class="text-lg font-heading font-bold text-gray-900 mb-5 border-l-4 border-fish-blue pl-4">
                        Pengumuman Terkait
                    </h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($related as $item)
                            <a href="{{ route('announcements.show', $item->id) }}"
                                class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition group">
                                <span class="text-xs font-bold text-fish-accent uppercase tracking-wider">
                                    {{ $item->category }}
                                </span>
                                <h3
                                    class="text-sm font-semibold text-gray-800 mt-2 mb-2 group-hover:text-fish-blue transition leading-snug line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-xs text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
