<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Show the user's profile
    public function show(Request $request){
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    // Show the form for editing the user's profile
    public function edit(Request $request){
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // Handle user's request to update profile
    public function update(Request $request){
        dd('Update request received');
    }    
}
