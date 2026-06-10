@extends('layouts.warga')

@section('content')

<h1 class="text-3xl font-bold mb-6">Setor Sampah</h1>

<div class="bg-white p-8 rounded-lg shadow max-w-2xl">
    <form action="{{ route('warga.setor.store') }}" method="POST">
        @csrf

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Periksa kembali:</strong>
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

        <div class="mb-6">
            <label class="block font-semibold mb-2">Pilih Jenis Sampah <span class="text-red-500">*</span></label>
            <select name="kategori_id" class="w-full px-4 py-2 border rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kategori }} ({{ $k->koin_per_kg }} koin/kg)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Berat (kg) <span class="text-red-500">*</span></label>
            <input type="number" name="berat" step="0.01" min="0.01" class="w-full px-4 py-2 border rounded" placeholder="Contoh: 5.5" required>
            <p class="text-sm text-gray-500 mt-1">Timbang sampah Anda terlebih dahulu</p>
        </div>

        <div class="bg-blue-50 border border-blue-200 p-4 rounded mb-6">
            <p class="text-sm text-blue-800">
                <strong>ℹ️ Informasi:</strong> Koin yang akan Anda terima akan otomatis ditambahkan ke akun Anda setelah verifikasi oleh petugas.
            </p>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">Setor Sekarang</button>
            <a href="{{ route('warga.dashboard') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
    </form>
</div>

@endsection