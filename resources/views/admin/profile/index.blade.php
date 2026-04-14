@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
    <div class="w-full">
        <div class="bg-card rounded-xl shadow-card overflow-hidden">
            <div class="bg-primary h-32 relative">
                <div class="absolute -bottom-12 left-8">
                    <div class="w-24 h-24 rounded-full bg-white p-1 shadow-lg">
                        <div
                            class="w-full h-full rounded-full bg-primary text-white flex items-center justify-center text-3xl font-bold border-4 border-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-16 pb-8 px-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-heading">{{ $user->name }}</h3>
                        <p class="text-secondary flex items-center gap-1">
                            <i class="bx bx-badge-check text-primary"></i>
                            {{ ucfirst($user->role) }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('admin.profile.password.edit') }}"
                            class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary/90 transition shadow-md shadow-primary/30">
                            <i class="bx bx-lock-alt"></i> Ubah Kata Sandi
                        </a>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-gray-100 pt-8">
                    <div class="space-y-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-secondary uppercase tracking-wider mb-1">Username</label>
                            <div class="text-heading font-medium flex items-center gap-2">
                                <i class="bx bx-user text-lg text-primary"></i>
                                {{ $user->username }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-secondary uppercase tracking-wider mb-1">Alamat
                                Email</label>
                            <div class="text-heading font-medium flex items-center gap-2">
                                <i class="bx bx-envelope text-lg text-primary"></i>
                                {{ $user->email }}
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-secondary uppercase tracking-wider mb-1">Tanggal
                                Bergabung</label>
                            <div class="text-heading font-medium flex items-center gap-2">
                                <i class="bx bx-calendar text-lg text-primary"></i>
                                {{ $user->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-secondary uppercase tracking-wider mb-1">Status
                                Akun</label>
                            <div class="text-heading font-medium flex items-center gap-2">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
