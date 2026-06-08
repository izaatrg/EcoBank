<?php

namespace App\Http\Controllers;

class WargaController extends Controller
{
    public function dashboard()
    {
        return view('warga.dashboard');
    }
}