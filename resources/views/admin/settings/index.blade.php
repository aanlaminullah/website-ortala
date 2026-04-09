@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan Website')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="active_tab" id="active_tab" value="identitas">

        {{-- Tab Navigation --}}
        <div x-data="{ tab: new URLSearchParams(window.location.search).get('tab') || 'identitas' }" class="space-y-6">
            <div class="flex gap-2 bg-card rounded-xl shadow-card p-2 w-fit">
                @foreach ([
            'identitas' => 'Identitas',
            'hero' => 'Halaman Utama',
            'warna' => 'Warna Tema',
            'modul' => 'Modul',
        ] as $key => $label)
                    <button type="button" data-tab="{{ $key }}" @click="tab = '{{ $key }}'"
                        :class="tab === '{{ $key }}' ? 'bg-primary text-white shadow' :
                            'text-secondary hover:text-primary'"
                        class="px-4 py-2 rounded-lg text-sm font-semibold transition">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            {{-- Tab Identitas --}}
            <div x-show="tab === 'identitas'" class="bg-card rounded-xl shadow-card p-6 space-y-5">
                <h5 class="font-bold text-heading text-lg border-b border-gray-100 pb-3">Identitas Dinas</h5>

                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Nama Dinas</label>
                    <input type="text" name="nama_dinas" value="{{ setting('nama_dinas') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Singkatan Dinas</label>
                    <input type="text" name="singkatan_dinas" value="{{ setting('singkatan_dinas') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                    <p class="text-xs text-secondary mt-1">Digunakan di sidebar dashboard. Contoh: Diskan</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Sub Nama Dinas</label>
                    <input type="text" name="sub_nama_dinas" value="{{ setting('sub_nama_dinas') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Nama Singkat Daerah</label>
                    <input type="text" name="nama_singkat" value="{{ setting('nama_singkat') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                    <p class="text-xs text-secondary mt-1">Digunakan di sidebar dashboard. Contoh: Bolmut</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Logo</label>
                    @if (setting('logo'))
                        <div class="mb-2">
                            <img src="{{ str_starts_with(setting('logo'), 'img/') ? asset(setting('logo')) : Storage::url(setting('logo')) }}"
                                class="h-14 object-contain border rounded-lg p-2 bg-gray-50" />
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Alias Berita (API)</label>
                    <input type="text" name="berita_alias" value="{{ setting('berita_alias', 'bpkd') }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                    <p class="text-xs text-secondary mt-1">Alias unit kerja untuk mengambil berita dari API. Contoh: bpkd,
                        diskan</p>
                </div>
            </div>

            {{-- Tab Hero --}}
            <div x-show="tab === 'hero'" class="space-y-6" x-data="{ mode: '{{ setting('hero_mode', 'carousel') }}' }">
                <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 bg-gray-50">
                    <div>
                        <p class="text-sm font-semibold text-heading">Mode Tampilan Halaman Utama</p>
                        <p class="text-xs text-secondary mt-0.5">Pilih antara Hero (teks sambutan) atau Carousel (slideshow
                            foto)</p>
                    </div>
                    <div class="flex items-center gap-2 shrink-0 ml-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="hero_mode" value="hero"
                                {{ setting('hero_mode', 'carousel') === 'hero' ? 'checked' : '' }} @change="mode = 'hero'"
                                class="text-primary" />
                            <span class="text-sm font-medium text-heading">Hero</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer ml-4">
                            <input type="radio" name="hero_mode" value="carousel"
                                {{ setting('hero_mode', 'carousel') === 'carousel' ? 'checked' : '' }}
                                @change="mode = 'carousel'" class="text-primary" />
                            <span class="text-sm font-medium text-heading">Carousel</span>
                        </label>
                    </div>
                </div>

                {{-- Info banner mode carousel --}}
                <div x-show="mode === 'carousel'"
                    class="flex items-start gap-3 p-4 rounded-xl border border-blue-100 bg-blue-50 text-blue-700 text-sm">
                    <i class="bx bx-info-circle text-xl shrink-0 mt-0.5"></i>
                    <p>Mode <strong>Carousel</strong> aktif. Halaman utama akan menampilkan slideshow foto.
                        Anda dapat mengelola slide di menu <strong>Carousel</strong> pada sidebar.
                        Upload gambar hero di bawah tidak digunakan dalam mode ini.</p>
                </div>

                {{-- Info banner mode hero --}}
                <div x-show="mode === 'hero'"
                    class="flex items-start gap-3 p-4 rounded-xl border border-green-100 bg-green-50 text-green-700 text-sm">
                    <i class="bx bx-info-circle text-xl shrink-0 mt-0.5"></i>
                    <p>Mode <strong>Hero</strong> aktif. Halaman utama akan menampilkan banner statis dengan teks sambutan.
                        Menu Carousel pada sidebar tidak dapat diakses dalam mode ini.</p>
                </div>

                <div class="bg-card rounded-xl shadow-card p-6 space-y-5">
                    <h5 class="font-bold text-heading text-lg border-b border-gray-100 pb-3">Konten Halaman Utama</h5>

                    <div>
                        <label class="block text-sm font-medium text-heading mb-1">Judul Hero</label>
                        <input type="text" name="hero_judul" value="{{ setting('hero_judul') }}"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-heading mb-1">Sub Judul Hero</label>
                        <textarea name="hero_subjudul" rows="3"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary resize-none">{{ setting('hero_subjudul') }}</textarea>
                    </div>

                    {{-- Gambar hero hanya muncul saat mode hero --}}
                    <div x-show="mode === 'hero'">
                        <label class="block text-sm font-medium text-heading mb-1">Gambar Background Hero</label>
                        @if (setting('hero_gambar'))
                            <div class="mb-2">
                                <img src="{{ Storage::url(setting('hero_gambar')) }}"
                                    class="h-28 w-full object-cover rounded-lg border" />
                            </div>
                        @endif
                        <input type="file" name="hero_gambar" accept="image/*"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-heading mb-1">Gambar Background Login</label>
                        @if (setting('login_gambar'))
                            <div class="mb-2">
                                <img src="{{ Storage::url(setting('login_gambar')) }}"
                                    class="h-28 w-full object-cover rounded-lg border" />
                            </div>
                        @endif
                        <input type="file" name="login_gambar" accept="image/*"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-heading mb-1">Quote Halaman Login</label>
                        <textarea name="login_quote" rows="3"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary resize-none">{{ setting('login_quote') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tab Warna --}}
            <div x-show="tab === 'warna'" class="bg-card rounded-xl shadow-card p-6 space-y-5">
                <h5 class="font-bold text-heading text-lg border-b border-gray-100 pb-3">Warna Tema</h5>
                <p class="text-secondary text-sm">Perubahan warna akan langsung diterapkan ke seluruh halaman website.</p>

                @foreach ([
            'warna_primer' => 'Warna Utama (Primer)',
            'warna_gelap' => 'Warna Gelap',
            'warna_aksen' => 'Warna Aksen',
        ] as $key => $label)
                    <div class="flex items-center gap-4">
                        <input type="color" name="{{ $key }}" value="{{ setting($key) }}"
                            class="w-12 h-10 rounded-lg border border-gray-200 cursor-pointer p-1" />
                        <div>
                            <p class="text-sm font-medium text-heading">{{ $label }}</p>
                            <p class="text-xs text-secondary font-mono">{{ setting($key) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tab Modul --}}
            <div x-show="tab === 'modul'" class="bg-card rounded-xl shadow-card p-6 space-y-4">
                <h5 class="font-bold text-heading text-lg border-b border-gray-100 pb-3">Aktifkan / Nonaktifkan Modul</h5>
                <p class="text-secondary text-sm">Modul yang dinonaktifkan tidak akan muncul di navbar maupun sidebar
                    admin.
                </p>

                @foreach ([
            'modul_publikasi_data' => ['label' => 'Data Produksi Budidaya', 'desc' => 'Data produksi budidaya perikanan'],
            'modul_data_tangkap' => ['label' => 'Data Tangkap', 'desc' => 'Data produksi tangkap perikanan'],
            'modul_publikasi_dokumen' => ['label' => 'Publikasi Dokumen', 'desc' => 'Dokumen publik seperti laporan, SK, peraturan'],
            'modul_pengumuman' => ['label' => 'Pengumuman', 'desc' => 'Pengumuman & informasi publik'],
            'modul_berita' => ['label' => 'Berita', 'desc' => 'Kabar & artikel berita'],
            'modul_struktur_organisasi' => ['label' => 'Struktur Organisasi', 'desc' => 'Data pejabat dinas'],
            'modul_visi_misi' => ['label' => 'Visi & Misi', 'desc' => 'Visi dan misi dinas'],
        ] as $key => $item)
                    <label
                        class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:bg-gray-50 cursor-pointer transition">
                        <div>
                            <p class="text-sm font-semibold text-heading">{{ $item['label'] }}</p>
                            <p class="text-xs text-secondary">{{ $item['desc'] }}</p>
                        </div>
                        <div class="relative">
                            <input type="checkbox" name="{{ $key }}" value="1"
                                {{ setting_bool($key) ? 'checked' : '' }} class="sr-only peer" />
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary transition-colors">
                            </div>
                            <div
                                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5">
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>

            {{-- Tombol Simpan --}}
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-primary text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-primary/90 transition">
                    Simpan Semua Perubahan
                </button>
            </div>
        </div>
    </form>
@endsection
