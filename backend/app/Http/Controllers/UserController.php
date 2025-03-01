<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index($user){
        return response()->json([
            "user" => $user,
            "message" => "Hello from controller",
            "name" => "ABC",
            "age" => 440
        ]);
    }
    public function loadView($user){
        $data=["1", "2", "3"];
        return view("user",["user"=>$user, "users"=>$data]);
    }
    public function test(){
        return response()->json([
            "test" => "Hello from controller",
        ]);
    }
}
