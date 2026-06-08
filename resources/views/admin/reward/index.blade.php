<!DOCTYPE html>
<html>

<head>
    <title>Data Reward</title>
</head>

<body>

    <h1>Data Reward</h1>

    <a href="{{ route('reward.create') }}">
        Tambah Reward
    </a>

    <br><br>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Nama Reward</th>
            <th>Koin</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        @foreach($reward as $item)

        <tr>

            <td>{{ $item->id }}</td>

            <td>{{ $item->nama_reward }}</td>

            <td>{{ $item->jumlah_koin }}</td>

            <td>{{ $item->stok }}</td>

            <td>

                <a href="{{ route('reward.edit',$item->id) }}">
                    Edit
                </a>

                <form
                    action="{{ route('reward.destroy',$item->id) }}"
                    method="POST"
                    style="display:inline;">

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