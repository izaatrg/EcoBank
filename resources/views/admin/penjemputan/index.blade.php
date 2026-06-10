@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Kelola Penjemputan</h1>
    <a href="{{ route('admin.penjemputan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Buat Penjemputan
    </a>
</div>

@if(session('success'))<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>@endif
@if(session('error'))<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>@endif

<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="w-full text-sm">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-4 py-3 text-left font-semibold">Warga</th>
                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                <th class="px-4 py-3 text-left font-semibold">Jam</th>
                <th class="px-4 py-3 text-left font-semibold">Catatan</th>
                <th class="px-4 py-3 text-left font-semibold">Petugas</th>
                <th class="px-4 py-3 text-left font-semibold">Status</th>
                <th class="px-4 py-3 text-left font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjemputan as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3">{{ $item->warga->name ?? '-' }}</td>
                <td class="px-4 py-3">{{ $item->tanggal_jemput }}</td>
                <td class="px-4 py-3">{{ $item->jam_jemput }}</td>
                <td class="px-4 py-3 text-xs">{{ $item->catatan ?? '-' }}</td>
                <td class="px-4 py-3">{{ $item->petugas->name ?? '-' }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded text-xs font-semibold
                        @if($item->status === 'menunggu') bg-yellow-100 text-yellow-800
                        @elseif($item->status === 'diproses') bg-blue-100 text-blue-800
                        @else bg-green-100 text-green-800 @endif">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-1">
                    <a href="{{ route('admin.penjemputan.edit', $item->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Edit</a>
                    <form action="{{ route('admin.penjemputan.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin?')" class="bg-red-500 text-white px-2 py-1 rounded text-xs">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-3 text-center text-gray-500">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $penjemputan->links() }}</div>
@endsection