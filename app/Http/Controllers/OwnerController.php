<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Kandang;
use App\Models\Produksi;
use App\Models\TahunProduksi;

class OwnerController extends Controller
{
    public function index()
    {
        $kandangAyam = Kandang::all();
        $tahunProduksi = TahunProduksi::all();
        $tahun = DB::table('tahun_produksi')->count();
        $kandang = DB::table('kandang')->count();
        return view('owner.dashboard', compact('tahun', 'kandang', 'kandangAyam', 'tahunProduksi'));
    }

    public function getChartData(Request $request)
    {

        $tahunProduksi = $request->input('tahun');
        $kandang = $request->input('kandang');

        $data = Produksi::where('tahunProduksi_id', $tahunProduksi)->where('namakandang_id', $kandang)->get();

        return response()->json($data);
    }
}
