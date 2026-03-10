<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dinas Perikanan Bolmut')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet" />

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
