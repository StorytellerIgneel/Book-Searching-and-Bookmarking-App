<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// // Allow requests from any origin
// header("Access-Control-Allow-Origin: *");
// // Allow certain HTTP methods
// header("Access-Control-Allow-Methods: POST, OPTIONS");
// // Allow certain headers
// header("Access-Control-Allow-Headers: Content-Type");

Route::post("/loginUser", [AuthController::class, "loginUser"]);
Route::post("/registerNewUser", [AuthController::class, "registerNewUser"]);

Route::get('/users', function () {
    return response()->json([
        ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
        ["id" => 2, "name" => "Jane Doe", "email" => "jane@example.com"]
    ]);
});
Route::get('/test2', function () {
    return response()->json(["test" => "Hello from backend bruh"]);
});