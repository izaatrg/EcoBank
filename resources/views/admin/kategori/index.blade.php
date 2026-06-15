@extends('layouts.admin')

@section('search_placeholder', 'Cari kategori...')

@section('page_title')
    <div class="flex items-center gap-3">
        <span>Data Sampah</span>
        <span class="bg-[#92E3A9] text-[#064E3B] text-[10px] font-black px-2 py-0.5 rounded uppercase tracking-widest cursor-default select-none">
            INVENTARIS
        </span>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    
    @if(session('success'))
    <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-black text-[#064E3B]">Kelola Kategori Sampah</h1>
            <p class="text-sm font-medium text-emerald-800/60 mt-1">Pantau harga pasar dan ketersediaan stok sampah terkini.</p>
        </div>
        
        <a href="{{ route('admin.kategori.create') }}" class="bg-[#1E5631] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#2D6A4F] transition-all flex items-center gap-2 shadow-sm active:scale-95 cursor-pointer">
            <i class="fa-solid fa-plus text-xs"></i> 
            <span class="text-sm">Tambah Kategori Sampah</span>
        </a>
    </div>

    {{-- Statistik Card --}}
    <div class="grid grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">TOTAL JENIS</p>
            <h2 class="text-2xl font-black text-[#064E3B] mt-2">{{ $totalJenis }}</h2>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">STOK TERBANYAK</p>
            <h2 class="text-2xl font-black text-[#064E3B] mt-2">{{ $stokTerbanyak ?? 0 }} kg</h2>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">RATA-RATA HARGA</p>
            <h2 class="text-2xl font-black text-[#064E3B] mt-2">Rp{{ number_format($rataRataHarga ?? 0, 0, ',', '.') }}</h2>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">UPDATE TERAKHIR</p>
            <h2 class="text-sm font-black text-[#064E3B] mt-4">
                {{ $updateTerakhir ? $updateTerakhir->updated_at->diffForHumans() : '-' }}
            </h2>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50">
                <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                    <th class="px-6 py-4">KATEGORI</th>
                    <th class="px-6 py-4">HARGA (PER KG)</th>
                    <th class="px-6 py-4">STOK SAAT INI</th>
                    <th class="px-6 py-4">KONDISI</th>
                    <th class="px-6 py-4 text-right">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $kategori)
                <tr class="border-b border-slate-50 hover:bg-emerald-50/30 transition-colors">
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $kategori->nama }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($kategori->harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $kategori->stok }} kg</td>
                    <td class="px-6 py-4"><span class="status-badge status-emerald">{{ $kategori->kondisi }}</span></td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="admin-btn-ghost text-xs inline-flex">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-btn-ghost text-xs text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-24 text-center text-slate-400 italic">Belum ada data kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer Stats & Export --}}
    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start gap-4">
            <div class="w-12 h-12 bg-emerald-700 rounded-xl flex items-center justify-center text-white shrink-0">
                <i class="fa-solid fa-chart-line text-lg"></i>
            </div>
            <div>
                <h3 class="text-sm font-bold text-emerald-950">Analisis Kategori</h3>
                <p class="text-xs text-gray-500 mt-1">Data dihitung berdasarkan total {{ $totalJenis }} kategori.</p>
            </div>
        </div>

        <div class="bg-[#1e5631] p-6 rounded-2xl shadow-lg relative overflow-hidden text-white">
            <div class="relative z-10">
                <h3 class="text-sm font-bold">Cetak Laporan</h3>
                <p class="text-xs text-emerald-100 mt-1 opacity-80">Unduh data inventaris.</p>
                
                {{-- Tombol PDF & CSV dengan Ikon --}}
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('admin.kategori.export.pdf') }}" class="bg-white text-[#1e5631] px-4 py-2 rounded-lg font-bold text-[10px] shadow-sm hover:bg-gray-100 transition-colors flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf"></i>
                        <span>Unduh PDF</span>
                    </a>
                    <a href="{{ route('admin.kategori.export.csv') }}" class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg font-bold text-[10px] hover:bg-white/20 transition-colors flex items-center gap-2">
                        <i class="fa-solid fa-file-csv"></i>
                        <span>Export CSV</span>
                    </a>
                </div>
            </div>
            <i class="fa-solid fa-recycle absolute -bottom-4 -right-4 text-[100px] text-white/5 rotate-12"></i>
        </div>
    </div>
</div>
@endsection