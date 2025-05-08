<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin(){
        return view('login');
    }


public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = Admin::where('email', $request->email)->first();

    if ($user && $user->password === hash('sha256',$request->password)) {
        Auth::guard('admin')->login($user);
        return redirect()->route('schedule.index');
    }

    return redirect()->back()->withErrors(['email' => 'Login gagal']);
}

public function logout(Request $request)
{
    Auth::guard('admin')->logout();
    return redirect()->route('schedule.index');
}


}