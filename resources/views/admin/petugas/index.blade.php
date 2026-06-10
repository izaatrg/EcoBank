@extends('layouts.admin')

@section('content')
<h1>Daftar Petugas</h1>

@if(session('success'))<div style="color:green">{{ session('success') }}</div>@endif

<a href="{{ route('petugas.create') }}">Tambah Petugas</a>

<table border="1" cellpadding="8" style="margin-top:10px; background:white;">
    <tr><th>Nama</th><th>Email</th><th>Aksi</th></tr>
    @foreach($petugas as $p)
    <tr>
        <td>{{ $p->name }}</td>
        <td>{{ $p->email }}</td>
        <td>
            <a href="{{ route('petugas.edit',$p->id) }}">Edit</a>
            <form action="{{ route('petugas.destroy',$p->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection
