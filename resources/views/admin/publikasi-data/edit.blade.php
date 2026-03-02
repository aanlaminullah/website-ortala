@extends('layouts.admin')

@section('title', 'Edit Data Produksi')
@section('page-title', 'Edit Data Produksi')
@section('back', route('admin.publikasi-data.index'))

@section('content')
    <form action="{{ route('admin.publikasi-data.update', $produksiBudidaya->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-card rounded-xl shadow-card p-6 mb-4">
            <h6 class="text-heading font-semibold mb-4">Informasi Umum</h6>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Kecamatan --}}
                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Kecamatan</label>
                    <select name="kecamatan_id"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('kecamatan_id') border-red-400 @enderror">
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach ($kecamatanList as $kec)
                            <option value="{{ $kec->id }}"
                                {{ old('kecamatan_id', $produksiBudidaya->kecamatan_id) == $kec->id ? 'selected' : '' }}>
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
                    <label class="block text-sm font-medium text-heading mb-1">Komoditas</label>
                    <input type="text" name="komoditas" value="{{ old('komoditas', $produksiBudidaya->komoditas) }}"
                        list="komoditas-list"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('komoditas') border-red-400 @enderror" />
                    <datalist id="komoditas-list">
                        @foreach ($komoditasList as $kom)
                            <option value="{{ $kom }}">
                        @endforeach
                    </datalist>
                    @error('komoditas')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tahun --}}
                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Tahun</label>
                    <input type="number" name="tahun" value="{{ old('tahun', $produksiBudidaya->tahun) }}" min="2000"
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
                        <input type="number" name="{{ $bulan }}"
                            value="{{ old($bulan, $produksiBudidaya->$bulan) }}" min="0" step="0.001"
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
                <i class="bx bx-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
@endsection
