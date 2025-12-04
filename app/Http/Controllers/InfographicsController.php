<?php

namespace App\Http\Controllers;

use App\Models\Infographic;
use Illuminate\Http\Request;

class InfographicsController extends Controller
{
    public function index()
    {
        $datas = Infographic::orderBy('published_at', 'DESC')->paginate(12);

        return view('infographics.index', compact('datas'));
    }
}
