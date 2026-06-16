@extends('layouts.warga')

@section('page_title', 'Dashboard Warga')
@section('page_subtitle', 'Selamat datang kembali! Pantau saldo koin dan setoran sampah Anda di sini.')

@section('content')
<style>
    /* Premium Dashboard Cards */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 4px 20px rgba(18, 73, 52, 0.04);
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(18, 73, 52, 0.08);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-icon.coin {
        background-color: #fef3c7;
        color: #d97706;
    }

    .stat-icon.weight {
        background-color: #dcfce7;
        color: #15803d;
    }

    .stat-number {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0.25rem 0;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Actions Section */
    .quick-actions {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 4px 20px rgba(18, 73, 52, 0.04);
        border: 1px solid #e2e8f0;
        margin-bottom: 2rem;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        font-size: 0.95rem;
    }

    .btn-action-primary {
        background-color: #1b513e;
        color: white;
    }

    .btn-action-primary:hover {
        background-color: #0f3d2e;
        transform: translateY(-2px);
    }

    /* Modern Table Design */
    .recent-table-card {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        box-shadow: 0 4px 20px rgba(18, 73, 52, 0.04);
        border: 1px solid #e2e8f0;
    }

    .table-container {
        overflow-x: auto;
        margin-top: 1rem;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .custom-table th {
        padding: 1rem;
        background-color: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 0.875rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .custom-table td {
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        font-size: 0.95rem;
    }

    .custom-table tr:hover {
        background-color: #f8fafc;
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-badge.proses {
        background-color: #ffedd5;
        color: #c2410c;
    }

    .status-badge.selesai {
        background-color: #dcfce7;
        color: #15803d;
    }
</style>

<!-- Stats Grid -->
<div class="dashboard-grid">
    <!-- Card Koin -->
    <div class="stat-card">
        <div>
            <div class="stat-label">Saldo Koin Anda</div>
            <div class="stat-number">{{ number_format($saldo) }}</div>
            <div style="font-size: 0.85rem; color: #64748b;">Gunakan koin untuk menukar hadiah menarik</div>
        </div>
        <div class="stat-icon coin">
            🪙
        </div>
    </div>

    <!-- Card Berat Sampah -->
    <div class="stat-card">
        <div>
            <div class="stat-label">Total Sampah Disetor</div>
            <div class="stat-number">{{ number_format($totalSetoran, 1) }} kg</div>
            <div style="font-size: 0.85rem; color: #64748b;">Kontribusi penyelamatan lingkungan Anda</div>
        </div>
        <div class="stat-icon weight">
            ♻️
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h3 class="card-title" style="margin-bottom: 0.5rem; font-size: 1.25rem;">⚡ Layanan Cepat</h3>
    <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">Pilih salah satu menu di bawah ini untuk mengelola aktivitas bank sampah Anda:</p>
    <div class="action-buttons">
        <a href="#" class="btn-action btn-action-primary">
            📦 Setor Sampah
        </a>
        <a href="#" class="btn-action btn-action-primary">
            🚚 Pesan Penjemputan
        </a>
        <a href="#" class="btn-action btn-action-primary">
            🎁 Tukar Koin Reward
        </a>
    </div>
</div>

<!-- Recent Transactions Table -->
<div class="recent-table-card">
    <h3 class="card-title" style="font-size: 1.25rem; margin-bottom: 0.5rem;">📋 5 Setoran Terakhir Anda</h3>
    @if($recentTransaksis->isEmpty())
        <div style="text-align: center; padding: 2rem; color: #64748b;">
            <p>Anda belum pernah melakukan setoran sampah.</p>
            <p style="font-size: 0.85rem; margin-top: 0.5rem;">Yuk mulai setor sampah pertama Anda!</p>
        </div>
    @else
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Berat</th>
                        <th>Koin Didapat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransaksis as $transaksi)
                        <tr>
                            <td>{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $transaksi->kategori->nama ?? 'Tidak Diketahui' }}</td>
                            <td>{{ number_format($transaksi->berat, 1) }} kg</td>
                            <td style="font-weight: 600; color: #15803d;">+{{ number_format($transaksi->total_koin) }}</td>
                            <td>
                                <span class="status-badge {{ $transaksi->status }}">
                                    {{ $transaksi->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
