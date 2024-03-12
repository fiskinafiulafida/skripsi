<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function edit(Register $profile)
    {
        $profile = Register::count();
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request, Register $profile)
    {
        $this->validate($request, [
            'name' => '',
            'email' => '',
        ]);

        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->save();

        return redirect('/profile')->with('success', 'Profile Updated');
    }
}
