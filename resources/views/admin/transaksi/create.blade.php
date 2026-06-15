@extends('layouts.admin')

@section('page_title', 'Input Setoran Sampah')

@section('content')
<div class="max-w-3xl mx-auto p-2 animate-fade-in">
    
    @if(session('success'))
    <div class="mb-6 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded shadow-sm animate-bounce-short">
        <p class="font-bold">Berhasil!</p>
        <p class="text-sm">{{ session('success') }}</p>
    </div>
    @endif
    
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-[#1E5631] transition-colors group">
            <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        
        <div class="p-6 border-b border-slate-100 bg-gradient-to-r from-white to-emerald-50/20 flex items-center gap-4">
            <div class="w-10 h-10 bg-emerald-50 text-[#1E5631] rounded-xl flex items-center justify-center text-base shadow-inner">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <div>
                <h3 class="text-sm font-bold text-slate-800">Form Penimbangan Sampah Baru</h3>
                <p class="text-[11px] text-slate-400 font-medium mt-0.5">Catat setoran masuk dan sistem akan menghitung koin warga secara otomatis.</p>
            </div>
        </div>

        <form action="{{ route('admin.transaksi.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="warga_id" class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                    Nama Warga / Nasabah <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <select name="warga_id" id="warga_id" required
                        class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 focus:border-[#1E5631] focus:bg-white rounded-xl text-xs font-semibold text-slate-700 transition-all outline-none appearance-none cursor-pointer">
                        <option value="" disabled selected>-- Pilih Warga --</option>
                        @foreach($wargas as $warga)
                            <option value="{{ $warga->id }}">{{ $warga->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label for="kategori_id" class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                    Kategori / Jenis Sampah <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-recycle"></i>
                    </div>
                    <select name="kategori_id" id="kategori_id" required
                        class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 focus:border-[#1E5631] focus:bg-white rounded-xl text-xs font-semibold text-slate-700 transition-all outline-none appearance-none cursor-pointer">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama }} (Rp{{ number_format($kat->harga ?? 0) }}/Kg)</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label for="berat" class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                    Berat Sampah (Kg) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-weight-hanging"></i>
                    </div>
                    <input type="number" step="0.1" min="0.1" name="berat" id="berat" required placeholder="0.0"
                        class="block w-full pl-10 pr-12 py-3 bg-slate-50 border border-slate-200 focus:border-[#1E5631] focus:bg-white rounded-xl text-xs font-bold text-slate-700 transition-all outline-none" />
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400 text-xs font-bold">
                        Kg
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-50 pt-4"></div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" 
                    class="px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" 
                    class="px-6 py-3 bg-[#1E5631] hover:bg-[#153d22] text-white rounded-xl text-xs font-extrabold flex items-center gap-2 shadow-sm transition-all active:scale-98 cursor-pointer">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection