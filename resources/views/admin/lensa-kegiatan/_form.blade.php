<div>
    <label class="block text-sm font-medium text-heading mb-1">Judul / Keterangan</label>
    <input type="text" name="judul" value="{{ old('judul', $lensaKegiatan->judul ?? '') }}"
        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
        placeholder="Contoh: Panen Raya 2025" />
</div>

<div>
    <label class="block text-sm font-medium text-heading mb-1">
        Tanggal <span class="text-danger">*</span>
    </label>
    <input type="date" name="tanggal"
        value="{{ old('tanggal', isset($lensaKegiatan) ? $lensaKegiatan->tanggal->format('Y-m-d') : now()->format('Y-m-d')) }}"
        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
        required />
    @error('tanggal')
        <p class="text-danger text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-heading mb-1">
        Foto <span class="text-danger">*</span>
    </label>
    @if (isset($lensaKegiatan) && $lensaKegiatan->foto)
        <div class="mb-2">
            <img src="{{ Storage::url($lensaKegiatan->foto) }}" class="w-32 h-32 rounded-lg object-cover border" />
            <p class="text-xs text-secondary mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
        </div>
    @endif
    <input type="file" name="foto" accept="image/*" {{ isset($lensaKegiatan) ? '' : 'required' }}
        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm" />
    <p class="text-xs text-secondary mt-1">Maks. 3MB. Format: JPG, PNG, WEBP.</p>
    @error('foto')
        <p class="text-danger text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-2">
    <input type="checkbox" name="aktif" id="aktif" value="1"
        {{ old('aktif', $lensaKegiatan->aktif ?? true) ? 'checked' : '' }}
        class="rounded border-gray-300 text-primary" />
    <label for="aktif" class="text-sm font-medium text-heading">Tampilkan di halaman utama</label>
</div>
