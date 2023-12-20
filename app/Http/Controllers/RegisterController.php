<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        $request->request->add(['username' => \Str::slug($request->username)]);

        $this->validate($request, [
            'name' => ['required', 'min:1', 'max:50'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email' => ['required', 'email', 'unique:users', 'max:50'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);
//        auth()->attempt([
//            'email' => $request->email,
//            'password' => $request->password
//        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard', auth()->user()->username);
//        return view('dashboard');

    }
}
