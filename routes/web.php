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
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        return match ($role) {
            'admin' => redirect('/admin/dashboard'),
            'petugas' => redirect('/petugas/dashboard'),
            'warga' => redirect('/warga/dashboard'),
            default => redirect('/'),
        };
    })->name('dashboard');

    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('kategori', KategoriSampahController::class)->except(['show']);
    Route::resource('reward', RewardController::class)->except(['show']);
    Route::resource('warga', WargaController::class)->except(['show']);
    Route::resource('petugas', PetugasController::class)->except(['show']);

    Route::resource('transaksi', TransaksiSetoranController::class)->except(['show']);
    Route::resource('penjemputan', PenjemputanController::class)->except(['show']);
    Route::patch('/penjemputan/{id}/status', [PenjemputanController::class, 'updateStatus'])->name('penjemputan.updateStatus');

    Route::get('/penukaran', [PenukaranRewardController::class, 'index'])->name('penukaran.index');
    Route::get('/saldo', [SaldoKoinController::class, 'index'])->name('saldo.index');
    Route::get('/riwayat-koin', [RiwayatKoinController::class, 'index'])->name('riwayat.index');

    // Barang Masuk
    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang_masuk.index');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang_masuk.store');
    Route::get('/barang-masuk/export', [BarangMasukController::class, 'export'])->name('barang_masuk.export');

    // Barang Keluar 
    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang_keluar.index');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang_keluar.store');
});

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');
    Route::get('/setoran', [TransaksiSetoranController::class, 'indexPetugas'])->name('setoran.index');
});

Route::middleware(['auth', 'role:warga'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [WargaController::class, 'dashboard'])->name('dashboard');
});
