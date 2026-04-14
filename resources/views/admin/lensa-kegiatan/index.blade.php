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
    <div class="bg-card rounded-xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-primary-light text-primary text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left w-24">Foto</th>
                        <th class="px-4 py-3 text-left">Judul Kegiatan</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($lensa as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <div class="w-16 h-12 rounded-lg overflow-hidden bg-gray-100 border border-gray-100">
                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover" />
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-heading uppercase text-xs">{{ $item->judul ?? '-' }}</p>
                            </td>
                            <td class="px-4 py-3 text-secondary text-xs">
                                {{ $item->tanggal->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="text-xs px-2 py-1 rounded-lg font-semibold {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.lensa-kegiatan.edit', $item) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-primary-light text-primary rounded-lg hover:bg-primary hover:text-white transition">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.lensa-kegiatan.destroy', $item) }}"
                                        onsubmit="return confirm('Hapus foto ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-red-50 text-danger rounded-lg hover:bg-danger hover:text-white transition">
                                            <i class="bx bx-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-secondary italic">
                                Belum ada foto kegiatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($lensa->hasPages())
        <div class="mt-6">
            {{ $lensa->links() }}
        </div>
    @endif
@endsection
