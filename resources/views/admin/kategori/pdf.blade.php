<!DOCTYPE html>
<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Kategori Sampah</h2>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok (Kg)</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $k)
            <tr>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->harga }}</td>
                <td>{{ $k->stok }}</td>
                <td>{{ $k->kondisi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>