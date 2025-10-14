<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
    public function showForm(){
        return view('auth.register');
    }

      public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/register')->with('success', 'Usuario registrado correctamente.');
    }
}
