<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use App\Models\Produksi;
use App\Models\TahunProduksi;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $kandangAyam = Kandang::all();
        $tahunProduksi = TahunProduksi::all();
        $user = DB::table('users')->count();
        $tahun = DB::table('tahun_produksi')->count();
        $kandang = DB::table('kandang')->count();
        return view('Admin.dashboard', compact('user', 'tahun', 'kandang', 'tahunProduksi', 'kandangAyam'));
    }

    public function getChartData(Request $request)
    {

        $tahunProduksi = $request->input('tahun');
        $kandang = $request->input('kandang');

        $data = Produksi::where('tahunProduksi_id', $tahunProduksi)->where('namakandang_id', $kandang)->get();

        return response()->json($data);
    }
}
