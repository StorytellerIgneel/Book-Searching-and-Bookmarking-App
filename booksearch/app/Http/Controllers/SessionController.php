<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    // Log in user
    public function store(Request $request){ 
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (! Auth::attempt($credentials, $request->get('remember_me'))) {
            throw ValidationException::withMessages([
                'username' => 'Sorry, those credentials do not match.',
            ]);
        }
        $request->session()->regenerate();
        return redirect('/');
    }

    // Log out
    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
