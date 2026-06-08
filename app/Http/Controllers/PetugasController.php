<?php

namespace App\Http\Controllers;

class PetugasController extends Controller
{
    public function dashboard()
    {
        return view('petugas.dashboard');
    }
}