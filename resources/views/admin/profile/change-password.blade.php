@extends('layouts.admin')

@section('title', 'Ubah Kata Sandi')
@section('page-title', 'Ubah Kata Sandi')
@section('back', route('admin.profile.index'))

@section('content')
    <div class="max-w-2xl">
        <div class="bg-card rounded-xl shadow-card p-6 md:p-8">
            <div class="mb-8">
                <h4 class="text-heading font-bold text-xl mb-1">Perbarui Kata Sandi</h4>
                <p class="text-secondary text-sm">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>
            </div>

            @if (session('status') === 'password-updated')
                <div class="mb-6 px-4 py-3 bg-green-50 text-green-700 border border-green-200 rounded-xl text-sm flex items-center gap-2">
                    <i class="bx bx-check-circle text-lg"></i> Kata sandi Anda telah berhasil diperbarui.
                </div>
            @endif

            <form action="{{ route('admin.profile.password.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-semibold text-heading mb-2">Kata Sandi Saat Ini</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                            <i class="bx bx-key"></i>
                        </div>
                        <input type="password" name="current_password" id="current_password" 
                               class="w-full pl-10 pr-4 py-3 bg-body border @error('current_password') border-danger @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm"
                               placeholder="Masukkan kata sandi lama" required>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-xs text-danger font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-heading mb-2">Kata Sandi Baru</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                            <i class="bx bx-lock-alt"></i>
                        </div>
                        <input type="password" name="password" id="password" 
                               class="w-full pl-10 pr-4 py-3 bg-body border @error('password') border-danger @else border-gray-200 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm"
                               placeholder="Masukkan kata sandi baru" required>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs text-danger font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-heading mb-2">Konfirmasi Kata Sandi Baru</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-secondary">
                            <i class="bx bx-lock-open-alt"></i>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="w-full pl-10 pr-4 py-3 bg-body border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm"
                               placeholder="Ulangi kata sandi baru" required>
                    </div>
                </div>

                <div class="pt-4 flex items-center gap-4">
                    <button type="submit" 
                            class="bg-primary text-white font-bold px-6 py-3 rounded-xl hover:bg-primary/90 transition shadow-lg shadow-primary/30 flex items-center gap-2">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.profile.index') }}" class="text-secondary font-semibold hover:text-heading transition text-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
