<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerPurchase(string $type){
        return view('register-form',['type' => $type]);
    }

    public function registerViewer(string $type){
        return view('register-form',['type' => $type]);
    }
    public function registerUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'user_type' => $request->userType
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('dashboard')->with('success','You have successfully registered & logged in!');
        }

        return back()->withErrors(['email' => 'Login failed after registration.']);
    }

}
