<?php

namespace App\Providers;

use App\Models\Book;
use App\Policies\BookPolicy;
use App\Models\Author;
use App\Policies\AuthorPolicy;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        Book::class => BookPolicy::class,
        Author::class => AuthorPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('access-admin', function ($user) {
            return $user->is_admin;
        });
    }
}

?>