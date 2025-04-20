<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    // Store user info
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:30', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users',],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->max(30)->mixedCase()->numbers()->symbols()->uncompromised(),
            ],
            'profile_picture' => [
                'nullable',
                File::image()->min('1kb')->max('10mb'),
                Rule::dimensions()->maxHeight(1000)->maxWidth(1000),
            ],
            'date_of_birth' => [
                'required',
                'date',
                Rule::date()->format('Y-m-d')->beforeOrEqual(
                    today() //->subYear(18) 
                ),
            ],
            'phone' => ['nullable', 'string', 'regex:/^01[0-46-9]-?[0-9]{7,8}$/'],
        ]);

        $validated['password'] = Hash::make($request->password);

        // Store the profile picture if provided
        if ($request->hasFile('profile_picture')) {
            $profileImagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_image_link'] = 'storage/' . $profileImagePath;
        }

        $user = User::create($validated);

        Auth::login($user);

        return redirect('/')->with('success_message', 'Profile created successfully.');
    }

    public function viewUsers()
    {
        $user = User::paginate(6); // Show 6 users per page
        return view('users', ['users' => $user]); // Return the view with users data    
    }
}
