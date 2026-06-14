@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
        <div class="space-y-2">
            <h1 class="text-2xl font-semibold text-slate-900">Edit Warga</h1>
            <p class="text-sm text-slate-500">Perbarui informasi warga yang sudah terdaftar di EcoBank.</p>
        </div>

        @if($errors->any())
        <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
            <strong class="font-semibold">Periksa kembali data berikut:</strong>
            <ul class="mt-3 list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.warga.update', $warga->id) }}" class="mt-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $warga->name) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-[#1b513e] focus:ring-2 focus:ring-[#1b513e]/20" required>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $warga->email) }}" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-[#1b513e] focus:ring-2 focus:ring-[#1b513e]/20" required>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-[#1b513e] focus:ring-2 focus:ring-[#1b513e]/20">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-[#1b513e] focus:ring-2 focus:ring-[#1b513e]/20">
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-4">
                <a href="{{ route('admin.warga.index') }}" class="rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Kembali</a>
                <button type="submit" class="rounded-2xl bg-[#1b513e] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#16432f]">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection