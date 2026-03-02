@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('header-actions')
    <a href="{{ route('admin.announcements.create') }}"
        class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
        <i class="bx bx-plus text-lg"></i> Tambah Pengumuman
    </a>
@endsection

@section('content')
    <div class="bg-card rounded-xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-primary-light text-primary text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Judul</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($announcements as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-secondary">
                                {{ ($announcements->currentPage() - 1) * $announcements->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 font-medium text-heading">{{ $item->title }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 text-xs font-semibold bg-primary-light text-primary rounded-lg">{{ $item->category }}</span>
                            </td>
                            <td class="px-4 py-3 text-secondary">{{ $item->date->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.announcements.edit', $item->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-primary-light text-primary rounded-lg hover:bg-primary hover:text-white transition">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.announcements.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                        @csrf
                                        @method('DELETE')
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
                            <td colspan="5" class="px-4 py-8 text-center text-secondary">
                                <i class="bx bx-megaphone text-4xl mb-2 block"></i>
                                Belum ada pengumuman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($announcements->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $announcements->links() }}</div>
        @endif
    </div>
@endsection
