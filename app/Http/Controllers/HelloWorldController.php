<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldController extends Controller
{
    /**
     * Mengembalikan teks sederhana.
     */
    public function index()
    {
        return "Selamat Belajar Framework Laravel 10";
    }

    /**
     * Mengembalikan view 'ambilfile.blade.php' yang ada di resources/views.
     */
    public function ambilFile()
    {
        return view('ambilfile');
    }

    /**
     * Mengembalikan view 'getlorem.blade.php' yang ada di resources/views/v_html.
     */
    public function getLorem()
    {
        return view('v_html.getlorem');
    }
}
