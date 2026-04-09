@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    {{-- Welcome Banner --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="col-span-1 lg:col-span-2 bg-card rounded-xl shadow-card p-6 relative overflow-hidden">
            <div class="absolute right-0 top-0 h-full w-48 opacity-10">
                <i class="bx bx-building-house text-primary" style="font-size: 12rem; line-height:1"></i>
            </div>
            <p class="text-secondary text-sm font-semibold mb-1">Selamat Datang,</p>
            <h4 class="text-heading font-bold text-2xl mb-1">{{ Auth::user()->name }} 👋</h4>
            <p class="text-secondary text-sm mb-4">Berikut ringkasan pengelolaan konten website
                {{ setting('nama_instansi') }}.</p>
            <a href="{{ route('publikasi-dokumen.index') }}"
                class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
                <i class="bx bx-file"></i> Lihat Dokumen Publikasi
            </a>
        </div>

        {{-- Stat Cards (kanan) --}}
        <div class="grid grid-cols-1 gap-4">
            <div class="bg-card p-4 rounded-xl shadow-card flex flex-col justify-between">
                <div class="bg-primary/10 text-primary w-10 h-10 rounded-lg flex items-center justify-center mb-2">
                    <i class="bx bx-file text-xl"></i>
                </div>
                <span class="text-secondary text-sm font-semibold mb-1">Total Dokumen Publikasi</span>
                <h3 class="text-heading text-xl font-bold">{{ $totalDokumen }}</h3>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-card p-4 rounded-xl shadow-card">
                    <div class="bg-info/10 text-info w-10 h-10 rounded-lg flex items-center justify-center mb-2">
                        <i class="bx bx-bell text-xl"></i>
                    </div>
                    <span class="text-secondary text-xs font-semibold">Pengumuman</span>
                    <h3 class="text-heading text-xl font-bold">{{ $totalPengumuman }}</h3>
                </div>
                <div class="bg-card p-4 rounded-xl shadow-card">
                    <div class="bg-warning/10 text-warning w-10 h-10 rounded-lg flex items-center justify-center mb-2">
                        <i class="bx bx-buildings text-xl"></i>
                    </div>
                    <span class="text-secondary text-xs font-semibold">Instansi Terkait</span>
                    <h3 class="text-heading text-xl font-bold">{{ $totalInstansi }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Mini stat row --}}
    <div class="grid grid-cols-2 lg:grid-cols-2 gap-4 mb-6">
        <div class="bg-card p-4 rounded-xl shadow-card flex items-center gap-4">
            <div class="bg-success/10 text-success w-10 h-10 rounded-lg flex items-center justify-center shrink-0">
                <i class="bx bx-images text-xl"></i>
            </div>
            <div>
                <span class="text-secondary text-xs font-semibold block">Lensa Kegiatan Aktif</span>
                <h3 class="text-heading text-xl font-bold">{{ $totalLensa }}</h3>
            </div>
        </div>
        <div class="bg-card p-4 rounded-xl shadow-card flex items-center gap-4">
            <div class="bg-danger/10 text-danger w-10 h-10 rounded-lg flex items-center justify-center shrink-0">
                <i class="bx bx-slideshow text-xl"></i>
            </div>
            <div>
                <span class="text-secondary text-xs font-semibold block">Total Carousel</span>
                <h3 class="text-heading text-xl font-bold">{{ $totalCarousel }}</h3>
            </div>
        </div>
    </div>

    {{-- Chart & Pengumuman Terbaru --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="col-span-1 lg:col-span-2 bg-card rounded-xl shadow-card p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h5 class="text-heading font-bold text-lg">Dokumen Diterbitkan per Bulan</h5>
                    <p class="text-secondary text-sm">Tahun berjalan {{ $tahun }}</p>
                </div>
            </div>
            <canvas id="chartDokumen" height="120"></canvas>
        </div>

        <div class="col-span-1 bg-card rounded-xl shadow-card p-6">
            <h5 class="text-heading font-bold text-lg mb-4">Pengumuman Terbaru</h5>
            <ul class="space-y-3">
                @forelse ($pengumumanTerbaru as $item)
                    <li class="flex items-start gap-3">
                        <div class="bg-primary/10 text-primary w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                            <i class="bx bx-bell text-sm"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-heading text-sm font-semibold leading-snug line-clamp-2">{{ $item->title }}</p>
                            <p class="text-secondary text-xs mt-0.5">
                                {{ $item->date ? $item->date->translatedFormat('d M Y') : '-' }}
                                @if ($item->category)
                                    &middot; <span class="capitalize">{{ $item->category }}</span>
                                @endif
                            </p>
                        </div>
                    </li>
                @empty
                    <li class="text-secondary text-sm">Belum ada pengumuman.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const ctx = document.getElementById('chartDokumen').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: bulanLabels,
                datasets: [{
                    label: 'Dokumen Diterbitkan',
                    data: @json($chartData),
                    backgroundColor: '#696cff33',
                    borderColor: '#696cff',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#8592a3',
                            precision: 0
                        },
                        grid: {
                            color: '#f0f0f0'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#8592a3'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
