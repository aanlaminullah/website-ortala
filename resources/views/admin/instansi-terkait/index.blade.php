@extends('layouts.admin')

@section('title', 'Instansi Terkait')
@section('page-title', 'Instansi Terkait')

@section('header-actions')
    <a href="{{ route('admin.instansi-terkait.create') }}"
        class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
        <i class="bx bx-plus"></i> Tambah Instansi
    </a>
@endsection

@section('content')
    @if ($instansi->count() > 0)
        <p class="text-xs text-secondary mb-4 flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-lg">
            <i class="bx bx-info-circle text-lg"></i>
            Tarik (drag) baris tabel untuk mengubah urutan tampil. Perubahan disimpan otomatis.
        </p>
    @endif

    <div class="bg-card rounded-xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-primary-light text-primary text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-center w-10"></th>
                        <th class="px-4 py-3 text-left w-20">Logo</th>
                        <th class="px-4 py-3 text-left">Nama Instansi</th>
                        <th class="px-4 py-3 text-left">URL</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sortableRows" class="divide-y divide-gray-100">
                    @forelse($instansi as $item)
                        <tr class="hover:bg-gray-50 transition cursor-grab active:cursor-grabbing"
                            data-id="{{ $item->id }}">
                            <td class="px-4 py-3 text-center text-gray-300">
                                <i class="bx bx-grid-vertical text-xl"></i>
                            </td>
                            <td class="px-4 py-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-100 bg-gray-50">
                                    <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->nama }}"
                                        class="w-full h-full object-cover" />
                                </div>
                            </td>
                            <td class="px-4 py-3 font-semibold text-heading">{{ $item->nama }}</td>
                            <td class="px-4 py-3 text-secondary">
                                @if ($item->url)
                                    <a href="{{ $item->url }}" target="_blank"
                                        class="text-primary hover:underline text-xs">
                                        {{ $item->url }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="text-xs px-2 py-1 rounded-lg font-semibold {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.instansi-terkait.edit', $item) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-primary-light text-primary rounded-lg hover:bg-primary hover:text-white transition">
                                        <i class="bx bx-edit-alt"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.instansi-terkait.destroy', $item) }}"
                                        onsubmit="return confirm('Hapus instansi ini?')">
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
                            <td colspan="6" class="px-4 py-10 text-center text-secondary italic">
                                Belum ada instansi terkait.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Toast notif --}}
    <div id="toastSaved"
        class="fixed bottom-6 right-6 bg-green-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl shadow-lg opacity-0 transition-opacity duration-300 pointer-events-none flex items-center gap-2">
        <i class="bx bx-check-circle text-lg"></i> Urutan berhasil disimpan
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
    <script>
        const grid = document.getElementById('sortableRows');
        const toast = document.getElementById('toastSaved');

        if (grid) {
            Sortable.create(grid, {
                animation: 150,
                ghostClass: 'bg-primary/5',
                handle: '.bx-grid-vertical',
                onEnd: function() {
                    const ids = [...grid.querySelectorAll('[data-id]')].map(el => el.dataset.id);

                    fetch('{{ route('admin.instansi-terkait.reorder') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                ids
                            }),
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                toast.classList.remove('opacity-0');
                                toast.classList.add('opacity-100');
                                setTimeout(() => {
                                    toast.classList.remove('opacity-100');
                                    toast.classList.add('opacity-0');
                                }, 2500);
                            }
                        });
                }
            });
        }
    </script>
@endpush
