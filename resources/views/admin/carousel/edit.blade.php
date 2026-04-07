@extends('layouts.admin')

@section('title', 'Edit Slide')
@section('page-title', 'Edit Slide')
@section('back', route('admin.carousel.index'))

@section('content')
    <div class="max-w-lg bg-card rounded-xl shadow-card p-6">
        <form method="POST" action="{{ route('admin.carousel.update', $carousel) }}" enctype="multipart/form-data"
            class="space-y-5">
            @csrf @method('PUT')
            @include('admin.carousel._form')
            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="bg-primary text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-primary/90 transition">
                    Perbarui
                </button>
                <a href="{{ route('admin.carousel.index') }}"
                    class="px-5 py-2 rounded-lg text-sm font-semibold text-secondary hover:bg-gray-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
