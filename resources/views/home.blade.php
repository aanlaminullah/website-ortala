@extends('layouts.app')

@section('title', 'Beranda - Dinas Perikanan Bolmut')

@section('content')

    @if (setting('hero_mode', 'carousel') === 'hero')
        {{-- Hero --}}
        <header class="relative bg-white overflow-hidden">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover opacity-100"
                    src="{{ setting('hero_gambar') ? Storage::url(setting('hero_gambar')) : 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2073' }}"
                    alt="Ocean Background" />
                <div class="absolute inset-0 bg-gradient-to-r from-white via-white/80 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-48">
                <div class="max-w-2xl">
                    <h2 class="text-4xl lg:text-5xl font-heading font-bold text-gray-900 leading-tight mb-6">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-fish-blue to-blue-400">
                            {{ setting('hero_judul', 'Mewujudkan Perikanan Maju & Berkelanjutan') }}
                        </span>
                    </h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        {{ setting('hero_subjudul') }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        {{-- Tombol Publikasi dengan dropdown seperti navbar --}}
                        @if (setting_bool('modul_publikasi_data') ||
                                setting_bool('modul_data_tangkap') ||
                                setting_bool('modul_publikasi_dokumen'))
                            <div class="relative group">
                                <button type="button"
                                    class="bg-fish-blue text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-sky-700 transition shadow-lg shadow-blue-900/20 flex items-center gap-2 select-none">
                                    Publikasi
                                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                {{-- Dropdown panel --}}
                                <div
                                    class="absolute top-full left-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                    <div
                                        class="absolute -top-1.5 left-6 w-3 h-3 bg-white border-l border-t border-gray-100 rotate-45">
                                    </div>
                                    <div class="p-2">
                                        @if (setting_bool('modul_publikasi_data'))
                                            <a href="{{ route('publikasi-data.index') }}"
                                                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:text-fish-blue hover:bg-blue-50 transition">
                                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Data Produksi
                                            </a>
                                        @endif
                                        @if (setting_bool('modul_data_tangkap'))
                                            <a href="#"
                                                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:text-fish-blue hover:bg-blue-50 transition">
                                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                                                </svg>
                                                Data Tangkap
                                            </a>
                                        @endif
                                        @if (setting_bool('modul_publikasi_dokumen'))
                                            <a href="{{ route('publikasi-dokumen.index') }}"
                                                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:text-fish-blue hover:bg-blue-50 transition">
                                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Dokumen
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        <a href="{{ route('visi-misi.index') }}"
                            class="bg-white text-gray-700 border border-gray-300 px-8 py-3.5 rounded-lg font-semibold hover:bg-gray-50 transition flex items-center">
                            Profil Dinas
                        </a>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block absolute right-20 top-20 w-80 h-80 bg-blue-100/30 rounded-full blur-3xl"></div>
        </header>
    @else
        {{-- Carousel --}}
        <div class="relative w-full overflow-hidden" id="mainCarousel" style="height: 520px;">
            <div class="carousel-slides absolute inset-0 flex transition-transform duration-700 ease-in-out"
                id="carouselTrack">
                @forelse($carouselItems as $item)
                    <div class="carousel-slide relative w-full h-full flex-shrink-0">
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                            class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                        <div class="absolute bottom-16 left-0 right-0 px-8 md:px-16">
                            <h2 class="text-white text-2xl md:text-3xl font-bold leading-snug drop-shadow">
                                {{ $item->judul }}
                            </h2>
                            @if ($item->deskripsi)
                                <p class="text-white/80 text-sm mt-2 max-w-xl">{{ $item->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="carousel-slide relative w-full h-full flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2073"
                            class="w-full h-full object-cover" />
                    </div>
                @endforelse
            </div>

            <button id="carouselPrev"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-10 bg-black/30 hover:bg-black/50 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="carouselNext"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-10 bg-black/30 hover:bg-black/50 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-10 flex gap-2" id="carouselDots">
                @foreach ($carouselItems as $index => $item)
                    <button class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/40 transition-all"
                        data-index="{{ $index }}"></button>
                @endforeach
            </div>
        </div>

        @push('scripts')
            <script>
                (function() {
                    const track = document.getElementById('carouselTrack');
                    const dots = document.querySelectorAll('.carousel-dot');
                    const total = dots.length;
                    let current = 0;
                    let timer = null;

                    if (!track || total === 0) return;

                    function goTo(index) {
                        current = (index + total) % total;
                        track.style.transform = `translateX(-${current * 100}%)`;
                        dots.forEach((d, i) => {
                            d.classList.toggle('bg-white', i === current);
                            d.classList.toggle('bg-white/40', i !== current);
                            d.style.width = i === current ? '24px' : '10px';
                            d.style.borderRadius = '9999px';
                        });
                    }

                    function startTimer() {
                        clearInterval(timer);
                        timer = setInterval(() => goTo(current + 1), 5000);
                    }

                    document.getElementById('carouselNext')?.addEventListener('click', () => {
                        goTo(current + 1);
                        startTimer();
                    });
                    document.getElementById('carouselPrev')?.addEventListener('click', () => {
                        goTo(current - 1);
                        startTimer();
                    });
                    dots.forEach(d => d.addEventListener('click', () => {
                        goTo(+d.dataset.index);
                        startTimer();
                    }));

                    goTo(0);
                    startTimer();
                })();
            </script>
        @endpush
    @endif



    {{-- <div class="relative z-10 -mt-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
    </div> --}}

    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Berita --}}
            <div class="lg:col-span-2 space-y-8">
                <div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
                    <h3 class="text-2xl font-heading font-bold text-gray-900 border-l-4 border-fish-blue pl-3">Berita</h3>
                    @if (setting_bool('modul_berita'))
                        <a href="{{ route('berita.index') }}"
                            class="text-sm font-semibold text-fish-blue hover:underline">Lihat Semua</a>
                    @endif
                </div>

                @if ($latestBerita->isEmpty())
                    <div class="text-center py-12 text-gray-400">
                        <p class="text-sm italic">Belum ada berita.</p>
                    </div>
                @else
                    {{-- Berita Utama --}}
                    @php $utama = $latestBerita->first(); @endphp
                    <a href="{{ route('berita.show', $utama['slug']) }}"
                        class="group relative rounded-2xl overflow-hidden shadow-lg h-96 block">
                        <img src="https://ppid.bolmutkab.go.id/img/{{ $utama['gambar'] }}"
                            alt="{{ $utama['judul_berita'] }}"
                            class="absolute inset-0 w-full h-full object-cover transition duration-500 group-hover:scale-105"
                            onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800'" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8">
                            <h4
                                class="text-2xl font-bold text-white mb-2 leading-tight group-hover:text-blue-200 transition">
                                {{ $utama['judul_berita'] }}
                            </h4>
                            <span class="text-xs text-gray-300">{{ $utama['created_at'] }}</span>
                        </div>
                    </a>

                    {{-- 2 Berita Lainnya --}}
                    @if ($latestBerita->count() > 1)
                        <div class="grid md:grid-cols-2 gap-6">
                            @foreach ($latestBerita->skip(1) as $berita)
                                <a href="{{ route('berita.show', $berita['slug']) }}"
                                    class="flex flex-col bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                                    <div class="h-48 overflow-hidden rounded-t-xl relative">
                                        <img src="https://ppid.bolmutkab.go.id/img/{{ $berita['gambar'] }}"
                                            alt="{{ $berita['judul_berita'] }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                            onerror="this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600'" />
                                        <span
                                            class="absolute top-2 right-2 bg-white/90 text-fish-blue text-xs font-bold px-2 py-1 rounded shadow capitalize">
                                            {{ $berita['kategori'] ?? 'Berita' }}
                                        </span>
                                    </div>
                                    <div class="p-5">
                                        <span class="text-xs text-gray-400 block mb-2">{{ $berita['created_at'] }}</span>
                                        <h4
                                            class="font-bold text-gray-900 mb-2 group-hover:text-fish-blue transition line-clamp-2">
                                            {{ $berita['judul_berita'] }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>

            <div class="space-y-8">

                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-fish-dark text-white p-4 flex justify-between items-center">
                        <h3 class="font-bold text-lg">📢 Pengumuman</h3>
                        <span class="bg-blue-600 text-xs px-2 py-1 rounded">Terbaru</span>
                    </div>
                    <div class="divide-y divide-gray-100 max-h-[500px] overflow-y-auto">
                        @forelse($latestAnnouncements as $announcement)
                            <div
                                class="relative p-4 hover:bg-gray-50 transition border-l-4 {{ $loop->first ? 'border-fish-accent' : 'border-transparent hover:border-fish-accent' }}">
                                <a href="{{ route('announcements.show', $announcement->id) }}" class="absolute inset-0 z-0"></a>
                                <div class="relative z-10 pointer-events-none">
                                    <span
                                        class="text-xs font-semibold {{ $loop->first ? 'text-fish-blue' : 'text-gray-500' }} mb-1 block">
                                        {{ \Carbon\Carbon::parse($announcement->date)->translatedFormat('d F Y') }}
                                    </span>
                                    <h5 class="text-sm font-bold text-gray-800 leading-snug mb-2 transition">
                                        {{ $announcement->title }}
                                    </h5>
                                </div>

                                @if ($announcement->attachment)
                                    <a href="{{ route('announcements.download', $announcement->id) }}"
                                        class="relative z-10 text-xs text-gray-500 flex items-center hover:text-fish-blue w-fit">
                                        Download Lampiran →
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                <p class="text-sm italic">Belum ada pengumuman terbaru.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                @if (setting_bool('modul_publikasi_dokumen') && $latestDokumen->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-fish-dark text-white p-4 flex justify-between items-center">
                            <h3 class="font-bold text-lg">📄 Publikasi Dokumen</h3>
                            <a href="{{ route('publikasi-dokumen.index') }}"
                                class="text-xs bg-blue-600 hover:bg-blue-700 px-2 py-1 rounded transition">Lihat Semua</a>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach ($latestDokumen as $dok)
                                <div class="flex items-center gap-3 p-4 hover:bg-gray-50 transition">
                                    <div
                                        class="shrink-0 w-9 h-9 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center">
                                        <i class="bx {{ $dok->ikonFile() }} text-xl {{ $dok->warnaIkon() }}"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $dok->judul }}</p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            @if ($dok->kategori)
                                                <span
                                                    class="text-xs text-fish-blue font-medium">{{ $dok->kategori }}</span>
                                            @endif
                                            <span
                                                class="text-xs text-gray-400">{{ $dok->tanggal->translatedFormat('d F Y') }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('publikasi-dokumen.download', $dok) }}"
                                        class="shrink-0 text-fish-blue hover:bg-blue-50 p-1.5 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <section class="bg-fish-dark py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-white">Lensa Kegiatan</h2>
                <a href="{{ route('lensa-kegiatan.index') }}"
                    class="text-sm font-semibold text-fish-accent hover:underline transition">
                    Lihat Lainnya &rarr;
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($lensaKegiatan as $item)
                    <div class="aspect-square bg-gray-300 rounded-lg overflow-hidden relative group">
                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                            class="w-full h-full object-cover transition duration-300 group-hover:scale-110" />
                        @if ($item->judul)
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-end p-4">
                                <span class="text-white text-xs font-medium">{{ $item->judul }}</span>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-4 py-10 text-center text-gray-400 text-sm italic">
                        Belum ada foto kegiatan.
                    </div>
                @endforelse
            </div>
        </div>

        @if ($instansiTerkait->count() > 0)
            <div class="border-b border-gray-800 bg-gray-800/50 py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <p class="text-xs uppercase tracking-widest text-gray-500 mb-6">Instansi Terkait</p>
                    <div class="flex flex-wrap justify-center items-center gap-6">
                        @foreach ($instansiTerkait as $instansi)
                            @if ($instansi->url)
                                <a href="{{ $instansi->url }}" target="_blank" rel="noopener"
                                    class="group relative flex items-center justify-center opacity-60 grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-300">
                                    <div
                                        class="w-12 h-12 rounded-full overflow-hidden ring-2 ring-transparent group-hover:ring-fish-blue/30 transition">
                                        <img src="{{ Storage::url($instansi->logo) }}" alt="{{ $instansi->nama }}"
                                            class="w-full h-full object-cover" />
                                    </div>
                                    <div
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs font-medium px-2 py-1 rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none">
                                        {{ $instansi->nama }}
                                        <div
                                            class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-900">
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div
                                    class="group relative flex items-center justify-center opacity-60 hover:opacity-80 transition-all duration-300">
                                    <div class="w-12 h-12 rounded-full overflow-hidden">
                                        <img src="{{ Storage::url($instansi->logo) }}" alt="{{ $instansi->nama }}"
                                            class="w-full h-full object-cover" />
                                    </div>
                                    <div
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs font-medium px-2 py-1 rounded-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none">
                                        {{ $instansi->nama }}
                                        <div
                                            class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-gray-900">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </section>


    @push('scripts')
        <script>
            (function() {
                const track = document.getElementById('carouselTrack');
                const dots = document.querySelectorAll('.carousel-dot');
                const total = dots.length;
                let current = 0;
                let timer = null;

                function goTo(index) {
                    current = (index + total) % total;
                    track.style.transform = `translateX(-${current * 100}%)`;
                    dots.forEach((d, i) => {
                        d.classList.toggle('bg-white', i === current);
                        d.classList.toggle('bg-white/40', i !== current);
                        d.style.width = i === current ? '24px' : '10px';
                        d.style.borderRadius = '9999px';
                    });
                }

                function startTimer() {
                    clearInterval(timer);
                    timer = setInterval(() => goTo(current + 1), 5000);
                }

                document.getElementById('carouselNext').addEventListener('click', () => {
                    goTo(current + 1);
                    startTimer();
                });
                document.getElementById('carouselPrev').addEventListener('click', () => {
                    goTo(current - 1);
                    startTimer();
                });
                dots.forEach(d => d.addEventListener('click', () => {
                    goTo(+d.dataset.index);
                    startTimer();
                }));

                goTo(0);
                startTimer();
            })();
        </script>
    @endpush

@endsection
