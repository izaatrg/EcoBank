@extends('layouts.admin')

@section('content')
<h1>Edit Transaksi</h1>

@if($errors->any())<div style="color:red"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

<form method="POST" action="{{ route('admin.transaksi.update',$transaksi->id) }}">
    @csrf
    @method('PUT')
    <label>Warga</label><br>
    <select name="warga_id" required>
        @foreach($warga as $w)
            <option value="{{ $w->id }}" @selected($transaksi->warga_id == $w->id)>{{ $w->name }}</option>
        @endforeach
    </select><br>
    <label>Kategori</label><br>
    <select name="kategori_id" required>
        @foreach($kategori as $k)
            <option value="{{ $k->id }}" @selected($transaksi->kategori_id == $k->id)>{{ $k->nama_kategori }} ({{ $k->koin_per_kg }} koin/kg)</option>
        @endforeach
    </select><br>
    <label>Berat (kg)</label><br>
    <input type="number" step="0.01" name="berat" value="{{ $transaksi->berat }}" required><br>
    <button type="submit">Update</button>
</form>

@endsection
