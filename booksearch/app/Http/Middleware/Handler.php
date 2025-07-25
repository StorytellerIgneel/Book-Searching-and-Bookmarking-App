<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Auth;



class Handler extends ExceptionHandler
{

    //The unauthenticated() method is called automatically when a user who is 
    // not logged in tries to access a protected route (one that requires authentication).
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        //In this customized version, we are telling Laravel to redirect different users 
        // (admins, authors, and regular users) to the correct login page, depending on the URL they were trying to access.
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/login/admin');
        }
        if ($request->is('author') || $request->is('author/*')) {
            return redirect()->guest('/login/author');
        }
        return redirect()->guest(route('login'));
    }

    // /**
    //  * A list of the exception types that are not reported.
    //  *
    //  * @var array<int, class-string<Throwable>>
    //  */
    // protected $dontReport = [
    //     //
    // ];

    // /**
    //  * A list of the inputs that are never flashed for validation exceptions.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $dontFlash = [
    //     'current_password',
    //     'password',
    //     'password_confirmation',
    // ];

    // /**
    //  * Register the exception handling callbacks for the application.
    //  *
    //  * @return void
    //  */
    // public function register()
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });
    // }
}
