@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Detail Penukaran</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi detail penukaran reward dan kontrol status.</p>
            </div>
            <a href="{{ route('penukaran.index') }}" class="inline-flex items-center rounded-2xl bg-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Kembali</a>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <h3 class="text-lg font-semibold text-slate-900 mb-3">Data Warga & Reward</h3>
                <div class="space-y-2 text-sm text-slate-700">
                    <div><strong>Warga:</strong> {{ $penukaran->warga->name ?? '-' }}</div>
                    <div><strong>Email:</strong> {{ $penukaran->warga->email ?? '-' }}</div>
                    <div><strong>Reward:</strong> {{ $penukaran->reward->nama_reward ?? '-' }}</div>
                    <div><strong>Koin:</strong> {{ $penukaran->jumlah_koin }}</div>
                    <div><strong>Tanggal:</strong> {{ optional($penukaran->created_at)->format('Y-m-d H:i') }}</div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-slate-900 mb-3">Ubah Status</h3>

                <form action="{{ route('penukaran.update', $penukaran->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="text-sm font-medium text-slate-700">Status</label>
                        <select name="status" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-2 text-sm">
                            <option value="menunggu" {{ $penukaran->status === 'menunggu' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ $penukaran->status === 'disetujui' ? 'selected' : '' }}>Diproses</option>
                            <option value="diambil" {{ $penukaran->status === 'diambil' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit" class="inline-flex items-center rounded-2xl bg-emerald-600 px-4 py-2 text-sm font-medium text-white">Simpan</button>

                        <button type="button" disabled class="inline-flex items-center rounded-2xl bg-red-100 px-4 py-2 text-sm font-medium text-red-600">Ditolak (requires DB change)</button>
                    </div>
                </form>

                <div class="mt-6 text-sm text-slate-500">Catatan: Status "Ditolak" belum didukung di skema database saat ini.</div>
            </div>
        </div>
    </div>
</div>
@endsection