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
                <i class="bx bx-water text-primary" style="font-size: 12rem; line-height:1"></i>
            </div>
            <p class="text-secondary text-sm font-semibold mb-1">Selamat Datang,</p>
            <h4 class="text-heading font-bold text-2xl mb-1">{{ Auth::user()->name }} 👋</h4>
            <p class="text-secondary text-sm mb-4">Berikut ringkasan data perikanan budidaya Kabupaten Bolmut tahun
                {{ $tahun }}.</p>
            <a href="{{ route('publikasi-data.index') }}"
                class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
                <i class="bx bx-bar-chart-alt-2"></i> Lihat Publikasi Data
            </a>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 gap-4">
            <div class="bg-card p-4 rounded-xl shadow-card flex flex-col justify-between">
                <div class="bg-primary/10 text-primary w-10 h-10 rounded-lg flex items-center justify-center mb-2">
                    <i class="bx bx-trending-up text-xl"></i>
                </div>
                <span class="text-secondary text-sm font-semibold mb-1">Total Produksi</span>
                <h3 class="text-heading text-xl font-bold">{{ number_format($totalProduksi, 2, ',', '.') }}
                    <span class="text-sm font-normal">Ton</span>
                </h3>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-card p-4 rounded-xl shadow-card">
                    <div class="bg-info/10 text-info w-10 h-10 rounded-lg flex items-center justify-center mb-2">
                        <i class="bx bx-category text-xl"></i>
                    </div>
                    <span class="text-secondary text-xs font-semibold">Komoditas</span>
                    <h3 class="text-heading text-xl font-bold">{{ $totalKomoditas }}</h3>
                </div>
                <div class="bg-card p-4 rounded-xl shadow-card">
                    <div class="bg-warning/10 text-warning w-10 h-10 rounded-lg flex items-center justify-center mb-2">
                        <i class="bx bx-map text-xl"></i>
                    </div>
                    <span class="text-secondary text-xs font-semibold">Kecamatan</span>
                    <h3 class="text-heading text-xl font-bold">{{ $totalKecamatan }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart & Tabel --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="col-span-1 lg:col-span-2 bg-card rounded-xl shadow-card p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h5 class="text-heading font-bold text-lg">Produksi per Kecamatan</h5>
                    <p class="text-secondary text-sm">Total akumulasi tahun {{ $tahun }}</p>
                </div>
            </div>
            <canvas id="chartKecamatan" height="120"></canvas>
        </div>

        <div class="col-span-1 bg-card rounded-xl shadow-card p-6">
            <h5 class="text-heading font-bold text-lg mb-4">Top Komoditas</h5>
            <ul class="space-y-4">
                @foreach ($topKomoditas as $item)
                    @php $persen = $totalProduksi > 0 ? round(($item->total / $totalProduksi) * 100, 1) : 0; @endphp
                    <li>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-semibold text-heading">{{ $item->komoditas }}</span>
                            <span class="text-secondary">{{ number_format($item->total, 2, ',', '.') }} Ton</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: {{ $persen }}%"></div>
                        </div>
                        <p class="text-xs text-secondary mt-0.5">{{ $persen }}% dari total</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const ctx = document.getElementById('chartKecamatan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($produksiPerKecamatan->pluck('kecamatan')),
                datasets: [{
                    label: 'Total Produksi (Ton)',
                    data: @json($produksiPerKecamatan->pluck('total')),
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
                            color: '#8592a3'
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
