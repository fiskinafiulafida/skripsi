<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kandang;
use App\Models\Peramalan;
use DB;

class PeramalanController extends Controller
{
    public function index()
    {
        $kandangs = Kandang::all();
        $kandang = DB::table('kandang')->count();
        $dataAktual = DB::table('produksi_telur')->get();

        $penghitunganTelur = $this->hitung($dataAktual);
        $s2 = $this->s2($dataAktual);

        return view('peramalan.index', compact('kandangs', 'kandang', 'dataAktual', 'penghitunganTelur', 's2'));
    }

    public function hitung($dataAktual)
    {
        $jumlahSemuaTelur = 0;

        foreach ($dataAktual as $key => $produksi) {
            $jumlahSemuaTelur += $produksi->jumlah;
        }

        return $jumlahSemuaTelur;
    }

    public function s2($dataAktual)
    {
        $a = 0;

        foreach ($dataAktual as $key => $produksi) {
            $a * $dataAktual = $produksi->jumlah;
        }
        return $a;
    }
}
