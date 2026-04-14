<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - {{ setting('nama_dinas', 'Dinas PPKBPPPA') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "lib-primary": "#1e40af",
                        "lib-secondary": "#3b82f6",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                        heading: ["Poppins", "sans-serif"],
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex font-sans text-gray-800">

        {{-- Panel Kiri --}}
        <div class="hidden lg:flex w-1/2 relative bg-lib-primary overflow-hidden items-center justify-center">
            <div class="absolute inset-0 z-0">
                <img src="{{ setting('login_gambar') ? Storage::url(setting('login_gambar')) : asset('img/fish2.jpg') }}"
                    class="w-full h-full object-cover opacity-30 mix-blend-overlay" />
            </div>
            <div
                class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl">
            </div>
            <div
                class="absolute bottom-0 right-0 w-96 h-96 bg-lib-secondary/20 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl">
            </div>

            <div class="relative z-10 text-center p-12 text-white max-w-lg">
                <div class="inline-block mb-6">
                    <img src="{{ asset('img/logo-bolmut.png') }}" alt="Logo Bolmut"
                        class="w-24 h-24 object-contain drop-shadow-lg" />
                </div>
                <h2 class="text-4xl font-bold mb-4 font-heading">{{ setting('nama_dinas', 'Dinas PPKBPPPA') }}</h2>
                <p class="text-blue-100 text-lg leading-relaxed">
                    "{{ setting('login_quote', 'Mewujudkan Keluarga Sejahtera, Perempuan Berdaya, dan Anak Terlindungi.') }}"
                </p>
                <p class="text-blue-200 text-sm mt-6 font-semibold tracking-widest uppercase">Kabupaten Bolaang
                    Mongondow Utara</p>
            </div>
        </div>

        {{-- Panel Kanan (Form) --}}
        <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight font-heading">Selamat Datang Kembali</h2>
                    <p class="mt-2 text-sm text-gray-500">Silakan masuk ke akun admin
                        {{ setting('nama_dinas', 'Dinas PPKBPPPA') }}.</p>
                </div>

                {{-- Error --}}
                @if ($errors->any())
                    <div
                        class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $errors->first('username') }}
                    </div>
                @endif

                <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="space-y-5">

                        {{-- Username --}}
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBase="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="username" id="username" value="{{ old('username') }}"
                                    class="block w-full pl-10 pr-3 py-3 border @error('username') border-red-400 @else border-gray-300 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-lib-secondary focus:border-transparent transition sm:text-sm"
                                    placeholder="Username" required autofocus />
                            </div>
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input type="password" name="password" id="password"
                                    class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-lib-secondary focus:border-transparent transition sm:text-sm"
                                    placeholder="••••••••" required />
                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                                    <svg id="iconEyeOpen" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="iconEyeOff" class="h-5 w-5 hidden" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                                    <input type="checkbox" name="remember"
                                        class="rounded border-gray-300 text-lib-primary">
                                    Ingat saya
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-lib-primary to-lib-secondary hover:from-blue-800 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lib-secondary shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                            Masuk Sekarang
                        </button>
                        <button type="button" onclick="autoFill()"
                            class="mt-4 w-full text-xs text-gray-400 hover:text-gray-600 underline transition">
                            Autofill Admin (Testing Only)
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} {{ setting('nama_dinas', 'Dinas PPKBPPPA') }} Kabupaten Bolaang
                        Mongondow Utara
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const eyeOpen = document.getElementById('iconEyeOpen');
            const eyeOff = document.getElementById('iconEyeOff');

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }

        function autoFill() {
            document.getElementById('username').value = 'adminortala';
            document.getElementById('password').value = 'password123';
        }
    </script>
</body>

</html>
