@extends('layouts.admin')

@section('page_title', 'Edit Kategori Sampah')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm">

        <h2 class="text-xl font-bold text-slate-800 mb-6">
            Edit Kategori Sampah
        </h2>

        <form action="{{ route('admin.kategori.update',$kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-bold text-slate-600 mb-2">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    value="{{ $kategori->nama }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl"
                    required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-slate-600 mb-2">
                    Koin Per Kg
                </label>

                <input
                    type="number"
                    name="koin_per_kg"
                    value="{{ $kategori->harga }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl"
                    required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-slate-600 mb-2">
                    Stok
                </label>

                <input
                    type="number"
                    name="stok"
                    value="{{ $kategori->stok }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-600 mb-2">
                    Kondisi
                </label>

                <input
                    type="text"
                    name="kondisi"
                    value="{{ $kategori->kondisi }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.kategori.index') }}"
                   class="px-5 py-3 bg-slate-200 rounded-xl">
                    Batal
                </a>

                <button type="submit"
                    class="px-6 py-3 bg-[#1E5631] text-white rounded-xl">
                    Update Kategori
                </button>
            </div>

        </form>

    </div>

</div>
@endsection