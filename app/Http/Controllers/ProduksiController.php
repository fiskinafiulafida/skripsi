<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Kandang;
use App\Models\TahunProduksi;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function index()
    {
        $kandangs = Kandang::all();
        $produksi = Produksi::latest()->with(['kandang', 'tahunProduksi'])->get();
        return view('produksiTelur.index', compact('produksi', 'kandangs'));
    }

    // fungsi untuk filter data kandang ayam
    public function filter(Request $request)
    {
        $filterValue = $request->input('filter');

        // Filter data based on $filterValue
        if ($filterValue === 'all') {
            $kandangs = Kandang::all();
        } else {
            $kandangs = Kandang::where('namakandang_id', $filterValue)->get();
        }

        return view('produksiTelur.index', compact('kandangs'));
    }

    public function create()
    {
        $kandangs = Kandang::all();
        $tahunProduksi = TahunProduksi::all();
        return view('produksiTelur.create', compact('tahunProduksi', 'kandangs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'namakandang_id'       => 'required',
            'tahunProduksi_id'     => 'required',
            'bulan'                => 'required',
            'jumlah'               => 'required',
        ]);

        $produksi = Produksi::create([
            'namakandang_id'      => $request->namakandang_id,
            'tahunProduksi_id'    => $request->tahunProduksi_id,
            'bulan'               => $request->bulan,
            'jumlah'              => $request->jumlah,
        ]);

        if ($produksi) {
            //redirect dengan pesan sukses
            return redirect('produksiTelur')->with('toast_success', 'Data Berhasil Tersimpan');
        } else {
            //redirect dengan pesan error
            return redirect('produksiTelur')->with('toast_error ', 'Data Gagal Tersimpan');
        }
    }

    public function edit(Produksi $produksiTelur)
    {
        $kandangs = Kandang::all();
        $tahunProduksi = TahunProduksi::all();
        return view('produksiTelur.edit', compact('produksiTelur', 'tahunProduksi', 'kandangs'));
    }

    public function update(Request $request, Produksi $produksiTelur)
    {
        $this->validate($request, [
            'namakandang_id'       => 'required',
            'tahunProduksi_id'     => 'required',
            'bulan'                => 'required',
            'jumlah'               => 'required',
        ]);

        $produksiTelur->update([
            'namakandang_id'          => $request->namakandang_id,
            'tahunProduksi_id'        => $request->tahunProduksi_id,
            'bulan'                   => $request->bulan,
            'jumlah'                  => $request->jumlah,
        ]);

        $produksiTelur = Produksi::findOrFail($produksiTelur->id);

        if ($produksiTelur) {
            //redirect dengan pesan sukses
            return redirect('produksiTelur')->with('toast_success', 'Data Berhasil Diupdate');
        } else {
            //redirect dengan pesan error
            return redirect('produksiTelur')->with('toast_error ', 'Data Gagal Diupdate');
        }
    }


    public function destroy($id)
    {
        $produksi = Produksi::findOrFail($id);
        $produksi->delete();

        if ($produksi) {
            //redirect dengan pesan sukses
            return redirect('produksiTelur')->with('toast_success', 'Data Berhasil Dihapus');
        } else {
            //redirect dengan pesan error
            return redirect('produksiTelur')->with('toast_error ', 'Data Gagal Dihapus');
        }
    }
}
