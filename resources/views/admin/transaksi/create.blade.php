@extends('layouts.admin')

@section('page_title', 'Input Setoran Sampah')

@section('content')
<div class="max-w-3xl mx-auto p-2">
    <div class="mb-6">
        <a href="{{ route('admin.transaksi.index') }}" class="text-slate-500 hover:text-[#1E5631]">← Kembali</a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm">
        <div class="p-6 border-b border-slate-100">
            <h3 class="text-sm font-bold text-slate-800">Form Penimbangan Sampah Baru</h3>
        </div>

        <form action="{{ route('admin.transaksi.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase">Nama Nasabah</label>
                <select name="warga_id" required class="w-full mt-2 p-3 bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="" disabled selected>-- Pilih Warga --</option>
                    @foreach($wargas as $warga)
                    <option value="{{ $warga->id }}">{{ $warga->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase">Jenis Sampah</label>
                <select name="kategori_id" required class="w-full mt-2 p-3 bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase">Berat (Kg)</label>
                <input type="number" step="0.1" name="berat" required class="w-full mt-2 p-3 bg-slate-50 border border-slate-200 rounded-xl">
            </div>

            <button type="submit" class="w-full py-3 bg-[#1E5631] text-white rounded-xl font-bold">Simpan Transaksi</button>
        </form>
    </div>
</div>
@endsection