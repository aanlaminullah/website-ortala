@extends('layouts.app')

@section('title', 'Lensa Kegiatan - ' . setting('nama_dinas', 'Dinas Perikanan'))

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 text-center">
                <h2 class="text-3xl font-heading font-bold text-gray-900 mb-2">Lensa Kegiatan</h2>
                <p class="text-gray-600">Dokumentasi kegiatan {{ setting('nama_dinas', 'Dinas Perikanan') }}</p>
                <div class="w-20 h-1.5 bg-fish-blue mx-auto mt-4 rounded-full"></div>
            </div>

            @if ($lensaKegiatan->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-sm italic">Belum ada foto kegiatan.</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
                    @foreach ($lensaKegiatan as $item)
                        <div class="aspect-square bg-gray-200 rounded-xl overflow-hidden relative group cursor-pointer"
                            onclick="bukaLightbox('{{ Storage::url($item->foto) }}', '{{ $item->judul }}', '{{ $item->tanggal->translatedFormat('d F Y') }}')">
                            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                                class="w-full h-full object-cover transition duration-300 group-hover:scale-110" />
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex flex-col items-start justify-end p-4">
                                @if ($item->judul)
                                    <span class="text-white text-sm font-semibold">{{ $item->judul }}</span>
                                @endif
                                <span class="text-white/70 text-xs mt-1">
                                    {{ $item->tanggal->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            {{-- Icon zoom --}}
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-1.5">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Lightbox --}}
                <div id="lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 px-4"
                    onclick="tutupLightbox(event)">
                    <div class="relative max-w-4xl w-full" onclick="event.stopPropagation()">
                        {{-- Tombol tutup --}}
                        <button onclick="tutupLightbox()"
                            class="absolute -top-10 right-0 text-white/70 hover:text-white transition">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        {{-- Gambar --}}
                        <img id="lightboxImg" src="" alt=""
                            class="w-full max-h-[80vh] object-contain rounded-xl shadow-2xl" />

                        {{-- Caption --}}
                        <div class="mt-4 text-center">
                            <p id="lightboxJudul" class="text-white font-semibold text-lg"></p>
                            <p id="lightboxTanggal" class="text-white/60 text-sm mt-1"></p>
                        </div>
                    </div>
                </div>

                @push('scripts')
                    <script>
                        function bukaLightbox(src, judul, tanggal) {
                            document.getElementById('lightboxImg').src = src;
                            document.getElementById('lightboxJudul').textContent = judul || '';
                            document.getElementById('lightboxTanggal').textContent = tanggal || '';
                            const lb = document.getElementById('lightbox');
                            lb.classList.remove('hidden');
                            lb.classList.add('flex');
                            document.body.style.overflow = 'hidden';
                        }

                        function tutupLightbox(event) {
                            if (event && event.target !== document.getElementById('lightbox')) return;
                            const lb = document.getElementById('lightbox');
                            lb.classList.add('hidden');
                            lb.classList.remove('flex');
                            document.body.style.overflow = '';
                        }

                        document.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape') {
                                const lb = document.getElementById('lightbox');
                                lb.classList.add('hidden');
                                lb.classList.remove('flex');
                                document.body.style.overflow = '';
                            }
                        });
                    </script>
                @endpush

                {{-- Pagination --}}
                <div class="flex justify-center">
                    {{ $lensaKegiatan->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
