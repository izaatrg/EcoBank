@extends('layouts.admin')

@section('page_title', 'Tambah Kategori Sampah')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">
            <h4 class="font-bold mb-3">
                Terjadi Kesalahan:
            </h4>

            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm">

        <h2 class="text-xl font-bold text-slate-800 mb-2">
            Tambah Kategori Sampah
        </h2>

        <p class="text-slate-500 mb-8">
            Tambahkan kategori sampah baru beserta nilai koin yang akan diberikan kepada warga.
        </p>

        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-bold text-slate-600 mb-2">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    value="{{ old('nama_kategori') }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl"
                    placeholder="Contoh: Plastik"
                    required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-slate-600 mb-2">
                    Koin Per Kg
                </label>

                <input
                    type="number"
                    name="koin_per_kg"
                    value="{{ old('koin_per_kg') }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl"
                    placeholder="Contoh: 2500"
                    required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-slate-600 mb-2">
                    Stok
                </label>

                <input
                    type="number"
                    name="stok"
                    value="{{ old('stok') }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl"
                    placeholder="Contoh: 100">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-600 mb-2">
                    Kondisi
                </label>

                <input
                    type="text"
                    name="kondisi"
                    value="{{ old('kondisi') }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl"
                    placeholder="Contoh: Tinggi">
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.kategori.index') }}"
                   class="px-5 py-3 bg-slate-200 rounded-xl font-semibold">
                    Batal
                </a>

                <button type="submit"
                    class="px-6 py-3 bg-[#1E5631] text-white rounded-xl font-semibold hover:bg-[#2D6A4F]">
                    Simpan Kategori
                </button>
            </div>

        </form>

    </div>

</div>

@endsection