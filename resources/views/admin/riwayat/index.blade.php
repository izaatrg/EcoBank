@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Riwayat Koin</h2>
                <p class="mt-1 text-sm text-slate-500">Pilih warga untuk melihat riwayat setoran dan penukaran koin.</p>
            </div>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="overflow-x-auto rounded-3xl border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm text-slate-700">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Warga</th>
                        <th class="px-6 py-4 font-semibold">Email</th>
                        <th class="px-6 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($wargas as $w)
                    <tr>
                        <td class="px-6 py-4">{{ $w->name }}</td>
                        <td class="px-6 py-4">{{ $w->email }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.riwayat.show', $w->id) }}" class="inline-flex items-center rounded-2xl bg-slate-900 px-3 py-2 text-xs font-medium text-white">Lihat Riwayat</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-sm text-slate-500">Tidak ada warga.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection