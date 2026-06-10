@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Edit Penukaran Reward</h2>
                <p class="mt-1 text-sm text-slate-500">Halaman edit ini menunggu backend admin penukaran reward untuk menerima data.</p>
            </div>
            <span class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-sm font-medium text-amber-700">Disabled</span>
        </div>
    </div>

    <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <div class="mb-6 rounded-3xl bg-slate-50 p-4 text-sm text-slate-600 ring-1 ring-slate-200">
            Halaman ini adalah template edit. Jika backend sudah tersedia, gantikan action form dan field disabled dengan data dinamis.
        </div>

        <form action="#" method="POST" class="space-y-6">
            <div class="grid gap-6 md:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Warga</span>
                    <select disabled class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-100 px-4 py-3 text-sm text-slate-500">
                        <option>Backend belum terpasang</option>
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Reward</span>
                    <select disabled class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-100 px-4 py-3 text-sm text-slate-500">
                        <option>Backend belum terpasang</option>
                    </select>
                </label>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Jumlah Koin</span>
                    <input type="number" disabled class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-100 px-4 py-3 text-sm text-slate-500" placeholder="0" />
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-slate-700">Status</span>
                    <select disabled class="mt-2 w-full rounded-3xl border border-slate-300 bg-slate-100 px-4 py-3 text-sm text-slate-500">
                        <option>Menunggu</option>
                    </select>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="button" disabled class="inline-flex items-center rounded-3xl bg-slate-300 px-6 py-3 text-sm font-semibold text-slate-700">
                    Perbarui Penukaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection