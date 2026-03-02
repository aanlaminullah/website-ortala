@extends('layouts.admin')

@section('title', 'Kelola Publikasi Data')
@section('page-title', 'Kelola Publikasi Data')

@section('content')
    {{-- Toolbar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <form method="GET" action="{{ route('admin.publikasi-data.index') }}" class="flex items-center gap-2">
            <label class="text-sm text-secondary font-medium">Tahun:</label>
            <select name="tahun" onchange="this.form.submit()"
                class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm text-heading focus:ring-2 focus:ring-primary focus:outline-none">
                @foreach ($tahunList as $t)
                    <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </form>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.publikasi-data.import.form') }}"
                class="inline-flex items-center gap-2 bg-white border border-primary text-primary text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition">
                <i class="bx bx-upload text-lg"></i> Import Excel
            </a>
            <a href="{{ route('admin.publikasi-data.create') }}"
                class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
                <i class="bx bx-plus text-lg"></i> Tambah Data
            </a>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-card rounded-xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-primary-light text-primary text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Kecamatan</th>
                        <th class="px-4 py-3 text-left">Komoditas</th>
                        <th class="px-4 py-3 text-left">Tahun</th>
                        <th class="px-4 py-3 text-right">Total (Ton)</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($data as $row)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-secondary">
                                {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 font-medium text-heading">{{ $row->kecamatan->nama }}</td>
                            <td class="px-4 py-3 text-text">{{ $row->komoditas }}</td>
                            <td class="px-4 py-3 text-text">{{ $row->tahun }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-heading">
                                {{ number_format($row->jumlah, 3, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.publikasi-data.edit', $row->id) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-primary-light text-primary rounded-lg hover:bg-primary hover:text-white transition">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.publikasi-data.destroy', $row->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                            <td colspan="6" class="px-4 py-8 text-center text-secondary">
                                <i class="bx bx-data text-4xl mb-2 block"></i>
                                Belum ada data untuk tahun {{ $tahun }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($data->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">{{ $data->links() }}</div>
        @endif
    </div>
@endsection
