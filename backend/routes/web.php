<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

// // Allow requests from any origin
// header("Access-Control-Allow-Origin: *");
// // Allow certain HTTP methods
// header("Access-Control-Allow-Methods: POST, OPTIONS");
// // Allow certain headers
// header("Access-Control-Allow-Headers: Content-Type");

Route::post("/loginUser", [AuthController::class, "loginUser"]);
Route::post("/registerNewUser", [AuthController::class, "registerNewUser"]);

Route::get('/test', function () {
    return response()->json(["test" => "Hello from backend"]);
});
Route::get('/users', function () {
    Log::debug("Cors middleware");
    return response()->json([
        ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
        ["id" => 2, "name" => "Jane Doe", "email" => "jane@example.com"]
    ]);
});