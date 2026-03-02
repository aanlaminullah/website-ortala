@extends('layouts.admin')

@section('title', 'Edit Pengumuman')
@section('page-title', 'Edit Pengumuman')
@section('back', route('admin.announcements.index'))

@section('content')
    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-card rounded-xl shadow-card p-6 mb-4">
            <h6 class="text-heading font-semibold mb-4">Detail Pengumuman</h6>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-heading mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $announcement->title) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('title') border-red-400 @enderror" />
                    @error('title')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $announcement->category) }}"
                        list="kategori-list"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('category') border-red-400 @enderror" />
                    <datalist id="kategori-list">
                        <option value="Layanan">
                        <option value="Keamanan">
                        <option value="Informasi">
                        <option value="Bantuan">
                        <option value="Pelatihan">
                    </datalist>
                    @error('category')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-heading mb-1">Tanggal</label>
                    <input type="date" name="date" value="{{ old('date', $announcement->date->format('Y-m-d')) }}"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('date') border-red-400 @enderror" />
                    @error('date')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-heading mb-1">Deskripsi</label>
                    <textarea name="description" rows="5"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none @error('description') border-red-400 @enderror">{{ old('description', $announcement->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-heading mb-1">Lampiran</label>

                    @if ($announcement->attachment)
                        <div class="flex items-center gap-3 mb-2 px-3 py-2 bg-primary-light rounded-lg">
                            <i class="bx bx-file text-primary text-lg"></i>
                            <span
                                class="text-xs text-primary font-medium truncate flex-1">{{ basename($announcement->attachment) }}</span>
                            <a href="{{ Storage::url($announcement->attachment) }}" target="_blank"
                                class="text-xs text-primary underline hover:text-primary/70 shrink-0">Lihat</a>
                            <button type="button"
                                onclick="if(confirm('Yakin ingin menghapus lampiran ini?')) document.getElementById('remove-attachment-form').submit()"
                                class="text-xs text-danger hover:text-white hover:bg-danger px-2 py-1 rounded-md transition shrink-0">
                                <i class="bx bx-trash"></i> Hapus
                            </button>
                        </div>
                    @endif

                    <div x-data="{ fileName: '' }"
                        class="flex items-center gap-3 border border-gray-200 rounded-lg px-3 py-2 @error('attachment') border-red-400 @enderror">
                        <label
                            class="cursor-pointer inline-flex items-center gap-2 bg-primary-light text-primary text-xs font-semibold px-3 py-1.5 rounded-md hover:bg-primary hover:text-white transition shrink-0">
                            <i class="bx bx-upload text-base"></i>
                            {{ $announcement->attachment ? 'Ganti File' : 'Pilih File' }}
                            <input type="file" name="attachment" class="hidden" accept=".pdf,.doc,.docx"
                                @change="fileName = $event.target.files[0]?.name || ''" />
                        </label>
                        <span class="text-xs text-secondary truncate" x-text="fileName || 'Belum ada file dipilih'"></span>
                    </div>
                    <p class="text-xs text-secondary mt-1">Format: PDF, DOC, DOCX. Maksimal 5MB. Kosongkan jika tidak ingin
                        mengubah lampiran.</p>
                    @error('attachment')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        ...
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.announcements.index') }}"
                class="px-4 py-2 text-sm text-text border border-gray-200 rounded-lg hover:bg-gray-50 transition">Batal</a>
            <button type="submit"
                class="px-5 py-2 text-sm font-semibold bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                <i class="bx bx-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- Form hapus lampiran (Dipindahkan ke luar form utama agar tidak terjadi nested form) --}}
    @if ($announcement->attachment)
        <form id="remove-attachment-form" action="{{ route('admin.announcements.remove-attachment', $announcement->id) }}"
            method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endsection
