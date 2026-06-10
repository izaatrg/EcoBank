<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\TransaksiSetoranController;
use App\Http\Controllers\PenukaranRewardController;
use App\Http\Controllers\PenjemputanController;
use App\Http\Controllers\SaldoKoinController;
use App\Http\Controllers\RiwayatKoinController;

// Public
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
require __DIR__ . '/auth.php';

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Redirect to role-specific dashboard
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => redirect('/admin/dashboard'),
            'petugas' => redirect('/petugas/dashboard'),
            'warga' => redirect('/warga/dashboard'),
            default => redirect('/'),
        };
    })->name('dashboard');

    Route::get('/redirect', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => redirect('/admin/dashboard'),
            'petugas' => redirect('/petugas/dashboard'),
            'warga' => redirect('/warga/dashboard'),
            default => abort(403),
        };
    });

    // Profile Management
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
});

/**
 * ==========================================
 * ADMIN ROUTES
 * ==========================================
 */
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Master Data: Sampah Categories
    Route::resource('kategori', KategoriSampahController::class)->except(['show']);

    // Master Data: Rewards
    Route::resource('reward', RewardController::class)->except(['show']);

    // Data Management: Warga/Nasabah
    Route::resource('warga', WargaController::class)->except(['show']);

    // Data Management: Petugas
    Route::resource('petugas', PetugasController::class)->except(['show']);

    // Transaction Management: Setoran Sampah
    Route::resource('transaksi', TransaksiSetoranController::class)->except(['show']);

    // Pickup Management: Penjemputan
    Route::resource('penjemputan', PenjemputanController::class)->except(['show']);
    Route::patch('/penjemputan/{id}/status', [PenjemputanController::class, 'updateStatus'])->name('penjemputan.updateStatus');

    // Reward Exchange Management: Penukaran
    Route::get('/penukaran', [PenukaranRewardController::class, 'index'])->name('penukaran.index');
    Route::get('/penukaran/{id}', [PenukaranRewardController::class, 'show'])->name('penukaran.show');
    Route::patch('/penukaran/{id}', [PenukaranRewardController::class, 'update'])->name('penukaran.update');

    // Balance Management: Saldo Koin
    Route::get('/saldo', [SaldoKoinController::class, 'index'])->name('saldo.index');
    Route::get('/saldo/{id}', [SaldoKoinController::class, 'show'])->name('saldo.show');
    Route::post('/saldo/{id}/recalculate', [SaldoKoinController::class, 'recalculate'])->name('saldo.recalculate');

    // Coin History: Riwayat Koin
    Route::get('/riwayat-koin', [RiwayatKoinController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat-koin/{id}', [RiwayatKoinController::class, 'show'])->name('riwayat.show');
});

/**
 * ==========================================
 * PETUGAS ROUTES
 * ==========================================
 */
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');

    // Deposit Management: Setoran Sampah
    Route::get('/setoran', [TransaksiSetoranController::class, 'indexPetugas'])->name('setoran.index');
    Route::get('/setoran/create', [TransaksiSetoranController::class, 'createPetugas'])->name('setoran.create');
    Route::post('/setoran', [TransaksiSetoranController::class, 'storePetugas'])->name('setoran.store');
    Route::get('/setoran/{id}/edit', [TransaksiSetoranController::class, 'editPetugas'])->name('setoran.edit');
    Route::patch('/setoran/{id}', [TransaksiSetoranController::class, 'updatePetugas'])->name('setoran.update');
    Route::delete('/setoran/{id}', [TransaksiSetoranController::class, 'destroyPetugas'])->name('setoran.destroy');

    // Pickup Management: Penjemputan
    Route::resource('penjemputan', PenjemputanController::class, ['names' => 'penjemputan'])->only(['index', 'show']);
    Route::patch('/penjemputan/{id}/status', [PenjemputanController::class, 'updateStatus'])->name('penjemputan.updateStatus');

    // History: Riwayat Transaksi
    Route::get('/riwayat', [TransaksiSetoranController::class, 'showRiwayatPetugas'])->name('riwayat');

    // Profile
    Route::get('/profile', [PetugasController::class, 'showProfile'])->name('profile');
    Route::patch('/profile', [PetugasController::class, 'updateProfile'])->name('profile.update');
});

/**
 * ==========================================
 * WARGA ROUTES
 * ==========================================
 */
Route::middleware(['auth', 'role:warga'])->prefix('warga')->name('warga.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [WargaController::class, 'dashboard'])->name('dashboard');

    // Deposit Sampah: Setor
    Route::get('/setor', [TransaksiSetoranController::class, 'showFormWarga'])->name('setor.form');
    Route::post('/setor', [TransaksiSetoranController::class, 'storeWarga'])->name('setor.store');

    // Pickup Request: Jemput
    Route::get('/jemput', [PenjemputanController::class, 'showFormWarga'])->name('jemput.form');
    Route::post('/jemput', [PenjemputanController::class, 'storeWarga'])->name('jemput.store');
    Route::get('/jemput-history', [PenjemputanController::class, 'historyWarga'])->name('jemput.history');

    // Reward Exchange: Tukar Koin
    Route::get('/tukar', [PenukaranRewardController::class, 'showFormWarga'])->name('tukar.form');
    Route::post('/tukar', [PenukaranRewardController::class, 'storeWarga'])->name('tukar.store');
    Route::get('/tukar-history', [PenukaranRewardController::class, 'historyWarga'])->name('tukar.history');

    // History: Riwayat
    Route::get('/riwayat', [TransaksiSetoranController::class, 'showRiwayatWarga'])->name('riwayat');

    // Profile
    Route::get('/profile', [WargaController::class, 'showProfile'])->name('profile');
    Route::patch('/profile', [WargaController::class, 'updateProfile'])->name('profile.update');
});
