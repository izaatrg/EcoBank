<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{
    /**
     * Menampilkan view desain tabel Data Mahasiswa.
     */
    public function getTabel()
    {
        // View akan berada di resources/views/latihan/tabel.blade.php
        return view('latihan.tabel');
    }

    /**
     * Menampilkan view desain form input Data Mahasiswa.
     */
    public function getForm()
    {
        // View akan berada di resources/views/latihan/form.blade.php
        return view('latihan.form');
    }
}
