<?php
// filepath: /c:/Users/Teoh Wei Hong/Documents/Programming/Own study/web dev/laravel/AWAD_Y2S3/backend/app/Http/Middleware/CorsMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Authorization, Origin, x-csrf-token');
        //Log::debug("Cors middleware response: " . $response);

        return $response;
    }
}