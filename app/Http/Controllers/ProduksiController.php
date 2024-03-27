<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Kandang;
use App\Models\TahunProduksi;
use Illuminate\Http\Request;
use DataTables;

class ProduksiController extends Controller
{
    public function index(Request $request)
    {

        $kandangs = Kandang::all();
        $produksi = Produksi::latest()->with(['kandang', 'tahunProduksi'])->get();
        if ($request->ajax()) {
            $data = Produksi::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('namakandang_id', function ($row) {
                    if ($row->namakandang_id) {
                        return 'Kandang 1';
                    } else {
                        return 'Kandang 2';
                    }
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('namakandang_id') == '0' || $request->get('namakandang_id') == '1') {
                        $instance->where('namakandang_id', $request->get('namakandang_id'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('bulan', 'LIKE', "%$search%")
                                ->orWhere('jumlah', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['namakandang_id'])
                ->make(true);
        }
        return view('produksiTelur.index', compact('kandangs', 'produksi'));
    }

    public function filterKandang(Request $request)
    {

        $kandangs = Kandang::all();

        $kandang = $request->input('namakandang_id');

        $produksi = Produksi::where('namakandang_id', $kandang)->get();

        return view('produksiTelur.index', compact('produksi', 'kandangs'));
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
