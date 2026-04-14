<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dinas Perikanan Bolmut')</title>
    @php
        $favicon = setting('logo', 'img/logo-bolmut.png');
        $faviconUrl = str_starts_with($favicon, 'img/') ? asset($favicon) : Storage::url($favicon);
        
        $metaDescription = setting('hero_subjudul', 'Sistem Informasi Dinas Perikanan Kabupaten Bolaang Mongondow Utara.');
        if (!empty(trim(setting('meta_description')))) {
            $metaDescription = setting('meta_description');
        }
    @endphp
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="@yield('title', 'Dinas Perikanan Bolmut')" />
    <meta name="description" content="@yield('meta_description', $metaDescription)" />
    <meta name="keywords" content="@yield('meta_keywords', 'dinas perikanan, bolmut, bolaang mongondow utara, perikanan, kelautan, ppid, pemerintah')" />
    <meta name="author" content="{{ setting('nama_dinas', 'Dinas Perikanan Bolmut') }}" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('title', 'Dinas Perikanan Bolmut')" />
    <meta property="og:description" content="@yield('meta_description', $metaDescription)" />
    <meta property="og:image" content="@yield('meta_image', setting('hero_gambar') ? Storage::url(setting('hero_gambar')) : $faviconUrl)" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="@yield('title', 'Dinas Perikanan Bolmut')" />
    <meta property="twitter:description" content="@yield('meta_description', $metaDescription)" />
    <meta property="twitter:image" content="@yield('meta_image', setting('hero_gambar') ? Storage::url(setting('hero_gambar')) : $faviconUrl)" />

    <link rel="icon" type="image/png" href="{{ $faviconUrl }}" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        :root {
            --fish-blue: {{ setting('warna_primer', '#0284c7') }};
            --fish-dark: {{ setting('warna_gelap', '#0c4a6e') }};
            --fish-accent: {{ setting('warna_aksen', '#fbbf24') }};
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "fish-blue": "{{ setting('warna_primer', '#0284c7') }}",
                        "fish-dark": "{{ setting('warna_gelap', '#0c4a6e') }}",
                        "fish-accent": "{{ setting('warna_aksen', '#fbbf24') }}",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                        heading: ["Poppins", "sans-serif"],
                    },
                },
            },
        };
    </script>
    <style>
        .clip-slant {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .scroll-hide::-webkit-scrollbar {
            display: none;
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid #e5e7eb;
        }
    </style>

</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased flex flex-col min-h-screen">

    @include('partials.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')

</body>

</html>
