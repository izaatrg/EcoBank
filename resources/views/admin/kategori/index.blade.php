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
    
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-black text-[#064E3B]">Kelola Kategori Sampah</h1>
            <p class="text-sm font-medium text-emerald-800/60 mt-1">Pantau harga pasar dan ketersediaan stok sampah terkini.</p>
        </div>
        
        <a href="{{ route('admin.kategori.create') }}" class="bg-[#1E5631] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#2D6A4F] transition-all flex items-center gap-2 shadow-sm hover:shadow-md active:scale-95 cursor-pointer">
            <i class="fa-solid fa-plus text-xs"></i> 
            <span class="text-sm">Tambah Kategori Sampah</span>
        </a>
    </div>

    <div class="grid grid-cols-4 gap-6">
        @foreach(['TOTAL JENIS' => '0', 'STOK TERBANYAK' => '-', 'RATA-RATA HARGA' => 'Rp0', 'UPDATE TERAKHIR' => '-'] as $label => $val)
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm transition-all hover:shadow-md">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $label }}</p>
            <h2 class="text-2xl font-black text-[#064E3B] mt-2">{{ $val }}</h2>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden transition-all hover:shadow-md">
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
                <tr class="border-b border-slate-50 hover:bg-emerald-50/30 transition-colors duration-200">
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
                <tr>
                    <td colspan="5" class="py-24 text-center text-slate-400 font-medium italic">
                        Belum ada kategori sampah yang diinput.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-start gap-4 transition-all hover:shadow-md">
            <div class="w-12 h-12 bg-emerald-700 rounded-xl flex items-center justify-center text-white shrink-0">
                <i class="fa-solid fa-chart-line text-lg"></i>
            </div>
            <div>
                <h3 class="text-sm font-bold text-emerald-950">Rekomendasi Penyesuaian Harga</h3>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Belum ada data untuk dianalisis.</p>
            </div>
        </div>

        <div class="bg-[#1e5631] p-6 rounded-2xl shadow-lg relative overflow-hidden text-white transition-all hover:shadow-2xl">
            <div class="relative z-10">
                <h3 class="text-sm font-bold">Cetak Laporan Inventaris</h3>
                <p class="text-xs text-emerald-100 mt-1 opacity-80">Unduh rekapitulasi stok dan nilai aset sampah.</p>
                <div class="flex gap-2 mt-4">
                    <button class="bg-white text-[#1e5631] px-4 py-2 rounded-lg font-bold text-[10px] shadow-sm hover:bg-gray-100 transition-colors active:scale-95">Unduh PDF</button>
                    <button class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg font-bold text-[10px] hover:bg-white/20 transition-colors active:scale-95">Export CSV</button>
                </div>
            </div>
            <i class="fa-solid fa-recycle absolute -bottom-4 -right-4 text-[100px] text-white/5 rotate-12"></i>
        </div>
    </div>
</div>
@endsection