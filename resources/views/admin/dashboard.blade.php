@extends('layouts.admin')

@section('content')

<h1>Dashboard Admin EcoBank</h1>

<br>

<div style="display:flex; gap:20px;">

    <div style="
        background:white;
        padding:20px;
        border-radius:10px;
        width:220px;
        box-shadow:0 2px 5px rgba(0,0,0,0.1);
    ">
        <h3>Total Warga</h3>
        <h2>0</h2>
    </div>

    <div style="
        background:white;
        padding:20px;
        border-radius:10px;
        width:220px;
        box-shadow:0 2px 5px rgba(0,0,0,0.1);
    ">
        <h3>Total Petugas</h3>
        <h2>0</h2>
    </div>

    <div style="
        background:white;
        padding:20px;
        border-radius:10px;
        width:220px;
        box-shadow:0 2px 5px rgba(0,0,0,0.1);
    ">
        <h3>Total Reward</h3>
        <h2>0</h2>
    </div>

</div>

<br><br>

<div style="
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
">

    <h3>Selamat Datang Admin EcoBank</h3>

    <p>
        Kelola data sampah, reward, warga dan petugas melalui menu di samping.
    </p>

</div>

@endsection