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
        ]);

        Register::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
        ]);

        return redirect('/')->with('toast_success', 'Register Anda Berhasil');
    }
}
