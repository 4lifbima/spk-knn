<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\HistoryKnn;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalData = Inventaris::count();
        $layak = Inventaris::where('status', 'Layak')->count();
        $ganti = Inventaris::where('status', 'Perlu Diganti')->count();
        $kValue = 3;

        return view('dashboard.index', compact('totalData', 'layak', 'ganti', 'kValue'));
    }
}