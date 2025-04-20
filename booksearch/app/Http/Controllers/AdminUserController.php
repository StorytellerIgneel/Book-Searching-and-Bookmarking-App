<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::denies('access-admin')) {
                abort(403, 'Unauthorized action');
            }

            return $next($request);
        });
    }

    public function viewUsers()
    {
        // Get all users with pagination
        $user = User::paginate(6); // Show 6 users per page
        return view('users', ['users' => $user]); // Return the view with users data    
    }

    public function toggleAdmin(User $user)
    {
        $user->update([
            $user->is_admin = !$user->is_admin,
        ]);
        $user->save();

        return back()->with('success_message', 'Admin status updated successfully');
    }
}