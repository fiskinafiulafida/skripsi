<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $tahun = DB::table('tahun_produksi')->count();
        $kandang = DB::table('kandang')->count();
        return view('owner.dashboard', compact('tahun', 'kandang'));
    }
}
