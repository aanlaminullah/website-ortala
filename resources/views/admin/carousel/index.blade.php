@extends('layouts.admin')

@section('title', 'Carousel')
@section('page-title', 'Carousel')

@section('header-actions')
    <a href="{{ route('admin.carousel.create') }}"
        class="inline-flex items-center gap-2 bg-primary text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-primary/90 transition">
        <i class="bx bx-plus"></i> Tambah Slide
    </a>
@endsection

@section('content')
    @if ($carousel->count() > 0)
        <p class="text-sm text-secondary mb-4 flex items-center gap-2">
            <i class="bx bx-info-circle"></i>
            Drag & drop untuk mengubah urutan tampil. Urutan tersimpan otomatis.
        </p>
    @endif

    <div id="sortableCarousel" class="flex flex-col gap-3">
        @forelse($carousel as $item)
            <div class="bg-card rounded-xl shadow-card overflow-hidden flex items-center gap-4 px-4 py-3 cursor-grab active:cursor-grabbing select-none"
                data-id="{{ $item->id }}">
                {{-- Handle --}}
                <div class="text-secondary hover:text-primary transition shrink-0">
                    <i class="bx bx-grid-vertical text-xl"></i>
                </div>

                {{-- Gambar preview --}}
                <div class="w-24 h-14 rounded-lg overflow-hidden shrink-0 bg-gray-100">
                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                        class="w-full h-full object-cover" />
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-heading text-sm truncate">{{ $item->judul }}</p>
                    @if ($item->deskripsi)
                        <p class="text-xs text-secondary truncate mt-0.5">{{ $item->deskripsi }}</p>
                    @endif
                    <span
                        class="text-xs px-2 py-0.5 rounded-full mt-1 inline-block
                        {{ $item->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>

                {{-- Aksi --}}
                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('admin.carousel.edit', $item) }}"
                        class="text-primary hover:bg-primary/10 p-1.5 rounded-lg transition">
                        <i class="bx bx-edit text-lg"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.carousel.destroy', $item) }}"
                        onsubmit="return confirm('Hapus slide ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-danger hover:bg-danger/10 p-1.5 rounded-lg transition">
                            <i class="bx bx-trash text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="py-16 text-center text-secondary">
                <i class="bx bx-image text-5xl block mb-3 opacity-30"></i>
                <p class="text-sm italic">Belum ada slide carousel.</p>
            </div>
        @endforelse
    </div>

    <div id="toastSaved"
        class="fixed bottom-6 right-6 bg-green-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl shadow-lg opacity-0 transition-opacity duration-300 pointer-events-none flex items-center gap-2">
        <i class="bx bx-check-circle text-lg"></i> Urutan berhasil disimpan
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>
    <script>
        const grid = document.getElementById('sortableCarousel');
        const toast = document.getElementById('toastSaved');

        if (grid) {
            Sortable.create(grid, {
                animation: 150,
                ghostClass: 'opacity-40',
                onEnd: function() {
                    const ids = [...grid.querySelectorAll('[data-id]')].map(el => el.dataset.id);
                    fetch('{{ route('admin.carousel.reorder') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
