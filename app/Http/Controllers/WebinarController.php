<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function index()
    {
        $datas = Webinar::orderBy('created_at', 'DESC')->paginate(12);

        return view('webinar.index', compact('datas'));
    }
}
