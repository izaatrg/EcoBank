@extends('layouts.admin')

@section('page_title', 'Riwayat Transaksi')
@section('search_placeholder', 'Cari transaksi...')

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">Riwayat Transaksi</h1>
            <p class="text-xs text-slate-400 mt-1 max-w-xl">Daftar lengkap aktivitas keuangan dan pengelolaan sampah komunitas Anda secara real-time.</p>
        </div>
        <button type="button" class="admin-btn-primary text-xs"><i class="fa-solid fa-download"></i> Export PDF</button>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($stats as $stat)
        <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-xs hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $stat['label'] }}</p>
                    <p class="text-xl font-black text-slate-800 mt-1">{{ $stat['value'] }}</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center"><i class="fa-solid {{ $stat['icon'] }}"></i></div>
            </div>
        </div>
        @endforeach
    </div>

    <form method="GET" class="bg-white border border-slate-100 rounded-2xl p-4 flex flex-wrap gap-3 items-center shadow-xs">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari ID, Nasabah, atau Koin..." class="admin-input flex-1 min-w-[200px]">
        <select name="jenis" class="admin-input w-auto">
            <option value="">Semua Jenis</option>
            <option value="Setoran" @selected(request('jenis')=='Setoran')>Setoran</option>
            <option value="Penukaran" @selected(request('jenis')=='Penukaran')>Penukaran</option>
        </select>
        <select name="status" class="admin-input w-auto">
            <option value="">Semua Status</option>
            <option value="Berhasil" @selected(request('status')=='Berhasil')>Berhasil</option>
            <option value="Proses" @selected(request('status')=='Proses')>Proses</option>
            <option value="Batal" @selected(request('status')=='Batal')>Batal</option>
        </select>
        <button type="submit" class="admin-btn-primary text-xs">Filter</button>
    </form>

    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase">
                    <tr>
                        <th class="py-3 px-4">ID Transaksi</th>
                        <th class="py-3 px-4">Tanggal</th>
                        <th class="py-3 px-4">Jenis</th>
                        <th class="py-3 px-4">Nasabah</th>
                        <th class="py-3 px-4">Nilai (Koin)</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transaksi as $t)
                    <tr class="hover:bg-emerald-50/30 transition-colors duration-200">
                        <td class="py-3 px-4 font-bold text-slate-700">{{ $t['id'] }}</td>
                        <td class="py-3 px-4 text-slate-500 text-xs">{{ $t['tanggal'] }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-[10px] font-bold {{ $t['jenis'] === 'Setoran' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                <i class="fa-solid {{ $t['jenis'] === 'Setoran' ? 'fa-arrow-down' : 'fa-rotate' }}"></i> {{ $t['jenis'] }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-black flex items-center justify-center">{{ $t['inisial'] }}</span>
                                <span class="font-medium">{{ $t['nasabah'] }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 font-bold {{ str_starts_with($t['nilai'], '+') ? 'text-emerald-600' : 'text-red-500' }}">{{ $t['nilai'] }}</td>
                        <td class="py-3 px-4">
                            @php
                                $dot = match($t['status']) { 'Berhasil' => 'bg-emerald-500', 'Proses' => 'bg-slate-400', default => 'bg-red-500' };
                            @endphp
                            <span class="inline-flex items-center gap-1.5 text-xs"><span class="w-2 h-2 rounded-full {{ $dot }}"></span>{{ $t['status'] }}</span>
                        </td>
                        <td class="py-3 px-4 text-slate-300"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="py-16 text-center text-slate-400 italic">Tidak ada transaksi ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-t border-slate-50 flex justify-between items-center text-xs text-slate-500">
            <span>Menampilkan 1-{{ $transaksi->count() }} dari 128 transaksi</span>
            <div class="flex gap-1">
                <button class="admin-btn-ghost px-3 py-1.5" disabled>Sebelumnya</button>
                <button class="w-8 h-8 rounded-lg bg-[#1E5631] text-white font-bold">1</button>
                <button class="admin-btn-ghost px-3 py-1.5">Berikutnya</button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="bg-[#1E5631] rounded-2xl p-6 text-white hover:shadow-xl transition-shadow duration-300">
            <h3 class="font-bold">Butuh Laporan Bulanan?</h3>
            <p class="text-xs text-emerald-100 mt-2 opacity-90">Jadwalkan laporan otomatis ke email admin setiap akhir bulan.</p>
            <button type="button" class="mt-4 bg-white/10 border border-white/20 px-4 py-2 rounded-xl text-xs font-bold hover:bg-white/20 transition-colors">Pengaturan Laporan</button>
        </div>
        <div class="bg-[#E8F9EE] rounded-2xl p-6 border border-emerald-100 hover:shadow-md transition-all duration-300">
            <h3 class="font-bold text-[#1E5631]">Tips Keamanan</h3>
            <ul class="mt-3 space-y-2 text-xs text-slate-600">
                <li class="flex gap-2"><i class="fa-solid fa-check text-emerald-600 mt-0.5"></i> Verifikasi foto setoran sebelum approve koin.</li>
                <li class="flex gap-2"><i class="fa-solid fa-check text-emerald-600 mt-0.5"></i> Validasi identitas untuk penukaran koin bernilai tinggi.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
