<div>
    <label class="block text-sm font-medium text-heading mb-1">Judul <span class="text-danger">*</span></label>
    <input type="text" name="judul" value="{{ old('judul', $carousel->judul ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
        placeholder="Judul slide" required />
    @error('judul')
        <p class="text-danger text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-heading mb-1">Deskripsi</label>
    <input type="text" name="deskripsi" value="{{ old('deskripsi', $carousel->deskripsi ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
        placeholder="Deskripsi singkat (opsional)" />
</div>

<div>
    <label class="block text-sm font-medium text-heading mb-1">
        Gambar <span class="text-danger">*</span>
    </label>
    @if (isset($carousel) && $carousel->gambar)
        <div class="mb-2 rounded-lg overflow-hidden h-32 bg-gray-100">
            <img src="{{ Storage::url($carousel->gambar) }}" class="w-full h-full object-cover" />
        </div>
        <p class="text-xs text-secondary mb-2">Upload baru untuk mengganti.</p>
    @endif
    <input type="file" name="gambar" accept="image/*" {{ isset($carousel) ? '' : 'required' }}
        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
    <p class="text-xs text-secondary mt-1">Maks. 5MB. Resolusi landscape disarankan (min. 1280x500px).</p>
    @error('gambar')
        <p class="text-danger text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-2">
    <input type="checkbox" name="aktif" id="aktif" value="1"
        {{ old('aktif', $carousel->aktif ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-primary" />
    <label for="aktif" class="text-sm font-medium text-heading">Tampilkan di halaman utama</label>
</div>
