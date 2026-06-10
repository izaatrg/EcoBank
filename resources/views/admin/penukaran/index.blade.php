@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Manajemen Penukaran Reward</h2>
                <p class="mt-1 text-sm text-slate-500">Kelola permintaan penukaran reward dari warga.</p>
            </div>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Daftar Penukaran Reward</h3>
                <p class="text-sm text-slate-500">Ubah status penukaran langsung dari daftar.</p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-3xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm text-slate-700">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Warga</th>
                        <th class="px-6 py-4 font-semibold">Reward</th>
                        <th class="px-6 py-4 font-semibold">Koin</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($penukaran as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $item->warga->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $item->reward->nama_reward ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $item->jumlah_koin }}</td>
                        <td class="px-6 py-4">{{ ucfirst($item->status) }}</td>
                        <td class="px-6 py-4">{{ optional($item->created_at)->format('Y-m-d H:i') ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('penukaran.show', $item->id) }}" class="inline-flex items-center rounded-2xl bg-slate-900 px-3 py-2 text-xs font-medium text-white">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">Tidak ada data penukaran reward yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection