<nav class="sticky top-0 z-50 glass-header transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <img src="{{ str_starts_with(setting('logo', 'img/logo-bolmut.png'), 'img/') ? asset(setting('logo', 'img/logo-bolmut.png')) : Storage::url(setting('logo')) }}"
                    alt="Logo" class="h-10 w-auto">
                <div class="leading-tight">
                    <h1 class="font-heading font-bold text-fish-blue text-lg">
                        {{ strtoupper(setting('nama_dinas', 'Dinas Perikanan')) }}
                    </h1>
                    <p class="text-xs text-gray-500 font-medium tracking-wide">
                        {{ strtoupper(setting('sub_nama_dinas', 'Kab. Bolaang Mongondow Utara')) }}
                    </p>
                </div>
            </div>

            {{-- Menu Desktop --}}
            <div class="hidden lg:flex items-center space-x-8 text-sm font-medium text-gray-600">
                <a href="{{ url('/') }}"
                    class="{{ request()->is('/') ? 'text-fish-blue font-semibold' : 'hover:text-fish-blue transition' }}">
                    Beranda
                </a>

                {{-- Dropdown Profil --}}
                @if (setting_bool('modul_struktur_organisasi') || setting_bool('modul_visi_misi'))
                    <div class="relative group cursor-pointer">
                        <span class="hover:text-fish-blue flex items-center gap-1 transition">
                            Profil
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                        <div
                            class="absolute top-8 left-0 w-52 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div
                                class="absolute -top-1.5 left-4 w-3 h-3 bg-white border-l border-t border-gray-100 rotate-45">
                            </div>
                            <div class="p-2">
                                @if (setting_bool('modul_struktur_organisasi'))
                                    <a href="{{ route('struktur-organisasi.index') }}"
                                        class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:text-fish-blue hover:bg-blue-50 transition">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Struktur Organisasi
                                    </a>
                                @endif
                                @if (setting_bool('modul_visi_misi'))
                                    <a href="{{ route('visi-misi.index') }}"
                                        class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:text-fish-blue hover:bg-blue-50 transition">
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Visi & Misi
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Dropdown Publikasi Data --}}
                @if (setting_bool('modul_publikasi_data'))
                    <div class="relative group cursor-pointer">
                        <span
                            class="{{ Request::is('publikasi-data*') ? 'text-fish-blue font-semibold' : 'hover:text-fish-blue' }} flex items-center gap-1 transition">
                            Publikasi Data
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                        <div
                            class="absolute top-8 left-0 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div
                                class="absolute -top-1.5 left-4 w-3 h-3 bg-white border-l border-t border-gray-100 rotate-45">
                            </div>
                            <div class="p-2">
                                <a href="{{ route('publikasi-data.index') }}"
                                    class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:text-fish-blue hover:bg-blue-50 transition {{ Request::is('publikasi-data') ? 'text-fish-blue bg-blue-50 font-semibold' : '' }}">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Data Produksi
                                </a>
                                <a href="#"
                                    class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm text-gray-600 hover:text-fish-blue hover:bg-blue-50 transition">
                                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                                    </svg>
                                    Data Tangkap
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                @if (setting_bool('modul_berita'))
                    <a href="#" class="hover:text-fish-blue transition">Berita</a>
                @endif

                @if (setting_bool('modul_pengumuman'))
                    <a href="{{ route('announcements.index') }}"
                        class="{{ Request::is('pengumuman*') ? 'text-fish-blue font-semibold' : 'hover:text-fish-blue' }} transition">
                        Pengumuman
                    </a>
                @endif

                <div class="flex items-center gap-3 ml-4">
                    <button class="p-2 text-gray-400 hover:text-fish-blue transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <a href="{{ route('login') }}"
                        class="bg-fish-blue text-white px-5 py-2 rounded-lg hover:bg-sky-700 transition shadow-md shadow-blue-200 font-medium">
                        Login Admin
                    </a>
                </div>
            </div>

            {{-- Tombol Hamburger Mobile --}}
            <button id="hamburgerBtn"
                class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-fish-blue hover:bg-gray-100 transition focus:outline-none">
                <svg id="iconHamburger" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="iconClose" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu Mobile --}}
    <div id="mobileMenu" class="hidden lg:hidden border-t border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 py-3 space-y-1">

            <a href="{{ url('/') }}"
                class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->is('/') ? 'text-fish-blue bg-blue-50 font-semibold' : 'text-gray-600 hover:text-fish-blue hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Beranda
            </a>

            {{-- Profil Mobile --}}
            @if (setting_bool('modul_struktur_organisasi') || setting_bool('modul_visi_misi'))
                <div class="px-4 pt-2 pb-1">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Profil</p>
                </div>
                @if (setting_bool('modul_struktur_organisasi'))
                    <a href="{{ route('struktur-organisasi.index') }}"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium {{ Request::is('struktur-organisasi*') ? 'text-fish-blue bg-blue-50 font-semibold' : 'text-gray-600 hover:text-fish-blue hover:bg-gray-50' }} transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Struktur Organisasi
                    </a>
                @endif
                @if (setting_bool('modul_visi_misi'))
                    <a href="{{ route('visi-misi.index') }}"
                        class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium {{ Request::is('visi-misi*') ? 'text-fish-blue bg-blue-50 font-semibold' : 'text-gray-600 hover:text-fish-blue hover:bg-gray-50' }} transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Visi & Misi
                    </a>
                @endif
            @endif

            {{-- Publikasi Data Mobile --}}
            @if (setting_bool('modul_publikasi_data'))
                <div class="px-4 pt-2 pb-1">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Publikasi Data</p>
                </div>
                <a href="{{ route('publikasi-data.index') }}"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium {{ Request::is('publikasi-data') ? 'text-fish-blue bg-blue-50 font-semibold' : 'text-gray-600 hover:text-fish-blue hover:bg-gray-50' }} transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Data Produksi
                </a>
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:text-fish-blue hover:bg-gray-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                    </svg>
                    Data Tangkap
                </a>
            @endif

            {{-- Berita Mobile --}}
            @if (setting_bool('modul_berita'))
                <a href="#"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:text-fish-blue hover:bg-gray-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Berita
                </a>
            @endif

            {{-- Pengumuman Mobile --}}
            @if (setting_bool('modul_pengumuman'))
                <a href="{{ route('announcements.index') }}"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-medium {{ Request::is('pengumuman*') ? 'text-fish-blue bg-blue-50 font-semibold' : 'text-gray-600 hover:text-fish-blue hover:bg-gray-50' }} transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    Pengumuman
                </a>
            @endif

            <div class="pt-2 pb-1 border-t border-gray-100 mt-2">
                <a href="{{ route('login') }}"
                    class="flex items-center justify-center gap-2 w-full bg-fish-blue text-white px-5 py-2.5 rounded-lg hover:bg-sky-700 transition font-medium text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Login Admin
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const iconHamburger = document.getElementById('iconHamburger');
    const iconClose = document.getElementById('iconClose');

    hamburgerBtn.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden', isOpen);
        iconHamburger.classList.toggle('hidden', !isOpen);
        iconClose.classList.toggle('hidden', isOpen);
    });
</script>
