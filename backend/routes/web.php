<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");
// Allow certain HTTP methods
header("Access-Control-Allow-Methods: POST, OPTIONS");
// Allow certain headers
header("Access-Control-Allow-Headers: Content-Type");

Route::get('/', function () {
    return view('welcome');
});

Route::get("/about", function(){
    return view('about');
});

Route::view ("contact", "contact"); //short syntax

Route::view ("contact", "contact"); //short syntax

Route::view("gundam", "gundam"); //short syntax
// Route::get("/{username}", function ($username){
//     return view ("welcome", ["username" => $username]);
// });

Route::get("user", [UserController::class, "loadView"]);
Route::get("testloadView/{user}", [UserController::class, "loadView"]);
Route::get("users/{user}", [UserController::class, "index"]);
Route::get('/test', function () {
    return response()->json(["test" => "Hello from backend"]);
});
Route::get('/users', function () {
    return response()->json([
        ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
        ["id" => 2, "name" => "Jane Doe", "email" => "jane@example.com"]
    ]);
});