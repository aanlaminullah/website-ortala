@extends('layouts.app')

@section('title', 'Beranda - Dinas Perikanan Bolmut')

@section('content')

    <header class="relative bg-white overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-100"
                src="{{ setting('hero_gambar') ? Storage::url(setting('hero_gambar')) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2073' }}"
                alt="Ocean Background" />
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/80 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="max-w-2xl">
                <div
                    class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-fish-blue text-xs font-bold mb-6 border border-blue-100">
                    <span class="mr-2">🐟</span> POTENSI MARITIM
                </div>
                <h2 class="text-4xl lg:text-5xl font-heading font-bold text-gray-900 leading-tight mb-6">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-fish-blue to-blue-400">
                        {{ setting('hero_judul', 'Mewujudkan Perikanan Maju & Berkelanjutan') }}
                    </span>
                </h2>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    {{ setting('hero_subjudul') }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <button
                        class="bg-fish-blue text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-sky-700 transition shadow-lg shadow-blue-900/20 flex items-center">
                        Info Harga Ikan
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <button
                        class="bg-white text-gray-700 border border-gray-300 px-8 py-3.5 rounded-lg font-semibold hover:bg-gray-50 transition flex items-center">
                        Profil Dinas
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden lg:block absolute right-20 top-20 w-80 h-80 bg-blue-100/30 rounded-full blur-3xl"></div>
    </header>

    <div class="relative z-10 -mt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-white p-6 rounded-xl shadow-xl border border-gray-100">

            <a href="#"
                class="flex flex-col items-center justify-center p-4 rounded-lg hover:bg-blue-50 transition group">
                <div
                    class="w-12 h-12 bg-blue-100 text-fish-blue rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="font-semibold text-gray-800 text-sm">E-Kusuka</span>
            </a>

            <a href="#"
                class="flex flex-col items-center justify-center p-4 rounded-lg hover:bg-blue-50 transition group">
                <div
                    class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1zm6-10h-2v10h2a1 1 0 001-1V7a1 1 0 00-1-1z" />
                    </svg>
                </div>
                <span class="font-semibold text-gray-800 text-sm">Data Kapal</span>
            </a>

            <a href="#"
                class="flex flex-col items-center justify-center p-4 rounded-lg hover:bg-blue-50 transition group">
                <div
                    class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                </div>
                <span class="font-semibold text-gray-800 text-sm">Unduh Formulir</span>
            </a>

            <a href="#"
                class="flex flex-col items-center justify-center p-4 rounded-lg hover:bg-blue-50 transition group">
                <div
                    class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                </div>
                <span class="font-semibold text-gray-800 text-sm">Lapor Ilegal</span>
            </a>

        </div>
    </div>

    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <div class="lg:col-span-2 space-y-8">
                <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
                    <h3 class="text-2xl font-heading font-bold text-gray-900 border-l-4 border-fish-blue pl-3">Berita
                    </h3>
                    <a href="#" class="text-sm font-semibold text-fish-blue hover:underline">Lihat Semua</a>
                </div>

                <article class="group relative rounded-2xl overflow-hidden shadow-lg h-96">
                    <img src="https://images.unsplash.com/photo-1507124441518-c9584b9dc520?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Fisherman News"
                        class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <span
                            class="bg-fish-blue text-white text-xs font-bold px-2 py-1 rounded mb-3 inline-block">UTAMA</span>
                        <h4 class="text-2xl font-bold text-white mb-2 leading-tight group-hover:text-blue-200 transition">
                            Penyaluran Bantuan Perahu dan Alat Tangkap Ramah Lingkungan
                        </h4>
                        <p class="text-gray-300 text-sm line-clamp-2 mb-4">
                            Pemerintah Kabupaten terus berkomitmen meningkatkan kesejahteraan nelayan lokal dengan bantuan
                            armada modern.
                        </p>
                        <span class="text-xs text-gray-400">📅 24 Juli 2025</span>
                    </div>
                </article>

                <div class="grid md:grid-cols-2 gap-6">
                    <article
                        class="flex flex-col bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="h-48 overflow-hidden rounded-t-xl relative">
                            <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                                class="w-full h-full object-cover" />
                            <span
                                class="absolute top-2 right-2 bg-white/90 text-fish-blue text-xs font-bold px-2 py-1 rounded shadow">Sosialisasi</span>
                        </div>
                        <div class="p-5">
                            <span class="text-xs text-gray-400 block mb-2">01 Desember 2025</span>
                            <h4 class="font-bold text-gray-900 mb-2 hover:text-fish-blue transition">
                                Pelatihan Budidaya Ikan Air Tawar Sistem Bioflok
                            </h4>
                        </div>
                    </article>
                    <article
                        class="flex flex-col bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="h-48 overflow-hidden rounded-t-xl relative">
                            <img src="https://plus.unsplash.com/premium_photo-1713316834449-d8fbe5f2aad3?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                class="w-full h-full object-cover" />
                            <span
                                class="absolute top-2 right-2 bg-white/90 text-fish-blue text-xs font-bold px-2 py-1 rounded shadow">Konservasi</span>
                        </div>
                        <div class="p-5">
                            <span class="text-xs text-gray-400 block mb-2">26 November 2025</span>
                            <h4 class="font-bold text-gray-900 mb-2 hover:text-fish-blue transition">
                                Pelepasliaran Tukik dan Penanaman Mangrove Pesisir
                            </h4>
                        </div>
                    </article>
                </div>
            </div>

            <div class="space-y-8">

                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-fish-dark text-white p-4 flex justify-between items-center">
                        <h3 class="font-bold text-lg">📢 Pengumuman</h3>
                        <span class="bg-blue-600 text-xs px-2 py-1 rounded">Terbaru</span>
                    </div>
                    <div class="divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                        @forelse($latestAnnouncements as $announcement)
                            <a href="{{ route('announcements.show', $announcement->id) }}"
                                class="block p-4 hover:bg-gray-50 transition border-l-4 {{ $loop->first ? 'border-fish-accent' : 'border-transparent hover:border-fish-accent' }}">
                                <span
                                    class="text-xs font-semibold {{ $loop->first ? 'text-fish-blue' : 'text-gray-500' }} mb-1 block">
                                    {{ \Carbon\Carbon::parse($announcement->date)->translatedFormat('d F Y') }}
                                </span>
                                <h5
                                    class="text-sm font-bold text-gray-800 leading-snug mb-2 hover:text-fish-blue transition">
                                    {{ $announcement->title }}
                                </h5>

                                @if ($announcement->attachment)
                                    <span class="text-xs text-gray-500 flex items-center hover:text-fish-blue">
                                        Download Lampiran →
                                    </span>
                                @endif
                            </a>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                <p class="text-sm italic">Belum ada pengumuman terbaru.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                    <h3 class="font-heading font-bold text-gray-900 border-l-4 border-fish-blue pl-3 mb-4">Galeri Video
                    </h3>
                    <div class="rounded-lg overflow-hidden bg-black aspect-video relative group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                            class="w-full h-full object-cover opacity-80 group-hover:opacity-60 transition" />
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-12 h-12 bg-fish-blue rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 text-sm font-medium text-gray-800">Potensi Perikanan Tangkap Laut Bolmut</p>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-fish-dark py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white">Lensa Kegiatan</h2>
                <div class="flex gap-2">
                    <button class="bg-gray-700 text-white p-2 rounded-full hover:bg-fish-blue transition">&larr;</button>
                    <button class="bg-gray-700 text-white p-2 rounded-full hover:bg-fish-blue transition">&rarr;</button>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="aspect-square bg-gray-300 rounded-lg overflow-hidden relative group">
                    <img src="https://www.mediasuaramabes.com/wp-content/uploads/2025/06/40909.jpg"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-110" />
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-end p-4">
                        <span class="text-white text-xs font-medium">Panen Raya</span>
                    </div>
                </div>
                <div class="aspect-square bg-gray-300 rounded-lg overflow-hidden relative group">
                    <img src="https://images.unsplash.com/photo-1621451537084-482c73073a0f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-110" />
                </div>
                <div class="aspect-square bg-gray-300 rounded-lg overflow-hidden relative group">
                    <img src="https://lh3.googleusercontent.com/proxy/j9VDwK7i_KJeJdaGT792xIOoxfrapLboRG7v3JcRpKXFeVb7yDbZ0BKa6Z82Poshb6lNUtBil5FtfoXojUtn77L72z4WWPMJwEYsPQwjIdscW-vFc8p95f7bQ8emTyvRtNqHDyBTEN02KIdkwzt-4jLQPvEbSzQroamhR7j65LcewcliQMT4VleDDVh7ycrthoQ4GILCflXvkZBNjnT_hXYSO118pP4"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-110" />
                </div>
                <div class="aspect-square bg-gray-300 rounded-lg overflow-hidden relative group">
                    <img src="https://mail.kapuashulukab.go.id/home/public/assets/images/posts/md_dinas-perikanan-ikuti-rapat-sinkronisasi-dak-tahun-2021-dan-monev-terpadu.jpeg"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-110" />
                </div>
            </div>
        </div>

        <div class="border-b border-gray-800 bg-gray-800/50 py-8 mt-12">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-xs uppercase tracking-widest text-gray-500 mb-4">
                    Instansi Terkait
                </p>
                <div
                    class="flex flex-wrap justify-center gap-6 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                    <img src="{{ asset('img/logo-kemenperikan.png') }}" class="h-10" />
                    <img src="{{ asset('img/logo-komdigi.png') }}" class="h-8" />
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/63/Lambang_Polri.png" class="h-8" />
                </div>
            </div>
        </div>
    </section>

@endsection
