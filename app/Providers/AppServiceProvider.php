<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\{TransaksiSetoran, KategoriSampah, User};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        // 1. Data untuk Dashboard (image_91154b.png)
        View::composer('admin.dashboard', function ($view) {
            $view->with([
                'totalSampah'    => TransaksiSetoran::sum('berat'),
                'koinTotal'      => TransaksiSetoran::sum('total_koin'),
                'wargaCount'     => User::where('role', 'warga')->count(),
                'setoranHariIni' => TransaksiSetoran::whereDate('created_at', today())->count(),
            ]);
        });

        // 2. Data untuk Halaman Data Sampah/Kategori (image_91e6c1.png)
        View::composer('admin.kategori.index', function ($view) {
            $kategoris = KategoriSampah::all();
            $view->with([
                'totalJenis'     => $kategoris->count(),
                'stokTerbanyak'  => $kategoris->max('stok'),
                'rataRataHarga'  => $kategoris->avg('harga'),
                'updateTerakhir' => $kategoris->sortByDesc('updated_at')->first()
            ]);
        });
    }
}