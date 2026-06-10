@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Detail Saldo Koin</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi saldo dan rekalkulasi.</p>
            </div>
            <a href="{{ route('saldo.index') }}" class="inline-flex items-center rounded-2xl bg-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Kembali</a>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="space-y-4">
            <div><strong>Warga:</strong> {{ $saldo->warga->name ?? '-' }}</div>
            <div><strong>Email:</strong> {{ $saldo->warga->email ?? '-' }}</div>
            <div><strong>Saldo Terdaftar:</strong> {{ $saldo->total_koin }}</div>
            <div><strong>Saldo Dihitung dari Transaksi:</strong> {{ $calculated_total }}</div>

            <form action="{{ route('saldo.recalculate', $saldo->warga_id) }}" method="POST">
                @csrf
                <button type="submit" class="mt-4 inline-flex items-center rounded-2xl bg-emerald-600 px-4 py-2 text-sm font-medium text-white">Rekalkulasi Saldo</button>
            </form>
        </div>
    </div>
</div>
@endsection