<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use Illuminate\Http\Request;
use App\Models\Register;

class ProfController extends Controller
{
    public function index()
    {
        return view('owner.profile.index');
    }

    public function edit(Register $profilePemilik)
    {
        $produksi = Produksi::count();
        return view('owner.profile.edit', compact('profilePemilik', 'produksi'));
    }

    public function update(Request $request, Register $profilePemilik)
    {
        $this->validate($request, [
            'name' => '',
            'email' => '',
        ]);

        $profilePemilik->name = $request->input('name');
        $profilePemilik->email = $request->input('email');
        $profilePemilik->save();

        return redirect('/profilePemilik')->with('success', 'Data Profile Telah Diupdate');
    }
}
