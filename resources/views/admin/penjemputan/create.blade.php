@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Buat Penjemputan Baru</h1>

<div class="bg-white p-8 rounded-lg shadow max-w-2xl">
    <form action="{{ route('admin.penjemputan.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Warga <span class="text-red-500">*</span></label>
            <select name="warga_id" class="w-full px-4 py-2 border rounded" required>
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $w)
                <option value="{{ $w->id }}">{{ $w->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Petugas</label>
            <select name="petugas_id" class="w-full px-4 py-2 border rounded">
                <option value="">-- Belum Ditugaskan --</option>
                @foreach($petugas as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-2">Tanggal Jemput <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_jemput" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold mb-2">Jam Jemput <span class="text-red-500">*</span></label>
                <input type="time" name="jam_jemput" class="w-full px-4 py-2 border rounded" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Catatan</label>
            <textarea name="catatan" class="w-full px-4 py-2 border rounded" rows="4"></textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Buat</button>
            <a href="{{ route('admin.penjemputan.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>

@endsection