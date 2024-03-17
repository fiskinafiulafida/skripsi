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
        // $penghitungans1 = $this->hitungs1($dataAktual);

        // echo "<pre>";
        // print_r($penghitungans1);
        // echo "</pre>";

        // return view('peramalan.index', compact('kandangs', 'kandang', 'dataAktual', 'penghitunganTelur', 'penghitungans1'));
        return view('peramalan.index', compact('kandangs', 'kandang', 'dataAktual', 'penghitunganTelur'));
    }

    public function hitung($dataAktual)
    {
        $jumlahSemuaTelur = 0;

        foreach ($dataAktual as $key => $produksi) {
            $jumlahSemuaTelur += $produksi->jumlah;
        }

        return $jumlahSemuaTelur;
    }

    // public function hitungs1($dataAktual)
    // {
    //     $jumlahs1 = [];
    //     $a = 0.5;

    //     foreach ($dataAktual as $key => $produksi) {
    //         $j = ($produksi->jumlah * $a) + (1 - $a);
    //         if (count($jumlahs1) > 1)
    //             $j = ($produksi->jumlah * $a) + ((1 - $a) * ($jumlahs1[$key - 1]));
    //         $jumlahs1[] = $j;
    //     }

    //     return $jumlahs1;
    // }
}
