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
