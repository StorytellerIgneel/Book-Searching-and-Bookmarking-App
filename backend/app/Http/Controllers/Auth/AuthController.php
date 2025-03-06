<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function registerNewUser(Request $req){
        #ensure the username is unique
        $user = User::where('username', $req->username)->first();

        if ($user) {
            return response()->json(["status"=> "failure", "message" => "Username already exists"]);
        }
        User::create([
            'username' => $req->username,
            'email' => $req->email,
            'password' => bcrypt($req->password)
        ]);
        return response()->json(["status"=> "success", "message" => "User created successfully"]);
    }

    public function loginUser(Request $req){
        // SQL equivalent: SELECT * FROM users WHERE name = ?
        $user = User::where('username', $req->username)->first();
        Log::debug("User: " . $user);
        if ($user && password_verify($req->password, $user->password)) {
            return response()->json(["status"=> "success","message" => "Login successful"]);
        } 
        else if (!password_verify($req->password, $user->password)) {
            return response()->json(["status"=> "failure","message" => "Incorrect password"]);
        }
        else {
            return response()->json(["status"=> "failure","message" => "Username not found. Login failed."]);
        }
    }
}
