<!DOCTYPE html>
<html>

<head>
    <title>Tambah Reward</title>
</head>

<body>

    <h1>Tambah Reward</h1>

    <form action="{{ route('reward.store') }}" method="POST">

        @csrf

        <label>Nama Reward</label>
        <br>

        <input type="text" name="nama_reward">

        <br><br>

        <label>Jumlah Koin</label>
        <br>

        <input type="number" name="jumlah_koin">

        <br><br>

        <label>Stok</label>
        <br>

        <input type="number" name="stok">

        <br><br>

        <button type="submit">
            Simpan
        </button>

    </form>

    <br>

    <a href="{{ route('reward.index') }}">
        Kembali
    </a>

</body>

</html>