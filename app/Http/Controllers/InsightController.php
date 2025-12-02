<?php

namespace App\Http\Controllers;

use App\Models\Insights;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    public function index()
    {
        $insights = Insights::all();
        return view('insights.index', compact('insights'));
    }
}
