<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    public function index() {
        $kategoris = KategoriSampah::all();
        return view('admin.kategori.index', compact('kategoris'));
    }
}