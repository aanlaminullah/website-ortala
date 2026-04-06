@extends('layouts.app')

@section('title', 'Publikasi Dokumen - ' . setting('nama_dinas', 'Dinas Perikanan'))

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 text-center">
                <h2 class="text-3xl font-heading font-bold text-gray-900 mb-2">Publikasi Dokumen</h2>
                <p class="text-gray-600">Dokumen resmi {{ setting('nama_dinas', 'Dinas Perikanan') }}</p>
                <div class="w-20 h-1.5 bg-fish-blue mx-auto mt-4 rounded-full"></div>
            </div>

            {{-- Filter --}}
            <form method="GET"
                class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6 flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Tahun</label>
                    <select name="tahun" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-fish-blue">
                        @foreach ($tahunList as $t)
                            <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($kategoriList->count() > 0)
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kategori</label>
                        <select name="kategori" onchange="this.form.submit()"
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-fish-blue">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoriList as $kat)
                                <option value="{{ $kat }}" {{ $kat == $kategori ? 'selected' : '' }}>
                                    {{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Cari Dokumen</label>
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ $search ?? '' }}"
                            placeholder="Cari judul atau deskripsi..."
                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-fish-blue" />
                        <button type="submit"
                            class="bg-fish-blue text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-sky-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                        @if ($search)
                            <a href="{{ route('publikasi-dokumen.index', ['tahun' => $tahun, 'kategori' => $kategori]) }}"
                                class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            {{-- Info hasil pencarian --}}
            @if ($search)
                <div class="mb-4 flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-4 h-4 text-fish-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Menampilkan hasil pencarian untuk <span
                        class="font-semibold text-fish-blue">"{{ $search }}"</span>
                    — {{ $dokumen->total() }} dokumen ditemukan
                </div>
            @endif

            {{-- List Dokumen --}}
            @if ($dokumen->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-sm italic">Belum ada dokumen untuk tahun {{ $tahun }}.</p>
                </div>
            @else
                <div class="flex flex-col gap-3 mb-6">
                    @foreach ($dokumen as $item)
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-100 px-4 py-4 flex flex-col sm:flex-row sm:items-center gap-3 hover:shadow-md hover:border-fish-blue/30 transition">

                            {{-- Baris atas: ikon + info --}}
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                <div
                                    class="shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center">
                                    <i
                                        class="bx {{ $item->ikonFile() }} text-xl sm:text-2xl {{ $item->warnaIkon() }}"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-gray-900 break-words leading-snug">
                                        {{ $item->judul }}</h3>
                                    @if ($item->deskripsi)
                                        <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $item->deskripsi }}</p>
                                    @endif
                                    <div class="flex flex-wrap items-center gap-2 mt-1">
                                        @if ($item->kategori)
                                            <span
                                                class="text-xs bg-blue-50 text-fish-blue font-semibold px-2 py-0.5 rounded-full">
                                                {{ $item->kategori }}
                                            </span>
                                        @endif
                                        <span
                                            class="text-xs text-gray-400">{{ $item->tanggal->translatedFormat('d F Y') }}</span>
                                        <span class="text-xs text-gray-400">{{ $item->ukuranFormat() }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="flex items-center gap-2 sm:shrink-0 self-end sm:self-auto">
                                <button
                                    onclick="shareDoc('{{ route('publikasi-dokumen.download', $item) }}', '{{ addslashes($item->judul) }}')"
                                    class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-2 rounded-lg hover:bg-gray-200 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    <span class="hidden sm:inline">Bagikan</span>
                                </button>
                                <a href="{{ route('publikasi-dokumen.download', $item) }}"
                                    class="inline-flex items-center gap-1.5 bg-fish-blue text-white text-xs font-semibold px-3 py-2 rounded-lg hover:bg-sky-700 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Unduh
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    {{ $dokumen->links() }}
                </div>
            @endif

        </div>
    </div>

    {{-- Toast copy link --}}
    <div id="toastCopy"
        class="fixed bottom-6 right-6 bg-gray-900 text-white text-sm font-medium px-4 py-2.5 rounded-xl shadow-lg opacity-0 transition-opacity duration-300 pointer-events-none flex items-center gap-2 z-50">
        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        Link berhasil disalin!
    </div>

    @push('scripts')
        <script>
            function shareDoc(url, judul) {
                if (navigator.share) {
                    navigator.share({
                        title: judul,
                        text: 'Unduh dokumen: ' + judul,
                        url: url,
                    });
                } else {
                    navigator.clipboard.writeText(url).then(function() {
                        const toast = document.getElementById('toastCopy');
                        toast.classList.remove('opacity-0');
                        toast.classList.add('opacity-100');
                        setTimeout(() => {
                            toast.classList.remove('opacity-100');
                            toast.classList.add('opacity-0');
                        }, 2500);
                    });
                }
            }
        </script>
    @endpush
@endsection
