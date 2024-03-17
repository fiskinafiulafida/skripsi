<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Register;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
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

        return redirect('user')->with('toast_success', 'Data User Berhasil Ditambahkan');
    }

    public function edit(User $user)
    {
        $role = User::all();
        return view('user.edit', compact('user', 'role'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'role'          => 'required',
        ]);

        $user->update([
            'name'          => $request->name,
            'email'        => $request->email,
            'role'        => $request->role,
        ]);

        $user = User::findOrFail($user->id);

        if ($user) {
            //redirect dengan pesan sukses
            return redirect('user')->with('toast_success', 'Data Berhasil Diupdate');
        } else {
            //redirect dengan pesan error
            return redirect('user')->with('toast_error ', 'Data Gagal Diupdate');
        }
    }
}
