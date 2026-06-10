@extends('layouts.warga')

@section('content')

<h1 class="text-3xl font-bold mb-6">Profil Saya</h1>

<div class="bg-white p-8 rounded-lg shadow max-w-2xl">
    <form action="{{ route('warga.profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="mb-4">
            <label class="block font-semibold mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ $warga->name }}" class="w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ $warga->email }}" class="w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">No. HP</label>
            <input type="text" name="no_hp" value="{{ $warga->no_hp }}" class="w-full px-4 py-2 border rounded">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Alamat</label>
            <textarea name="alamat" class="w-full px-4 py-2 border rounded" rows="4">{{ $warga->alamat }}</textarea>
        </div>

        <div class="border-t pt-6">
            <h3 class="font-semibold mb-4">Ubah Password (Opsional)</h3>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Password Baru</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded" placeholder="Kosongkan jika tidak diubah">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded">
            </div>
        </div>

        <div class="flex gap-2 mt-6">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
            <a href="{{ route('warga.dashboard') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>

@endsection