<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kandang;
use DB;

class PeramalanController extends Controller
{
    public function index()
    {
        $kandangs = Kandang::all();
        $kandang = DB::table('kandang')->count();
        $periode = DB::table('produksi_telur');
        return view('peramalan.index', compact('kandangs', 'kandang', 'periode'));
    }

    // public function hitung(){

    // }
}
