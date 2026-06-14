@extends('layouts.admin')

@section('content')
<h1>Tambah Transaksi Setoran</h1>

@if($errors->any())<div style="color:red"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

<form method="POST" action="{{ route('admin.transaksi.store') }}">
    @csrf
    <label>Warga</label><br>
    <select name="warga_id" required>
        <option value="">-- Pilih Warga --</option>
        @foreach($warga as $w)
            <option value="{{ $w->id }}">{{ $w->name }}</option>
        @endforeach
    </select><br>
    <label>Kategori</label><br>
    <select name="kategori_id" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategori as $k)
            <option value="{{ $k->id }}">{{ $k->nama_kategori }} ({{ $k->koin_per_kg }} koin/kg)</option>
        @endforeach
    </select><br>
    <label>Berat (kg)</label><br>
    <input type="number" step="0.01" name="berat" required><br>
    <button type="submit">Simpan</button>
</form>

@endsection
