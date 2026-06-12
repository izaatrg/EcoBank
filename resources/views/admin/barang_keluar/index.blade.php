@extends('layouts.admin')

@section('page_title', 'Barang Keluar')
@section('search_placeholder', 'Cari data...')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Barang Keluar</h1>
        <p class="text-slate-500 text-sm">Kelola pencatatan pengeluaran barang untuk penukaran atau distribusi.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-emerald-900 rounded-lg text-white"><i class="fa-solid fa-plus"></i></div>
                <h2 class="font-bold text-lg">Catat Barang Keluar</h2>
            </div>
            
            <form action="{{ route('admin.barang_keluar.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" placeholder="Contoh: Pupuk Kompos Organik" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-900 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tujuan / Nama Penerima</label>
                    <input type="text" name="tujuan" placeholder="Nama Warga atau Nama Instansi" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-900 outline-none" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jumlah</label>
                        <input type="number" name="jumlah" placeholder="0" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-900 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-900 outline-none" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="3" placeholder="Alasan pengeluaran barang..." class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-emerald-900 outline-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-emerald-900 text-white font-bold py-3 rounded-lg flex items-center justify-center gap-2 hover:bg-emerald-800 transition">
                    <i class="fa-solid fa-check"></i> Simpan Data
                </button>
            </form>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-emerald-900 p-6 rounded-2xl text-white">
                    <p class="text-emerald-200 text-sm">TOTAL KELUAR HARI INI</p>
                    <p class="text-4xl font-bold mt-2">{{ $data->sum('jumlah') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm">Item Terbanyak</p>
                        <p class="text-xl font-bold text-slate-800 mt-1">-</p>
                    </div>
                    <div class="p-3 bg-emerald-100 text-emerald-800 rounded-xl"><i class="fa-solid fa-box"></i></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold">Riwayat Barang Keluar</h3>
                    <div class="flex gap-2 text-slate-400">
                        <i class="fa-solid fa-sliders cursor-pointer"></i>
                        <i class="fa-solid fa-print cursor-pointer"></i>
                    </div>
                </div>
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-500 uppercase text-xs">
                        <tr>
                            <th class="px-5 py-3">Barang</th>
                            <th class="px-5 py-3">Penerima</th>
                            <th class="px-5 py-3">Jumlah</th>
                            <th class="px-5 py-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($data as $item)
                        <tr>
                            <td class="px-5 py-3">{{ $item->nama_barang }}</td>
                            <td class="px-5 py-3">{{ $item->tujuan }}</td>
                            <td class="px-5 py-3">{{ $item->jumlah }}</td>
                            <td class="px-5 py-3">{{ $item->tanggal_keluar }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-slate-400 italic">Belum ada data barang keluar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection