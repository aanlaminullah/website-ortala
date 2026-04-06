@extends('layouts.app')

@section('title', 'Berita - ' . setting('nama_dinas', 'Dinas Perikanan'))

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-10 text-center">
                <h2 class="text-3xl font-heading font-bold text-gray-900 mb-2">Berita</h2>
                <p class="text-gray-600">Informasi terkini {{ setting('nama_dinas', 'Dinas Perikanan') }}</p>
                <div class="w-20 h-1.5 bg-fish-blue mx-auto mt-4 rounded-full"></div>
            </div>

            {{-- Search --}}
            <form method="GET" class="mb-8 flex gap-2 max-w-md mx-auto">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari berita..."
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-fish-blue" />
                <button type="submit"
                    class="bg-fish-blue text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-sky-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                @if ($search)
                    <a href="{{ route('berita.index') }}"
                        class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-200 transition">
                        Reset
                    </a>
                @endif
            </form>

            {{-- Error --}}
            @if (isset($error))
                <div class="text-center py-16 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm">{{ $error }}</p>
                </div>

                {{-- Kosong --}}
            @elseif($berita->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <p class="text-sm italic">Belum ada berita.</p>
                </div>

                {{-- Grid Berita --}}
            @else
                @if ($search)
                    <p class="text-sm text-gray-500 mb-6 text-center">
                        Menampilkan hasil untuk <span class="font-semibold text-fish-blue">"{{ $search }}"</span>
                        — {{ $berita->total() }} berita ditemukan
                    </p>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach ($berita as $item)
                        <a href="{{ route('berita.show', $item['slug']) }}"
                            class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:border-fish-blue/20 transition-all duration-300 group">
                            {{-- Gambar --}}
                            <div class="aspect-video overflow-hidden bg-gray-100">
                                @if ($item['gambar'])
                                    <img src="https://ppid.bolmutkab.go.id/img/{{ $item['gambar'] }}"
                                        alt="{{ $item['judul_berita'] }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                        onerror="this.src='{{ asset('img/no-image.png') }}'" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Konten --}}
                            <div class="p-4">
                                <span class="text-xs font-semibold text-fish-blue bg-blue-50 px-2 py-0.5 rounded-full">
                                    {{ $item['unitkerja'] ?? $item['username'] }}
                                </span>
                                <h3
                                    class="text-sm font-bold text-gray-900 mt-2 mb-2 line-clamp-2 group-hover:text-fish-blue transition">
                                    {{ $item['judul_berita'] }}
                                </h3>
                                <p class="text-xs text-gray-400">{{ $item['created_at'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="flex justify-center">
                    {{ $berita->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
