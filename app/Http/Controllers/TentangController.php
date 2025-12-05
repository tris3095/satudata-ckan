<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    public function profil()
    {
        return view('tentang.profil');
    }

    public function struktur()
    {
        return view('tentang.struktur');
    }
}
