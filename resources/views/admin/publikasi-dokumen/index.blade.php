@extends('layouts.admin')

@section('title', 'Publikasi Dokumen')
@section('page-title', 'Publikasi Dokumen')

@section('header-actions')
    <a href="{{ route('admin.publikasi-dokumen.create') }}"
        class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
        <i class="bx bx-plus"></i> Tambah Dokumen
    </a>
@endsection

@section('content')
    <div class="bg-card rounded-xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-primary-light text-primary text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">Dokumen</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Tahun</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Ukuran</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($dokumen as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <i class="bx {{ $item->ikonFile() }} text-2xl {{ $item->warnaIkon() }}"></i>
                                    <div>
                                        <p class="font-semibold text-heading text-sm">{{ $item->judul }}</p>
                                        @if ($item->deskripsi)
                                            <p class="text-xs text-secondary line-clamp-1">{{ $item->deskripsi }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-secondary text-xs">{{ $item->kategori ?? '-' }}</td>
                            <td class="px-4 py-3 text-secondary">{{ $item->tahun }}</td>
                            <td class="px-4 py-3 text-secondary text-xs">{{ $item->tanggal->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-4 py-3 text-secondary text-xs">{{ $item->ukuranFormat() }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded-lg text-xs font-semibold {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.publikasi-dokumen.edit', $item) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-primary-light text-primary rounded-lg hover:bg-primary hover:text-white transition">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.publikasi-dokumen.destroy', $item) }}"
                                        onsubmit="return confirm('Hapus dokumen ini?')">
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
                            <td colspan="7" class="px-4 py-10 text-center text-secondary italic">Belum ada dokumen.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($dokumen->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $dokumen->links() }}
            </div>
        @endif
    </div>
@endsection
