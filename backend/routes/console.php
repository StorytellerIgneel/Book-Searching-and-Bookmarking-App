<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Allow requests from any origin
// header("Access-Control-Allow-Origin: *");
// // Allow certain HTTP methods
// header("Access-Control-Allow-Methods: POST, OPTIONS");
// // Allow certain headers
// header("Access-Control-Allow-Headers: Content-Type");
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
