@extends('layouts.admin')

@section('title', 'Import Data Excel')
@section('page-title', 'Import Data Excel')
@section('back', route('admin.publikasi-data.index'))

@section('content')
    <div x-data="{ fileName: '', dragging: false }">

        {{-- Error import --}}
        @if (session('import_errors'))
            <div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-4">
                <p class="text-sm font-semibold text-red-600 mb-2 flex items-center gap-2">
                    <i class="bx bx-error-circle text-lg"></i> Terdapat kesalahan pada file:
                </p>
                <ul class="list-disc list-inside text-xs text-red-500 space-y-1">
                    @foreach (session('import_errors') as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Form Upload --}}
            <div class="lg:col-span-2 bg-card rounded-xl shadow-card p-6">
                <h6 class="text-heading font-semibold mb-1">Upload File</h6>
                <p class="text-secondary text-sm mb-5">Format yang didukung: <strong>.xlsx, .xls, .csv</strong>. Maksimal
                    5MB.</p>

                <form action="{{ route('admin.publikasi-data.import.process') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="border-2 border-dashed rounded-xl p-8 text-center transition cursor-pointer"
                        :class="dragging ? 'border-primary bg-primary-light' :
                            'border-gray-200 hover:border-primary hover:bg-gray-50'"
                        @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
                        @drop.prevent="dragging = false; const f = $event.dataTransfer.files[0]; if (f) { fileName = f.name; $refs.fileInput.files = $event.dataTransfer.files; }"
                        @click="$refs.fileInput.click()">
                        <i class="bx bx-cloud-upload text-5xl mb-3"
                            :class="dragging ? 'text-primary' : 'text-gray-300'"></i>
                        <p class="text-sm text-heading font-medium"
                            x-text="fileName || 'Klik atau drag & drop file di sini'"></p>
                        <p class="text-xs text-secondary mt-1" x-show="!fileName">xlsx, xls, csv — maks. 5MB</p>
                    </div>

                    <input type="file" name="file" accept=".xlsx,.xls,.csv" x-ref="fileInput" class="hidden"
                        @change="fileName = $event.target.files[0]?.name || ''" />

                    @error('file')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror

                    <div class="flex items-center justify-end gap-3 mt-5">
                        <a href="{{ route('admin.publikasi-data.index') }}"
                            class="px-4 py-2 text-sm text-text border border-gray-200 rounded-lg hover:bg-gray-50 transition">Batal</a>
                        <button type="submit"
                            class="px-5 py-2 text-sm font-semibold bg-primary text-white rounded-lg hover:bg-primary/90 transition flex items-center gap-2">
                            <i class="bx bx-upload"></i> Import Sekarang
                        </button>
                    </div>
                </form>
            </div>

            {{-- Panduan --}}
            <div class="bg-card rounded-xl shadow-card p-6 h-fit">
                <h6 class="text-heading font-semibold mb-3">Panduan Import</h6>
                <ol class="text-sm text-text space-y-3 list-decimal list-inside">
                    <li>Download template Excel di bawah.</li>
                    <li>Isi data sesuai kolom yang tersedia. Jangan mengubah nama kolom header.</li>
                    <li>Simpan file dalam format <strong>.xlsx</strong> atau <strong>.csv</strong>.</li>
                    <li>Upload file melalui form di samping.</li>
                </ol>
                <div class="mt-5 pt-4 border-t border-gray-100">
                    <p class="text-xs text-secondary font-medium mb-2 uppercase tracking-wide">Kolom yang diperlukan:</p>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach (['kode_kecamatan', 'kecamatan', 'komoditas', 'tahun', 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'] as $col)
                            <span
                                class="text-xs bg-primary-light text-primary px-2 py-0.5 rounded font-mono">{{ $col }}</span>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('admin.publikasi-data.template') }}"
                    class="mt-5 flex items-center justify-center gap-2 w-full px-4 py-2.5 text-sm font-semibold border border-primary text-primary rounded-lg hover:bg-primary hover:text-white transition">
                    <i class="bx bx-download text-lg"></i> Download Template
                </a>
            </div>
        </div>
    </div>
@endsection
