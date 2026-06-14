@extends('layouts.admin')

@section('page_title', 'Barang Keluar')
@section('search_placeholder', 'Cari data...')

@section('content')
<div class="max-w-[1340px] mx-auto space-y-6 animate-fade-in">

    @if(session('success'))
        <div class="toast-success">{{ session('success') }}</div>
    @endif

    <div class="space-y-1">
        <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Barang Keluar</h1>
        <p class="text-xs font-medium text-slate-400">Kelola pencatatan pengeluaran barang untuk penukaran atau distribusi.</p>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 items-start">
        {{-- Form kiri --}}
        <div class="xl:col-span-4 bg-white border border-slate-100 rounded-2xl p-6 shadow-xs hover:shadow-md transition-shadow duration-300">
            <h2 class="text-sm font-bold text-slate-800 mb-5 flex items-center gap-2">
                <span class="w-7 h-7 bg-emerald-50 text-emerald-700 rounded-lg flex items-center justify-center text-xs"><i class="fa-solid fa-circle-plus"></i></span>
                Catat Barang Keluar
            </h2>
            <form action="{{ route('admin.barang_keluar.store') }}" method="POST" class="space-y-4 admin-form" data-loading="true">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500">Nama Barang</label>
                    <input type="text" name="nama_barang" placeholder="Contoh: Pupuk Kompos Organik" class="admin-input" required>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500">Tujuan / Nama Penerima</label>
                    <input type="text" name="tujuan" placeholder="Nama Warga atau Nama Instansi" class="admin-input" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500">Jumlah</label>
                        <div class="relative">
                            <input type="number" name="jumlah" step="0.01" min="0.01" placeholder="0" class="admin-input pr-16" required>
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-400">Unit/Kg</span>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" value="{{ date('Y-m-d') }}" class="admin-input" required>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500">Keterangan</label>
                    <textarea rows="3" class="admin-input resize-none" placeholder="Alasan pengeluaran barang..." readonly tabindex="-1"></textarea>
                </div>
                <button type="submit" class="admin-btn-primary w-full">
                    <i class="fa-solid fa-check"></i> Simpan Data
                </button>
            </form>
        </div>

        {{-- Kanan: stat + tabel --}}
        <div class="xl:col-span-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-[#1E5631] text-white p-5 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5">
                    <p class="text-[10px] uppercase tracking-wider font-bold opacity-80">Total Keluar Hari Ini</p>
                    <div class="flex items-end justify-between mt-2">
                        <h2 class="text-4xl font-black">{{ number_format($totalHariIni, 0, ',', '.') }}</h2>
                        <i class="fa-solid fa-chart-line text-emerald-300/60 text-xl"></i>
                    </div>
                </div>
                <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-xs flex items-center justify-between hover:shadow-md transition-all duration-300">
                    <div>
                        <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400">Item Terbanyak</p>
                        <h2 class="text-2xl font-black text-slate-800 mt-1">{{ $itemTerbanyak }}</h2>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-xl"><i class="fa-solid fa-box"></i></div>
                </div>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-xs hover:shadow-md transition-shadow duration-300">
                <div class="flex justify-between items-center mb-4 pb-3 border-b border-slate-50">
                    <h3 class="text-sm font-bold text-slate-800">Riwayat Barang Keluar</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.barang_keluar.export') }}" class="admin-btn-ghost text-xs"><i class="fa-solid fa-filter"></i></a>
                        <a href="{{ route('admin.barang_keluar.export') }}" class="admin-btn-ghost text-xs"><i class="fa-solid fa-print"></i></a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                <th class="pb-3 px-2">Barang</th>
                                <th class="pb-3 px-2">Penerima</th>
                                <th class="pb-3 px-2">Jumlah</th>
                                <th class="pb-3 px-2">Tanggal</th>
                                <th class="pb-3 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-sm">
                            @forelse($data as $item)
                            <tr class="hover:bg-emerald-50/40 transition-colors duration-200">
                                <td class="py-4 px-2">
                                    <span class="font-bold text-slate-800 block">{{ $item->nama_barang }}</span>
                                    <span class="text-[10px] text-slate-400">Kategori: Organik</span>
                                </td>
                                <td class="py-4 px-2 text-slate-600">{{ $item->tujuan }}</td>
                                <td class="py-4 px-2">
                                    <span class="inline-flex items-center justify-center min-w-[56px] h-8 px-3 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">{{ $item->jumlah }} Kg</span>
                                </td>
                                <td class="py-4 px-2 text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d M Y') }}</td>
                                <td class="py-4 px-2 text-slate-300"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center text-slate-400 italic">Belum ada data barang keluar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between items-center mt-6 pt-4 border-t border-slate-50 text-xs text-slate-500">
                    <span>Menampilkan {{ $data->count() }} dari {{ $data->total() }} entri</span>
                    <div>{{ $data->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
