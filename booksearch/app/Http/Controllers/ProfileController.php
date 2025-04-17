<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
    public function update(Request $request)
{
    $user = $request->user();

    // Validate the request data
    $validated = $request->validate([
        'profile_picture' => ['nullable', 
            File::image()->min('1kb')->max('10mb'),
            Rule::dimensions()->maxHeight(1000)->maxWidth(1000),
        ],
        'username' => 'required|string|max:255|unique:users,username,' . $request->user()->id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
        'phone' => 'nullable|string|max:15',
    ]);

    // Handle image upload
    if ($request->hasFile('profile_picture')) {
        // Delete old image if exists
        if ($user->profile_image_link) {
            $oldPath = str_replace('storage/', '', $user->profile_image_link);
            Storage::disk('public')->delete($oldPath);
        }

        // Store new image
        $profileImagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $validated['profile_image_link'] = 'storage/' . $profileImagePath;
    }

    $user->update($validated);

    return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
}
}
