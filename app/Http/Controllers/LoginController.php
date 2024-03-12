<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function login()
    {
        return view('LogReg.Login');
    }

    public function dologin(Request $request)
    {
        // validasi
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role === 'admin') {
                // jika user admin
                return redirect()->intended('/dashboardAdmin');
            }
            if (auth()->user()->role === 'owner') {
                // jika user pemilik dan owner
                return redirect()->intended('/dashboardowner');
            } else {
                // jika user tidak memiliki role user
                return redirect()->intended('/');
            }
        }
        // kirimkan session error
        return back()->with('error', 'Email atau Password Anda Salah');
    }

    public function cek()
    {
        if (auth()->user()->role === 'admin') {
            return redirect('/dashboardAdmin');
        }
        if (auth()->user()->role === 'owner') {
            return redirect('/owner');
        } else {
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
