@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Edit Penjemputan</h1>

<div class="bg-white p-8 rounded-lg shadow max-w-2xl">
    <form action="{{ route('admin.penjemputan.update', $penjemputan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Warga <span class="text-red-500">*</span></label>
            <select name="warga_id" class="w-full px-4 py-2 border rounded" required>
                @foreach($warga as $w)
                <option value="{{ $w->id }}" @if($w->id === $penjemputan->warga_id) selected @endif>{{ $w->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Petugas</label>
            <select name="petugas_id" class="w-full px-4 py-2 border rounded">
                <option value="">-- Belum Ditugaskan --</option>
                @foreach($petugas as $p)
                <option value="{{ $p->id }}" @if($p->id === $penjemputan->petugas_id) selected @endif>{{ $p->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-semibold mb-2">Tanggal Jemput <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_jemput" value="{{ $penjemputan->tanggal_jemput }}" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div>
                <label class="block font-semibold mb-2">Jam Jemput <span class="text-red-500">*</span></label>
                <input type="time" name="jam_jemput" value="{{ $penjemputan->jam_jemput }}" class="w-full px-4 py-2 border rounded" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border rounded">
                <option value="menunggu" @if($penjemputan->status === 'menunggu') selected @endif>Menunggu</option>
                <option value="diproses" @if($penjemputan->status === 'diproses') selected @endif>Diproses</option>
                <option value="selesai" @if($penjemputan->status === 'selesai') selected @endif>Selesai</option>
                <option value="dibatalkan" @if($penjemputan->status === 'dibatalkan') selected @endif>Dibatalkan</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Catatan</label>
            <textarea name="catatan" class="w-full px-4 py-2 border rounded" rows="4">{{ $penjemputan->catatan }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Update</button>
            <a href="{{ route('admin.penjemputan.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>

@endsection