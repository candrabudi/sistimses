<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        $check = Auth::user();
        if(!empty($check)) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Maaf Email Tidak Terdaftar.',
        ])->onlyInput('email');

    } 

    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }
}
