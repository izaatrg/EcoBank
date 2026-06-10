@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Riwayat Koin - {{ $warga->name }}</h2>
                <p class="mt-1 text-sm text-slate-500">Riwayat setoran (masuk) dan penukaran (keluar) koin.</p>
            </div>
            <a href="{{ route('riwayat.index') }}" class="inline-flex items-center rounded-2xl bg-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Kembali</a>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="overflow-x-auto rounded-3xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm text-slate-700">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Tipe</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold">Jumlah</th>
                        + <th class="px-6 py-4 font-semibold">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($riwayat as $r)
                    <tr>
                        <td class="px-6 py-4">{{ ucfirst($r->type) }}</td>
                        <td class="px-6 py-4">{{ optional($r->tanggal)->format('Y-m-d H:i') ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $r->jumlah }}</td>
                        + <td class="px-6 py-4">@if($r->type === 'setoran') Berat: {{ $r->berat ?? '-' }} kg @else - @endif</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-sm text-slate-500">Tidak ada riwayat untuk warga ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection