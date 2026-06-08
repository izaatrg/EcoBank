<!DOCTYPE html>
<html>

<head>
    <title>Data Kategori Sampah</title>
</head>

<body>

    <h1>Data Kategori Sampah</h1>

    <a href="{{ route('kategori.create') }}">
        Tambah Kategori
    </a>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Koin/Kg</th>
            <th>Aksi</th>
        </tr>

        @foreach($kategori as $item)

        <tr>

            <td>{{ $item->id }}</td>

            <td>{{ $item->nama_kategori }}</td>

            <td>{{ $item->koin_per_kg }}</td>

            <td>

                <a href="{{ route('kategori.edit',$item->id) }}">
                    Edit
                </a>

                <form action="{{ route('kategori.destroy',$item->id) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

</body>

</html>