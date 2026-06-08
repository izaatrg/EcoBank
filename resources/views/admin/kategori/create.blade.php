<!DOCTYPE html>
<html>

<head>
    <title>Tambah Kategori</title>
</head>

<body>

    <h1>Tambah Kategori Sampah</h1>

    <form action="{{ route('kategori.store') }}"
        method="POST">

        @csrf

        <label>Nama Kategori</label>

        <br>

        <input type="text"
            name="nama_kategori">

        <br><br>

        <label>Koin Per Kg</label>

        <br>

        <input type="number"
            name="koin_per_kg">

        <br><br>

        <button type="submit">
            Simpan
        </button>

    </form>

</body>

</html>