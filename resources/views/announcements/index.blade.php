@extends('layouts.app')

@section('title', 'Daftar Pengumuman - Dinas Perikanan Bolmut')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-heading font-bold text-gray-900 mb-2">Pengumuman Terkini</h2>
                <p class="text-gray-600">Informasi terbaru seputar layanan dan kebijakan Dinas Perikanan Bolmut</p>
                <div class="w-20 h-1.5 bg-fish-blue mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">
                @foreach ($announcements as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition group">
                        <div class="flex items-start gap-4">
                            <div
                                class="bg-blue-50 text-fish-blue p-3 rounded-lg group-hover:bg-fish-blue group-hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <span
                                        class="text-xs font-bold text-fish-accent uppercase tracking-wider">{{ $item['category'] }}</span>
                                    <span
                                        class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($item['date'])->format('Y-m-d') }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-fish-blue transition">
                                    {{ $item['title'] }}
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $item['description'] }}
                                </p>
                                <div class="flex items-center gap-4">
                                    <a href="#" class="text-sm font-semibold text-fish-blue hover:underline">Baca
                                        Selengkapnya &rarr;</a>
                                    <a href="#" class="text-xs text-gray-400 flex items-center hover:text-fish-blue">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Unduh Lampiran
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
