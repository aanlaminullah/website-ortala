<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin') - Dinas Perikanan Bolmut</title>
    @php
        $favicon = setting('logo', 'img/logo-bolmut.png');
        $faviconUrl = str_starts_with($favicon, 'img/') ? asset($favicon) : Storage::url($favicon);
    @endphp
    <link rel="icon" type="image/png" href="{{ $faviconUrl }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    @stack('head')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#2563eb",
                        "primary-light": "#dbeafe",
                        secondary: "#8592a3",
                        success: "#71dd37",
                        info: "#03c3ec",
                        warning: "#ffab00",
                        danger: "#ff3e1d",
                        dark: "#233446",
                        body: "#f5f5f9",
                        card: "#ffffff",
                        text: "#566a7f",
                        heading: "#697a8d",
                    },
                    fontFamily: {
                        sans: ["Public Sans", "sans-serif"]
                    },
                    boxShadow: {
                        card: "0 2px 6px 0 rgba(67,89,113,0.12)"
                    },
                },
            },
        };
    </script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap");

        body {
            font-family: "Public Sans", sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #d9dee3;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-body text-text" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">

        {{-- Overlay mobile --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
            class="fixed inset-0 z-20 bg-slate-900 bg-opacity-50 lg:hidden"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-64 bg-card shadow-card transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0">

            <div class="flex items-center justify-center h-16 px-6 mt-2 mb-4">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 text-xl font-bold text-heading tracking-tight">
                    <img src="{{ str_starts_with(setting('logo', 'img/logo-bolmut.png'), 'img/') ? asset(setting('logo', 'img/logo-bolmut.png')) : Storage::url(setting('logo')) }}"
                        alt="Logo" class="h-8 w-auto object-contain" />
                    <span>{{ setting('singkatan_dinas', 'Diskan') }}<span
                            class="text-primary">{{ setting('nama_singkat', 'Bolmut') }}</span></span>
                </a>
            </div>



            <nav class="px-4 space-y-1 overflow-y-auto h-[calc(100vh-80px)]">
                <p class="px-4 text-xs font-semibold text-secondary uppercase mb-2 mt-4">Utama</p>

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                        {{ request()->routeIs('dashboard') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                    <i class="bx bx-home-circle text-xl"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                @if (setting('hero_mode', 'carousel') === 'carousel')
                    <a href="{{ route('admin.carousel.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
        {{ request()->routeIs('admin.carousel.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                        <i class="bx bx-slideshow text-xl"></i>
                        <span class="font-medium">Carousel</span>
                    </a>
                @endif

                <p class="px-4 text-xs font-semibold text-secondary uppercase mb-2 mt-6">Data</p>

                @if (setting_bool('modul_publikasi_data'))
                    <a href="{{ route('admin.publikasi-data.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
                        {{ request()->routeIs('admin.publikasi-data.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                        <i class="bx bx-bar-chart-alt-2 text-xl"></i>
                        <span class="font-medium">Publikasi Data</span>
                    </a>
                @endif

                @if (setting_bool('modul_publikasi_dokumen'))
                    <a href="{{ route('admin.publikasi-dokumen.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
            {{ request()->routeIs('admin.publikasi-dokumen.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                        <i class="bx bx-file text-xl"></i>
                        <span class="font-medium">Publikasi Dokumen</span>
                    </a>
                @endif

                @if (setting_bool('modul_pengumuman'))
                    <a href="{{ route('admin.announcements.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
        {{ request()->routeIs('admin.announcements.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                        <i class="bx bxs-megaphone text-xl"></i>
                        <span class="font-medium">Pengumuman</span>
                    </a>
                @endif

                @if (setting_bool('modul_struktur_organisasi'))
                    <a href="{{ route('admin.pejabat.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
        {{ request()->routeIs('admin.pejabat.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                        <i class="bx bx-group text-xl"></i>
                        <span class="font-medium">Struktur Organisasi</span>
                    </a>
                @endif

                @if (setting_bool('modul_visi_misi'))
                    <a href="{{ route('admin.visi-misi.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
        {{ request()->routeIs('admin.visi-misi.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                        <i class="bx bx-shield-quarter text-xl"></i>
                        <span class="font-medium">Visi & Misi</span>
                    </a>
                @endif



                <a href="{{ route('admin.lensa-kegiatan.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
        {{ request()->routeIs('admin.lensa-kegiatan.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                    <i class="bx bx-camera text-xl"></i>
                    <span class="font-medium">Lensa Kegiatan</span>
                </a>

                <a href="{{ route('admin.instansi-terkait.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
        {{ request()->routeIs('admin.instansi-terkait.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                    <i class="bx bx-buildings text-xl"></i>
                    <span class="font-medium">Instansi Terkait</span>
                </a>
                @if (Auth::user()->isAdmin())
                    <p class="px-4 text-xs font-semibold text-secondary uppercase mb-2 mt-6">Sistem</p>

                    <a href="{{ route('admin.settings.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
            {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                        <i class="bx bx-cog text-xl"></i>
                        <span class="font-medium">Pengaturan</span>
                    </a>
                @endif

                <p class="px-4 text-xs font-semibold text-secondary uppercase mb-2 mt-6">Akun</p>
                <a href="{{ route('admin.profile.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all
        {{ request()->routeIs('admin.profile.*') ? 'bg-primary text-white shadow-md shadow-primary/30' : 'text-text hover:bg-primary-light hover:text-primary' }}">
                    <i class="bx bx-user text-xl"></i>
                    <span class="font-medium">Profil Saya</span>
                </a>
            </nav>
        </aside>

        {{-- Main --}}
        <div class="flex flex-col flex-1 h-full overflow-hidden relative">

            {{-- Header --}}
            <header
                class="flex items-center justify-between h-16 px-6 bg-card/80 backdrop-blur-md m-4 rounded-xl shadow-card sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-heading lg:hidden focus:outline-none">
                        <i class="bx bx-menu text-2xl"></i>
                    </button>
                    @hasSection('back')
                        <a href="@yield('back')" class="text-secondary hover:text-primary transition">
                            <i class="bx bx-arrow-back text-xl"></i>
                        </a>
                    @endif
                    <h5 class="text-heading font-semibold text-base">@yield('page-title')</h5>
                </div>

                <div class="flex items-center gap-4">
                    @yield('header-actions')

                    {{-- Avatar --}}
                    <div class="relative group">
                        <div
                            class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold cursor-pointer select-none">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div
                            class="absolute right-0 top-12 w-56 bg-card rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div
                                class="absolute -top-1.5 right-3 w-3 h-3 bg-card border-l border-t border-gray-100 rotate-45">
                            </div>
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center text-sm font-bold shrink-0">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-heading truncate">{{ Auth::user()->name }}
                                        </p>
                                        <p class="text-xs text-secondary truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 border-b border-gray-100">
                                <a href="{{ route('admin.profile.index') }}"
                                    class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-text hover:bg-primary-light hover:text-primary text-sm transition">
                                    <i class="bx bx-user text-lg"></i> Profil Saya
                                </a>
                                <a href="{{ route('admin.profile.password.edit') }}"
                                    class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-text hover:bg-primary-light hover:text-primary text-sm transition">
                                    <i class="bx bx-lock-alt text-lg"></i> Ubah Password
                                </a>
                            </div>
                            <div class="p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-danger hover:bg-danger/10 text-sm transition">
                                        <i class="bx bx-log-out text-lg"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto px-6 pb-6">
                <div class="flex flex-col" style="min-height: calc(100vh - 112px);">

                    @if (session('success'))
                        <div
                            class="mb-4 px-4 py-3 bg-green-50 text-green-700 border border-green-200 rounded-xl text-sm flex items-center gap-2">
                            <i class="bx bx-check-circle text-lg"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex-1">
                        @yield('content')
                    </div>

                    <footer class="mt-8 text-center text-sm text-secondary">
                        &copy; {{ date('Y') }} Dinas Perikanan Kabupaten Bolaang Mongondow Utara
                    </footer>
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
    <script>
        document.querySelectorAll('[data-tab]').forEach(function(tab) {
            tab.addEventListener('click', function() {
                const activeTabInput = document.getElementById('active_tab');
                if (activeTabInput) activeTabInput.value = this.dataset.tab;
            });
        });
    </script>

    <div id="globalLoading"
        class="fixed inset-0 z-[9999] bg-black/20 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200">
        <img src="{{ asset('loading.svg') }}" alt="Loading..." class="w-16 h-16"
            style="background: transparent; mix-blend-mode: multiply;" />
    </div>

    <script>
        const _loading = document.getElementById('globalLoading');

        function showLoading() {
            _loading.classList.remove('opacity-0', 'pointer-events-none');
            _loading.classList.add('opacity-100');
        }

        function hideLoading() {
            _loading.classList.add('opacity-0', 'pointer-events-none');
            _loading.classList.remove('opacity-100');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Semua form submit
            document.querySelectorAll('form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    const hasConfirm = form.getAttribute('onsubmit');
                    if (hasConfirm) {
                        const confirmed = confirm(form.getAttribute('onsubmit').replace(
                            "return confirm('", '').replace("')", ''));
                        if (!confirmed) return;
                        form.removeAttribute('onsubmit');
                    }
                    showLoading();
                });
            });

            // Semua link navigasi sidebar & header (kecuali yang buka tab baru)
            document.querySelectorAll('a[href]').forEach(function(link) {
                const href = link.getAttribute('href');
                if (
                    !href ||
                    href === '#' ||
                    href.startsWith('javascript') ||
                    href.startsWith('mailto') ||
                    href.startsWith('tel') ||
                    link.getAttribute('target') === '_blank'
                ) return;

                link.addEventListener('click', function(e) {
                    showLoading();
                });
            });

            // Sembunyikan loading saat halaman selesai load (back/forward)
            window.addEventListener('pageshow', function() {
                hideLoading();
            });
        });
    </script>
</body>

</html>
