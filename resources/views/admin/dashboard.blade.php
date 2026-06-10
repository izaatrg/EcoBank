@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="p-2">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Halo, Admin EcoBank</h1>
            <p class="text-slate-400 mt-2 font-medium">Berikut ringkasan statistik Bank Sampah hari ini, <span class="text-slate-600 font-semibold">{{ date('d M Y') }}</span>.</p>
        </div>
        <a href="{{ route('admin.transaksi.index') }}" class="bg-[#10B981] text-white px-8 py-4 rounded-3xl font-bold flex items-center gap-3 hover:bg-emerald-600 transition-all shadow-xl shadow-emerald-100 transform hover:-translate-y-1">
            <i class="fa-solid fa-plus text-lg"></i> Kelola Transaksi Baru
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> Aktif
                </span>
                <div class="text-emerald-500 text-lg opacity-30"><i class="fa-solid fa-users"></i></div>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Warga</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $total_warga }} <span class="text-lg text-slate-400 font-medium">Jiwa</span></h3>
        </div>

        <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="text-[10px] font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded-lg">Petugas</span>
                <div class="text-blue-500 text-lg opacity-30"><i class="fa-solid fa-user-shield"></i></div>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Petugas</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $total_petugas }} <span class="text-lg text-slate-400 font-medium">User</span></h3>
        </div>

        <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="text-[10px] font-bold text-purple-500 bg-purple-50 px-2 py-1 rounded-lg">Arus Data</span>
                <div class="text-purple-500 text-lg opacity-30"><i class="fa-solid fa-arrow-right-arrow-left"></i></div>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Transaksi</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $total_transaksi }} <span class="text-lg text-slate-400 font-medium">Log</span></h3>
        </div>

        <div class="bg-white p-6 rounded-[32px] border border-slate-100 shadow-sm transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="text-[10px] font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded-lg">Katalog</span>
                <div class="text-orange-500 text-lg opacity-30"><i class="fa-solid fa-gift"></i></div>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Reward</p>
            <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $total_reward }} <span class="text-lg text-slate-400 font-medium">Item</span></h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <div class="lg:col-span-2 bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Tren Aktivitas Sistem</h3>
                    <p class="text-slate-400 text-sm font-medium">Rasio log operasional EcoBank</p>
                </div>
                <div class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-xl">
                    Live Monitor
                </div>
            </div>

            <div class="flex items-end justify-between h-60 gap-4 px-4">
                <div class="flex flex-col items-center flex-1 gap-4">
                    <div class="w-full bg-slate-50 rounded-t-2xl h-24 transition-all hover:bg-emerald-100"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sen</span>
                </div>
                <div class="flex flex-col items-center flex-1 gap-4">
                    <div class="w-full bg-slate-50 rounded-t-2xl h-40 transition-all hover:bg-emerald-100"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sel</span>
                </div>
                <div class="flex flex-col items-center flex-1 gap-4">
                    <div class="w-full bg-slate-50 rounded-t-2xl h-32 transition-all hover:bg-emerald-100"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rab</span>
                </div>
                <div class="flex flex-col items-center flex-1 gap-4">
                    <div class="w-full bg-[#10B981] rounded-t-2xl h-56 shadow-lg shadow-emerald-100"></div>
                    <span class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest">Kam</span>
                </div>
                <div class="flex flex-col items-center flex-1 gap-4">
                    <div class="w-full bg-slate-50 rounded-t-2xl h-44 transition-all hover:bg-emerald-100"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jum</span>
                </div>
                <div class="flex flex-col items-center flex-1 gap-4">
                    <div class="w-full bg-slate-50 rounded-t-2xl h-20 transition-all hover:bg-emerald-100"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sab</span>
                </div>
                <div class="flex flex-col items-center flex-1 gap-4">
                    <div class="w-full bg-slate-50 rounded-t-2xl h-28 transition-all hover:bg-emerald-100"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Min</span>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[40px] border border-slate-100 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Status Log Tambahan</h3>
                <p class="text-slate-400 text-sm font-medium mb-6">Ringkasan penjemputan & klaim warga</p>
            </div>

            <div class="space-y-5">
                <div class="flex items-center justify-between p-3 bg-red-50/50 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-500 text-white rounded-xl flex items-center justify-center shadow-md shadow-red-100"><i class="fa-solid fa-truck text-xs"></i></div>
                        <span class="text-sm font-bold text-slate-800">Total Penjemputan</span>
                    </div>
                    <span class="text-xl font-black text-red-600">{{ $total_penjemputan }}</span>
                </div>

                <div class="flex items-center justify-between p-3 bg-indigo-50/50 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-500 text-white rounded-xl flex items-center justify-center shadow-md shadow-indigo-100"><i class="fa-solid fa-receipt text-xs"></i></div>
                        <span class="text-sm font-bold text-slate-800">Total Penukaran</span>
                    </div>
                    <span class="text-xl font-black text-indigo-600">{{ $total_penukaran }}</span>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 mt-4">
                <div class="flex items-center gap-4 bg-slate-50 p-3 rounded-2xl">
                    <div class="w-12 h-12 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-400">
                        <i class="fa-solid fa-qrcode text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Sistem E-Struk QR</h4>
                        <p class="text-xs text-slate-400 font-medium">Terintegrasi otomatis ke warga</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-[#1E5631] p-8 md:p-10 rounded-[48px] text-white flex flex-col md:flex-row items-start md:items-center justify-between relative overflow-hidden gap-6">
        <div class="relative z-10">
            <h3 class="text-2xl font-bold mb-2">Akses Cepat Pengaturan Fitur</h3>
            <p class="text-emerald-100/70 text-sm max-w-xl leading-relaxed">Gunakan shortcut di bawah untuk melompat langsung ke halaman konfigurasi master data EcoBank Anda.</p>

            <div class="flex flex-wrap gap-3 mt-6">
                <a href="{{ route('admin.kategori.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl text-xs font-bold border border-white/10 transition">
                    📦 Kategori Sampah
                </a>
                <a href="{{ route('admin.reward.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl text-xs font-bold border border-white/10 transition">
                    🎁 Master Reward
                </a>
                <a href="{{ route('admin.warga.index') }}" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-xl text-xs font-bold border border-white/10 transition">
                    👥 Data Warga
                </a>
            </div>
        </div>
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl"></div>
    </div>
</div>
@endsection