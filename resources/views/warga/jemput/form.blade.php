@extends('layouts.warga')

@section('content')

<h1 class="text-3xl font-bold mb-6">Pesan Penjemputan</h1>

<div class="bg-white p-8 rounded-lg shadow max-w-2xl">
    <form action="{{ route('warga.jemput.store') }}" method="POST">
        @csrf

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Ada kesalahan:</strong>
            <ul class="mt-2 list-disc pl-5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-semibold mb-2">Tanggal Penjemputan <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_jemput" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold mb-2">Jam Penjemputan <span class="text-red-500">*</span></label>
                <input type="time" name="jam_jemput" class="w-full px-4 py-2 border rounded" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Catatan (Alamat/Lokasi)</label>
            <textarea name="catatan" class="w-full px-4 py-2 border rounded" rows="4" placeholder="Tulis lokasi detail rumah Anda atau titik penjemputan"></textarea>
        </div>

        <div class="bg-green-50 border border-green-200 p-4 rounded mb-6">
            <p class="text-sm text-green-800">
                <strong>✓ Catatan:</strong> Petugas akan menghubungi Anda sebelum datang ke lokasi yang ditentukan.
            </p>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">Pesan Penjemputan</button>
            <a href="{{ route('warga.dashboard') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>

@endsection