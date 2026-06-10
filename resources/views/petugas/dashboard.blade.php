<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas - EcoBank</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f5f7f9; }
        .card { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; max-width: 400px; padding: 8px; margin-top: 5px; }
        button { margin-top: 10px; padding: 8px 16px; background: #0f5132; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .alert-success { background: #d1e7dd; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>

<body>

    <h1>Dashboard Petugas EcoBank</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert-success" style="background:#f8d7da;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <h2>Catat Setor Sampah Warga</h2>
        <form action="{{ route('petugas.setor-sampah') }}" method="POST">
            @csrf
            <label>Warga</label>
            <select name="warga_id" required>
                <option value="">-- Pilih Warga --</option>
                @foreach($warga as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>

            <label>Kategori Sampah</label>
            <select name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kategori }} ({{ $item->koin_per_kg }} koin/kg)</option>
                @endforeach
            </select>

            <label>Berat (kg)</label>
            <input type="number" name="berat" step="0.01" min="0.01" required>

            <button type="submit">Simpan Setoran</button>
        </form>
    </div>

    <div class="card">
        <h2>Daftar Penjemputan</h2>
        <table>
            <tr>
                <th>Warga</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Alamat Titik Penjemputan</th>
                <th>Status Jadwal Penjemputan</th>
                <th>Aksi</th>
            </tr>
            @forelse($penjemputan as $item)
                <tr>
                    <td>{{ $item->warga->name ?? '-' }}</td>
                    <td>{{ $item->tanggal_jemput }}</td>
                    <td>{{ $item->jam_jemput }}</td>
                    <td>{{ $item->catatan ?? '-' }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <form action="{{ route('petugas.jemput-status', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <select name="status">
                                <option value="menunggu" @selected($item->status == 'menunggu')>Menunggu</option>
                                <option value="diproses" @selected($item->status == 'diproses')>Diproses</option>
                                <option value="selesai" @selected($item->status == 'selesai')>Selesai</option>
                            </select>
                            <button type="submit">Perbarui Status</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada permintaan penjemputan</td></tr>
            @endforelse
        </table>
    </div>

</body>
</html>
