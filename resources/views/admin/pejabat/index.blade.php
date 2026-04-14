@extends('layouts.admin')

@section('title', 'Kelola Pejabat')
@section('page-title', 'Struktur Organisasi')

@section('header-actions')
    <a href="{{ route('admin.pejabat.create') }}"
        class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
        <i class="bx bx-plus"></i> Tambah Pejabat
    </a>
@endsection

@section('content')
    <div class="bg-card rounded-xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-primary-light text-primary text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center">Urutan</th>
                        <th class="px-4 py-3 text-left">Foto</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Jabatan</th>
                        <th class="px-4 py-3 text-left">NIP</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pejabat as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center text-secondary">{{ $item->urutan }}</td>
                            <td class="px-4 py-3">
                                @if ($item->foto)
                                    <img src="{{ Storage::url($item->foto) }}"
                                        class="w-10 h-10 rounded-full object-cover" />
                                @else
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                                        <i class="bx bx-user"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-semibold text-heading">{{ $item->nama }}</td>
                            <td class="px-4 py-3 text-secondary">{{ $item->jabatan }}</td>
                            <td class="px-4 py-3 text-secondary">{{ $item->nip ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded-lg text-xs font-semibold {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.pejabat.edit', $item) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-primary-light text-primary rounded-lg hover:bg-primary hover:text-white transition">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.pejabat.destroy', $item) }}"
                                        onsubmit="return confirm('Hapus pejabat ini?')">
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
                            <td colspan="7" class="px-4 py-10 text-center text-secondary italic">Belum ada data pejabat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
