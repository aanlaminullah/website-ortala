@extends('layouts.admin')

@section('title', 'Lensa Kegiatan')
@section('page-title', 'Lensa Kegiatan')

@section('header-actions')
    <a href="{{ route('admin.lensa-kegiatan.create') }}"
        class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
        <i class="bx bx-plus"></i> Tambah Foto
    </a>
@endsection

@section('content')
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($lensa as $item)
            <div class="bg-card rounded-xl shadow-card overflow-hidden group">
                <div class="relative aspect-square overflow-hidden">
                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-end p-3">
                        <span class="text-white text-xs font-medium">{{ $item->judul ?? '-' }}</span>
                    </div>
                    @if (!$item->aktif)
                        <div class="absolute top-2 left-2">
                            <span class="bg-gray-800/80 text-white text-xs px-2 py-1 rounded-full">Nonaktif</span>
                        </div>
                    @endif
                </div>
                <div class="p-3">
                    <p class="text-xs text-secondary mb-2">
                        {{ $item->tanggal->translatedFormat('d F Y') }}
                    </p>
                    <div class="flex items-center justify-between">
                        @if ($item->judul)
                            <span class="text-xs font-medium text-heading truncate">{{ $item->judul }}</span>
                        @else
                            <span class="text-xs text-secondary italic">Tanpa judul</span>
                        @endif
                        <div class="flex items-center gap-1 shrink-0 ml-2">
                            <a href="{{ route('admin.lensa-kegiatan.edit', $item) }}"
                                class="text-primary hover:bg-primary/10 p-1.5 rounded-lg transition">
                                <i class="bx bx-edit text-lg"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.lensa-kegiatan.destroy', $item) }}"
                                onsubmit="return confirm('Hapus foto ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-danger hover:bg-danger/10 p-1.5 rounded-lg transition">
                                    <i class="bx bx-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-4 py-16 text-center text-secondary">
                <i class="bx bx-image text-5xl block mb-3 opacity-30"></i>
                <p class="text-sm italic">Belum ada foto kegiatan.</p>
            </div>
        @endforelse
    </div>

    @if ($lensa->hasPages())
        <div class="mt-6">
            {{ $lensa->links() }}
        </div>
    @endif
@endsection
