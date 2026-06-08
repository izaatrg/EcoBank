<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KategoriSampahController;
use App\Http\Controllers\RewardController;



Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Redirect Berdasarkan Role
|--------------------------------------------------------------------------
*/

Route::get('/redirect', function () {

    if (auth()->user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }

    if (auth()->user()->role == 'petugas') {
        return redirect('/petugas/dashboard');
    }

    if (auth()->user()->role == 'warga') {
        return redirect('/warga/dashboard');
    }

    abort(403);
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get(
            '/admin/dashboard',
            [AdminController::class, 'dashboard']
        )
            ->name('admin.dashboard');
    });

/*
|--------------------------------------------------------------------------
| Petugas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:petugas'])
    ->group(function () {

        Route::get(
            '/petugas/dashboard',
            [PetugasController::class, 'dashboard']
        )
            ->name('petugas.dashboard');
    });

/*
|--------------------------------------------------------------------------
| Warga
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:warga'])
    ->group(function () {

        Route::get(
            '/warga/dashboard',
            [WargaController::class, 'dashboard']
        )
            ->name('warga.dashboard');
    });

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get(
            '/admin/dashboard',
            [AdminController::class, 'dashboard']
        );

        Route::resource(
            'kategori',
            KategoriSampahController::class
        );
    });

Route::middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get(
            '/admin/dashboard',
            [AdminController::class, 'dashboard']
        );

        Route::resource(
            'kategori',
            KategoriSampahController::class
        );

        Route::resource(
            'reward',
            RewardController::class
        );
    });
