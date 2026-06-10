@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Kelola Data Warga</h1>
    <a href="{{ route('admin.warga.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Tambah Warga
    </a>
</div>

@if(session('success'))<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>@endif

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">No. HP</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Saldo</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($warga as $p)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4">{{ $p->name }}</td>
                <td class="px-6 py-4">{{ $p->email }}</td>
                <td class="px-6 py-4">{{ $p->no_hp ?? '-' }}</td>
                <td class="px-6 py-4 font-semibold">{{ $p->saldoKoin->total_koin ?? 0 }} koin</td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{ route('admin.warga.edit', $p->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Edit</a>
                    <form action="{{ route('admin.warga.destroy', $p->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $warga->links() }}</div>
@endsection