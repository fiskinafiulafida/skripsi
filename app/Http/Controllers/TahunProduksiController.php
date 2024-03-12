<?php

namespace App\Http\Controllers;

use App\Models\TahunProduksi;
use Illuminate\Http\Request;

class TahunProduksiController extends Controller
{
    public function index()
    {
        $tahunProduksi = TahunProduksi::latest()->get();
        return view('admin.tahunProduksi.index', compact('tahunProduksi'));
    }


    public function create()
    {
        return view('admin.tahunProduksi.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tahunProduksi'              => 'required',
        ]);

        $tahunProduksi = TahunProduksi::create([
            'tahunProduksi'             => $request->tahunProduksi,
        ]);

        if ($tahunProduksi) {
            //redirect dengan pesan sukses
            return redirect('tahunProduksiAdmin')->with('toast_success', 'Data Berhasil Disimpan');
        } else {
            //redirect dengan pesan error
            return redirect('tahunProduksiAdmin')->with('toast_error', 'Data Gagal Disimpan');
        }
    }

    public function edit(TahunProduksi $tahunProduksiAdmin)
    {
        return view('admin.tahunProduksi.edit', compact('tahunProduksiAdmin'));
    }

    public function update(Request $request, TahunProduksi $tahunProduksiAdmin)
    {
        $this->validate($request, [
            'tahunProduksi'         => 'required',
        ]);

        $tahunProduksiAdmin->update([
            'tahunProduksi'         => $request->tahunProduksi,
        ]);

        $tahunProduksiAdmin = TahunProduksi::findOrFail($tahunProduksiAdmin->id);

        if ($tahunProduksiAdmin) {
            //redirect dengan pesan sukses
            return redirect('tahunProduksiAdmin')->with('toast_success', 'Data Berhasil Diupdate');
        } else {
            //redirect dengan pesan error
            return redirect('tahunProduksiAdmin')->with('toast_error', 'Data Gagal Diupdate');
        }
    }

    public function destroy($id)
    {
        $tahunProduksi = TahunProduksi::findOrFail($id);
        $tahunProduksi->delete();

        if ($tahunProduksi) {
            //redirect dengan pesan sukses
            return redirect('tahunProduksiAdmin')->with('toast_success', 'Data Berhasil Dihapus');
        } else {
            //redirect dengan pesan error
            return redirect('tahunProduksiAdmin')->with('toast_error', 'Data Gagal Dihapus');
        }
    }
}
