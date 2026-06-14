<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'no_hp' => '081111111111',
            'alamat' => 'Depok'
        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'petugas',
            'no_hp' => '082222222222',
            'alamat' => 'Depok'
        ]);

        User::create([
            'name' => 'Warga',
            'email' => 'warga@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'warga',
            'no_hp' => '083333333333',
            'alamat' => 'Depok'
        ]);
    }
}