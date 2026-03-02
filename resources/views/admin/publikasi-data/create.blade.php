@extends('layouts.admin')

@section('title', 'Tambah Data Produksi')
@section('page-title', 'Tambah Data Produksi')
@section('back', route('admin.publikasi-data.index'))

@section('content')
    <form action="{{ route('admin.publikasi-data.store') }}" method="POST" x-data="{ komoditasMode: 'pilih' }">
        @csrf

        <div class="bg-card rounded-xl shadow-card p-6 mb-4">
            <h6 class="text-heading font-semibold mb-4">Informasi Umum</h6>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">

                {{-- Kecamatan --}}
                <div>
                    <div class="flex items-center justify-between mb-1" style="min-height: 28px;">
                        <label class="text-sm font-medium text-heading">Kecamatan</label>
                    </div>
                    <select name="kecamatan_id"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('kecamatan_id') border-red-400 @enderror">
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach ($kecamatanList as $kec)
                            <option value="{{ $kec->id }}" {{ old('kecamatan_id') == $kec->id ? 'selected' : '' }}>
                                {{ $kec->kode }} – {{ $kec->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kecamatan_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Komoditas --}}
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="text-sm font-medium text-heading">Komoditas</label>
                        <div class="flex gap-1">
                            <button type="button" @click="komoditasMode = 'pilih'"
                                :class="komoditasMode === 'pilih' ? 'bg-primary text-white' : 'bg-gray-100 text-text'"
                                class="text-xs px-3 py-1 rounded-lg transition">Pilih</button>
                            <button type="button" @click="komoditasMode = 'baru'"
                                :class="komoditasMode === 'baru' ? 'bg-primary text-white' : 'bg-gray-100 text-text'"
                                class="text-xs px-3 py-1 rounded-lg transition">+ Baru</button>
                        </div>
                    </div>
                    <div x-show="komoditasMode === 'pilih'">
                        <select name="komoditas_pilih"
                            onchange="document.getElementById('komoditas_hidden').value = this.value"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('komoditas') border-red-400 @enderror">
                            <option value="">-- Pilih Komoditas --</option>
                            @foreach ($komoditasList as $kom)
                                <option value="{{ $kom }}">{{ $kom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div x-show="komoditasMode === 'baru'">
                        <input type="text" placeholder="Nama Komoditas Baru"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none"
                            oninput="document.getElementById('komoditas_hidden').value = this.value" />
                    </div>
                    <input type="hidden" name="komoditas" id="komoditas_hidden" value="{{ old('komoditas') }}" />
                    @error('komoditas')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tahun --}}
                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" min="2000"
                        max="2099"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('tahun') border-red-400 @enderror" />
                    @error('tahun')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Data Per Bulan --}}
        <div class="bg-card rounded-xl shadow-card p-6 mb-4">
            <h6 class="text-heading font-semibold mb-4">Produksi Per Bulan <span
                    class="text-secondary text-xs font-normal">(dalam Ton)</span></h6>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach (['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'] as $bulan)
                    <div>
                        <label class="block text-xs font-medium text-secondary mb-1 capitalize">{{ $bulan }}</label>
                        <input type="number" name="{{ $bulan }}" value="{{ old($bulan, 0) }}" min="0"
                            step="0.001"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none" />
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Action --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.publikasi-data.index') }}"
                class="px-4 py-2 text-sm text-text border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit"
                class="px-5 py-2 text-sm font-semibold bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                <i class="bx bx-save mr-1"></i> Simpan Data
            </button>
        </div>
    </form>
@endsection
