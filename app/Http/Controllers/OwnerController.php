<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->count();
        $tahun = DB::table('tahun_produksi')->count();
        $kandang = DB::table('kandang')->count();
        return view('owner.dashboard', compact('user', 'tahun', 'kandang'));
    }
}
