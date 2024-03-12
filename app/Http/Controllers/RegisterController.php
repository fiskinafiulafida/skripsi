<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('LogReg.Register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|max:255',
            'email'                 => 'required',
            'password'              => 'required|min:3|max:255',
            'role'                  => 'required|in:admin,owner,pegawai',
        ]);

        Register::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
            'role'                  => $request->role,
        ]);

        return redirect('/')->with('Pesan', 'Register Anda Berhasil');
    }
}
