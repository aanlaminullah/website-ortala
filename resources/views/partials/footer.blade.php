<footer class="bg-gray-900 text-gray-300 text-sm mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Kolom 1: Identitas --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ str_starts_with(setting('logo', 'img/logo-bolmut.png'), 'img/') ? asset(setting('logo', 'img/logo-bolmut.png')) : Storage::url(setting('logo')) }}"
                        alt="Logo" class="h-10 w-auto object-contain" />
                    <div class="leading-tight">
                        <p class="text-white font-bold text-sm">{{ setting('nama_dinas', 'Bagian Ortala') }}</p>
                        <p class="text-gray-500 text-xs">
                            {{ setting('sub_nama_dinas', 'Pemerintah Kab. Bolaang Mongondow Utara') }}</p>
                    </div>
                </div>
                {{-- Sosial Media --}}
                @if (setting('kontak_facebook') || setting('kontak_instagram'))
                    <div class="flex gap-3 mt-4">
                        @if (setting('kontak_facebook'))
                            <a href="{{ setting('kontak_facebook') }}" target="_blank" rel="noopener"
                                class="bg-gray-800 hover:bg-blue-600 text-gray-400 hover:text-white w-9 h-9 rounded-lg flex items-center justify-center transition">
                                <i class="bx bxl-facebook text-lg"></i>
                            </a>
                        @endif
                        @if (setting('kontak_instagram'))
                            <a href="{{ setting('kontak_instagram') }}" target="_blank" rel="noopener"
                                class="bg-gray-800 hover:bg-pink-600 text-gray-400 hover:text-white w-9 h-9 rounded-lg flex items-center justify-center transition">
                                <i class="bx bxl-instagram text-lg"></i>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Kolom 2: Kontak --}}
            <div>
                <h3 class="text-white font-bold text-lg mb-4">
                    {{ setting('kontak_nama_instansi', 'Kontak') }}
                </h3>
                <ul class="space-y-2.5 text-gray-400">
                    @if (setting('kontak_alamat'))
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5 shrink-0">📍</span>
                            <span>{{ setting('kontak_alamat') }}</span>
                        </li>
                    @endif
                    @if (setting('kontak_telepon'))
                        <li class="flex items-center gap-2">
                            <span class="shrink-0">📞</span>
                            <a href="tel:{{ setting('kontak_telepon') }}"
                                class="hover:text-white transition">{{ setting('kontak_telepon') }}</a>
                        </li>
                    @endif
                    @if (setting('kontak_email'))
                        <li class="flex items-center gap-2">
                            <span class="shrink-0">✉️</span>
                            <a href="mailto:{{ setting('kontak_email') }}"
                                class="hover:text-white transition">{{ setting('kontak_email') }}</a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Kolom 3: Maps --}}
            @if (setting('kontak_maps_url'))
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Lokasi</h3>
                    <div class="rounded-xl overflow-hidden border border-gray-700 h-40">
                        <iframe src="{{ setting('kontak_maps_url') }}" width="100%" height="100%" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            @else
                {{-- Placeholder kolom 3 jika maps belum diisi --}}
                <div class="hidden md:block"></div>
            @endif

        </div>

        <div class="border-t border-gray-800 pt-8 mt-8 text-center text-gray-500 text-xs">
            &copy; {{ date('Y') }} {{ setting('nama_dinas', 'Bagian Organisasi dan Tata Laksana') }}
            &mdash; {{ setting('sub_nama_dinas', 'Pemerintah Kabupaten Bolaang Mongondow Utara') }}.
            All Rights Reserved.
        </div>
    </div>
</footer>
