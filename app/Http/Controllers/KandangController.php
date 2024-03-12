<?php

namespace App\Http\Controllers;

use App\Models\Kandang;
use Illuminate\Http\Request;

class KandangController extends Controller
{
    public function index()
    {
        $kandangs = Kandang::latest()->get();
        return view('admin.kandang.index', compact('kandangs'));
    }

    public function create()
    {
        return view('admin.kandang.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kandang'          => 'required',
            'keterangan_kandang'    => 'required',
        ]);

        $kandang = Kandang::create([
            'nama_kandang'          => $request->nama_kandang,
            'keterangan_kandang'    => $request->keterangan_kandang,
        ]);

        if ($kandang) {
            //redirect dengan pesan sukses
            return redirect('kandangAdmin')->with('toast_success', 'Data Berhasil Disimpan');
        } else {
            //redirect dengan pesan error
            return redirect('kandangAdmin')->with('toast_error', 'Data Gagal Disimpan');
        }
    }

    public function edit(Kandang $kandangAdmin)
    {
        return view('admin.kandang.edit', compact('kandangAdmin'));
    }

    public function update(Request $request, Kandang $kandangAdmin)
    {
        $this->validate($request, [
            'nama_kandang'          => 'required',
            'keterangan_kandang'    => 'required',
        ]);

        $kandangAdmin->update([
            'nama_kandang'          => $request->nama_kandang,
            'keterangan_kandang'    => $request->keterangan_kandang,
        ]);

        $kandangAdmin = Kandang::findOrFail($kandangAdmin->id);

        if ($kandangAdmin) {
            //redirect dengan pesan sukses
            return redirect('kandangAdmin')->with('toast_success', 'Data Berhasil Diupdate');
        } else {
            //redirect dengan pesan error
            return redirect('kandangAdmin')->with('toast_error', 'Data Gagal Diupdate');
        }
    }

    public function destroy($id)
    {
        $kandang = Kandang::findOrFail($id);
        $kandang->delete();

        if ($kandang) {
            //redirect dengan pesan sukses
            return redirect('kandangAdmin')->with('toast_success', 'Data Berhasil Dihapus');
        } else {
            //redirect dengan pesan error
            return redirect('kandangAdmin')->with('toast_error', 'Data Gagal Dihapus');
        }
    }
}
