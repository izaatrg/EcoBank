<!DOCTYPE html>
<html>

<head>
    <title>Edit Kategori</title>
</head>

<body>

    <h1>Edit Kategori Sampah</h1>

    <form action="{{ route('kategori.update',$kategori->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        <label>Nama Kategori</label>

        <br>

        <input type="text"
            name="nama_kategori"
            value="{{ $kategori->nama_kategori }}">

        <br><br>

        <label>Koin Per Kg</label>

        <br>

        <input type="number"
            name="koin_per_kg"
            value="{{ $kategori->koin_per_kg }}">

        <br><br>

        <button type="submit">
            Update
        </button>

    </form>

</body>

</html>