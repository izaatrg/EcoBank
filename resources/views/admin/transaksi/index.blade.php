@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    @if(session('success'))
    <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded shadow-sm transition-all duration-300" role="alert">
        <p class="font-bold">Berhasil!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    <div class="relative z-50 flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kelola Transaksi Setoran</h1>
            <p class="text-sm font-medium text-emerald-800/60 mt-1">Daftar transaksi setoran nasabah.</p>
        </div>
        
        <a href="{{ route('admin.transaksi.create') }}" 
            style="position: relative; z-index: 9999; pointer-events: auto;"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg shadow-lg font-bold transition-all cursor-pointer">
            + Tambah Transaksi
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-left">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3">Warga</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Berat (kg)</th>
                    <th class="px-6 py-3">Koin</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $t)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $t->warga->name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $t->kategori->nama ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $t->berat }}</td>
                    <td class="px-6 py-4 font-bold text-green-600">+{{ $t->total_koin }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="{{ route('admin.transaksi.edit', $t->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.transaksi.destroy', $t->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    setTimeout(function() {
        let alert = document.querySelector('[role="alert"]');
        if(alert) alert.style.display = 'none';
    }, 3000);
</script>
@endsection