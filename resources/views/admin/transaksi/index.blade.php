@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Kelola Transaksi Setoran</h1>
    <a href="{{ route('admin.transaksi.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Tambah Transaksi
    </a>
</div>

@if(session('success'))<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>@endif

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">Warga</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Petugas</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Kategori</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Berat (kg)</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Koin</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Tanggal</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $t)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4">{{ $t->warga->name ?? '-' }}</td>
                <td class="px-6 py-4">{{ $t->petugas->name ?? '-' }}</td>
                <td class="px-6 py-4">{{ $t->kategori->nama_kategori ?? '-' }}</td>
                <td class="px-6 py-4">{{ $t->berat }}</td>
                <td class="px-6 py-4 font-semibold text-green-600">+{{ $t->total_koin }}</td>
                <td class="px-6 py-4">{{ date('d/m/Y', strtotime($t->tanggal_setor)) }}</td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{ route('admin.transaksi.edit', $t->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Edit</a>
                    <form action="{{ route('admin.transaksi.destroy', $t->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $transaksi->links() }}</div>
@endsection