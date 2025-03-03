<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");
// Allow certain HTTP methods
header("Access-Control-Allow-Methods: POST, OPTIONS");
// Allow certain headers
header("Access-Control-Allow-Headers: Content-Type");
Route::get('/users', function () {
    return response()->json([
        ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
        ["id" => 2, "name" => "Jane Doe", "email" => "jane@example.com"]
    ]);
});
