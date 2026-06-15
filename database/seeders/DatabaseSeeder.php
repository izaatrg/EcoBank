<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriSampah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Reset Admin (Agar bisa Login)
        User::updateOrCreate(['email' => 'admin@gmail.com'], [
            'name' => 'Sebastian',
            'password' => Hash::make('12345678'), // Password: 12345678
            'role' => 'admin',
        ]);

        // 2. Isi Kategori (Sesuaikan dengan kolom 'nama' dan 'harga' di DB Anda)
        $listKategori = [
            ['nama' => 'Plastik', 'harga' => 2000, 'stok' => 0, 'kondisi' => 'tersedia'],
            ['nama' => 'Kertas', 'harga' => 1500, 'stok' => 0, 'kondisi' => 'tersedia'],
        ];

        foreach ($listKategori as $item) {
            KategoriSampah::updateOrCreate(
                ['nama' => $item['nama']], 
                ['harga' => $item['harga'], 'stok' => $item['stok'], 'kondisi' => $item['kondisi']]
            );
        }
    }
}