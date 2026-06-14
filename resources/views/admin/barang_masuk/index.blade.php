@extends('layouts.admin')

@section('page_title', 'Barang Masuk')
@section('search_placeholder', 'Cari data stok...')

@section('content')
<div class="max-w-[1340px] mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6 animate-fade-in">

    @if(session('success'))
        <div class="toast-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-xs font-semibold">
            <ul class="list-disc pl-4">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-5">
        <div class="space-y-1">
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Manajemen Stok Masuk</h1>
            <p class="text-xs font-medium text-slate-400">Catat dan pantau aliran barang hasil pengolahan limbah secara sistematis.</p>
        </div>
        <div class="bg-[#F4F9F5] border border-emerald-100/60 rounded-xl px-4 py-3 flex items-center gap-3 shadow-xs">
            <div class="w-9 h-9 bg-emerald-600 text-white rounded-lg flex items-center justify-center text-sm shadow-sm">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div>
                <span class="text-[9px] uppercase tracking-wider font-bold text-slate-400 block">Total Stok Hari Ini</span>
                <span class="text-base font-extrabold text-slate-800 tracking-tight">{{ number_format($totalHariIni, 0, ',', '.') }} <span class="text-xs font-bold text-slate-400">Unit</span></span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <div class="lg:col-span-4 bg-white border border-slate-100 rounded-2xl p-6 shadow-xs space-y-5">
            <div class="flex items-center gap-2.5 pb-2 border-b border-slate-50">
                <div class="w-7 h-7 bg-emerald-50 text-emerald-700 rounded-lg flex items-center justify-center text-xs"><i class="fa-solid fa-circle-plus"></i></div>
                <h2 class="text-sm font-bold text-slate-800">Input Barang Baru</h2>
            </div>
            <form action="{{ route('admin.barang_masuk.store') }}" method="POST" class="space-y-4 admin-form" data-loading="true">
                @csrf
                <div class="space-y-1.5"><label class="text-xs font-bold text-slate-500 block">Kode Transaksi</label><input type="text" name="kode_transaksi" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-xs font-semibold outline-none focus:border-emerald-500" required></div>
                <div class="space-y-1.5"><label class="text-xs font-bold text-slate-500 block">Nama Barang</label><input type="text" name="nama_barang" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-xs font-semibold outline-none focus:border-emerald-500" required></div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5"><label class="text-xs font-bold text-slate-500 block">Kategori</label><select name="kategori" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-xs font-bold">
                            <option value="Plastik">Plastik</option>
                            <option value="Kertas">Kertas</option>
                        </select></div>
                    <div class="space-y-1.5"><label class="text-xs font-bold text-slate-500 block">Satuan</label><select name="satuan" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-xs font-bold">
                            <option value="Kg">Kg</option>
                            <option value="Pcs">Pcs</option>
                        </select></div>
                </div>
                <div class="space-y-1.5"><label class="text-xs font-bold text-slate-500 block">Jumlah / Stok</label><input type="number" name="jumlah" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-xs font-bold" required></div>
                <div class="space-y-1.5"><label class="text-xs font-bold text-slate-500 block">Tanggal Masuk</label><input type="date" name="tanggal_masuk" class="w-full bg-slate-50/50 border border-slate-200 rounded-xl px-4 py-3 text-xs font-bold" required></div>
                <button type="submit" class="w-full bg-[#1E5631] text-white py-3.5 rounded-xl font-bold text-xs flex items-center justify-center gap-2"><i class="fa-regular fa-floppy-disk"></i> Simpan Data Stok</button>
            </form>
        </div>

        <div class="lg:col-span-8 bg-white border border-slate-100 rounded-2xl p-6 shadow-xs space-y-4">
            <div class="flex justify-between items-center pb-2 border-b border-slate-50">
                <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2.5">
                    <div class="w-7 h-7 bg-emerald-50 text-emerald-700 rounded-lg flex items-center justify-center text-xs"><i class="fa-solid fa-history"></i></div>Riwayat Barang Masuk
                </h2>
                <div class="flex gap-2 shrink-0">
                    <form method="GET" class="flex gap-2">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." class="admin-input w-32 py-2">
                        <button type="submit" class="admin-btn-ghost text-xs"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <a href="{{ route('admin.barang_masuk.export') }}" class="admin-btn-ghost text-xs"><i class="fa-solid fa-file-csv"></i> Export</a>
                </div>
            </div>

            <div class="overflow-x-auto rounded-xl border border-slate-100">
                <table class="w-full text-left">
                    <thead class="bg-emerald-50/50 text-[#1E5631] text-[10px] uppercase font-extrabold border-b border-emerald-100/40">
                        <tr>
                            <th class="py-3.5 px-4">ID TRANS</th>
                            <th class="py-3.5 px-4">NAMA BARANG</th>
                            <th class="py-3.5 px-4 text-center">KATEGORI</th>
                            <th class="py-3.5 px-4 text-right">JUMLAH</th>
                            <th class="py-3.5 px-4 text-center">TANGGAL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-xs text-center">
                        @forelse($data as $item)
                        <tr>
                            <td class="py-3.5 px-4">{{ $item->kode_transaksi }}</td>
                            <td class="py-3.5 px-4">{{ $item->nama_barang }}</td>
                            <td class="py-3.5 px-4">{{ $item->kategori }}</td>
                            <td class="py-3.5 px-4">{{ $item->jumlah }} {{ $item->satuan }}</td>
                            <td class="py-3.5 px-4">{{ $item->tanggal_masuk }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-16 text-slate-400 italic">Belum ada data transaksi yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-5 border border-slate-100 rounded-2xl shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl"><i class="fa-solid fa-leaf"></i></div>
            <div><span class="text-[10px] font-bold text-slate-400 uppercase block">Limbah Terolah</span><span class="text-xl font-black text-slate-800">0t</span></div>
        </div>
        <div class="bg-white p-5 border border-slate-100 rounded-2xl shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl"><i class="fa-solid fa-arrow-trend-up"></i></div>
            <div><span class="text-[10px] font-bold text-slate-400 uppercase block">Pertumbuhan Stok</span><span class="text-xl font-black text-emerald-600">0%</span></div>
        </div>
        <div class="bg-gradient-to-r from-emerald-800 to-emerald-950 p-5 rounded-2xl text-white flex items-center justify-between shadow-xs">
            <div>
                <h4 class="text-xs font-bold">Ekosistem Berkelanjutan</h4>
                <p class="text-[10px] text-emerald-200/80">Data akurat adalah langkah awal.</p>
            </div>
            <i class="fa-solid fa-globe text-2xl text-emerald-600/50"></i>
        </div>
    </div>
</div>
@endsection