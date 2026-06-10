<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Warga - EcoBank</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: #f5f7f9;
        }

        .card {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            max-width: 400px;
            padding: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background: #0f5132;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .alert-success {
            background: #d1e7dd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert-error {
            background: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Dashboard Warga EcoBank</h1>
    <p>Saldo Koin: <strong>{{ $saldo }}</strong></p>

    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
    <div class="alert-error">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <h2>Setor Sampah</h2>
        <form action="{{ route('warga.setor.store') }}" method="POST">
            @csrf
            <label>Kategori Sampah</label>
            <select name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $item)
                <option value="{{ $item->id }}">{{ $item->nama_kategori }} ({{ $item->koin_per_kg }} koin/kg)</option>
                @endforeach
            </select>

            <label>Berat (kg)</label>
            <input type="number" name="berat" step="0.01" min="0.01" required>

            <button type="submit">Setor Sampah</button>
        </form>
    </div>

    <div class="card">
        <h2>Tukar Reward</h2>
        <form action="{{ route('warga.tukar.store') }}" method="POST">
            @csrf
            <label>Pilih Reward</label>
            <select name="reward_id" required>
                <option value="">-- Pilih Reward --</option>
                @foreach($rewards as $item)
                <option value="{{ $item->id }}">{{ $item->nama_reward }} ({{ $item->jumlah_koin }} koin, stok: {{ $item->stok }})</option>
                @endforeach
            </select>

            <button type="submit">Tukar Reward</button>
        </form>
    </div>

    <div class="card">
        <h2>Ajukan Penjemputan Sampah</h2>
        <form action="{{ route('warga.jemput.store') }}" method="POST">
            @csrf
            <label>Tanggal Jemput</label>
            <input type="date" name="tanggal_jemput" required>

            <label>Jam Jemput</label>
            <input type="time" name="jam_jemput" required>

            <label>Alamat Titik Penjemputan</label>
            <textarea name="catatan" rows="3" placeholder="Alamat lengkap titik penjemputan"></textarea>

            <button type="submit">Ajukan Penjemputan</button>
        </form>
    </div>

    <div class="card">
        <h2>Riwayat Penjemputan</h2>
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Alamat Titik Penjemputan</th>
                <th>Status Jadwal Penjemputan</th>
            </tr>
            @forelse($penjemputan as $item)
            <tr>
                <td>{{ $item->tanggal_jemput }}</td>
                <td>{{ $item->jam_jemput }}</td>
                <td>{{ $item->catatan ?? '-' }}</td>
                <td>{{ $item->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada permintaan penjemputan</td>
            </tr>
            @endforelse
        </table>
    </div>

    <div class="card">
        <h2>Riwayat Penukaran Reward</h2>
        <table>
            <tr>
                <th>Reward</th>
                <th>Koin</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
            @forelse($penukaranHistory as $item)
            <tr>
                <td>{{ $item->reward->nama_reward ?? '-' }}</td>
                <td>{{ $item->jumlah_koin }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada riwayat penukaran reward</td>
            </tr>
            @endforelse
        </table>
    </div>

</body>

</html>