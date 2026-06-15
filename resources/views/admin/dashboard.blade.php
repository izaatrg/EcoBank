@extends('layouts.admin')

@section('page_title', 'Ringkasan Operasional')

@section('content')
<div class="space-y-8 animate-fade-in">
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 text-[#1E5631] rounded-xl flex items-center justify-center text-lg shadow-inner">
                <i class="fa-solid fa-dumpster animate-pulse"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Sampah</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-0.5">{{ number_format($total_sampah ?? 0, 1) }} <span class="text-xs font-bold text-slate-400">Kg</span></h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-lg shadow-inner">
                <i class="fa-solid fa-coins"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Koin Terdistribusi</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-0.5">{{ number_format($total_koin ?? 0) }} <span class="text-xs font-bold text-amber-500">Eco</span></h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg shadow-inner">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Warga Terdaftar</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-0.5">{{ $total_warga ?? 0 }} <span class="text-xs font-bold text-slate-400">Jiwa</span></h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-lg shadow-inner">
                <i class="fa-solid fa-arrow-trend-up"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Setoran Hari Ini</p>
                <h3 class="text-2xl font-extrabold text-slate-800 mt-0.5">{{ $transaksi_hari_ini ?? 0 }} <span class="text-xs font-bold text-slate-400">Sesi</span></h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-linear-to-r from-white to-emerald-50/20">
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Aktivitas Setoran Terakhir</h3>
                    <p class="text-[11px] text-slate-400 font-medium mt-0.5">Daftar 5 penimbangan sampah terbaru dari warga.</p>
                </div>
                <a href="{{ route('admin.riwayat_transaksi.index') }}" class="admin-btn-ghost text-[10px] px-3 py-1.5 flex items-center gap-1.5">
                    Lihat Semua <i class="fa-solid fa-angle-right text-[8px]"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                            <th class="py-3 px-6">Warga</th>
                            <th class="py-3 px-6">Jenis Sampah</th>
                            <th class="py-3 px-6 text-center">Berat</th>
                            <th class="py-3 px-6 text-right">Koin Didapat</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-semibold text-slate-600 divide-y divide-slate-50">
                        {{-- 1. Variabel disesuaikan menjadi $recent_transaksi sesuai controller --}}
                        @forelse($recent_transaksi ?? [] as $tx)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-800">{{ $tx->warga->name ?? 'Warga Terhapus' }}</td>
                            <td class="py-4 px-6">
                                <span class="status-badge status-emerald">{{ $tx->kategori->nama ?? 'Umum' }}</span>
                            </td>
                            <td class="py-4 px-6 text-center font-bold text-[#1E5631]">{{ number_format($tx->berat, 1) }} Kg</td>
                            {{-- 2. Memanggil $tx->total_koin sesuai dengan nama kolom database kamu --}}
                            <td class="py-4 px-6 text-right text-amber-600 font-extrabold">+{{ number_format($tx->total_koin ?? 0) }} Eco</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-slate-400 font-medium">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fa-solid fa-folder-open text-2xl text-slate-300"></i>
                                    <span>Belum ada data setoran sampah masuk hari ini.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-gradient-to-br from-[#1E5631] to-[#2D6A4F] p-6 rounded-2xl text-white shadow-md relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 text-white/5 text-8xl pointer-events-none">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h3 class="text-sm font-bold tracking-wide">Pencatatan Cepat</h3>
                <p class="text-xs text-emerald-100/80 mt-1 mb-6">Warga sudah di depan timbangan? Klik tombol di bawah untuk langsung menginput data sampah.</p>
                
                <a href="{{ route('admin.transaksi.create') }}" class="w-full bg-white text-[#1E5631] hover:bg-emerald-50 py-3 rounded-xl text-xs font-extrabold flex items-center justify-center gap-2 shadow-sm transition-all active:scale-98">
                    <i class="fa-solid fa-scale-hammer"></i> Input Sampah Baru
                </a>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs space-y-4">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Petugas</h4>
                <div class="flex items-center justify-between p-3 bg-emerald-50/50 border border-emerald-100/40 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></div>
                        <span class="text-xs font-bold text-slate-700">Petugas Aktif</span>
                    </div>
                    <span class="text-[10px] font-extrabold bg-[#1E5631] text-white px-2 py-0.5 rounded-md">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection