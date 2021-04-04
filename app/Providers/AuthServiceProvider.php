<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\PostPolicy;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

         Gate::resource('posts', PostPolicy::class);
         Gate::define('posts.tag', [PostPolicy::class, 'tag']);
         Gate::define('posts.category', [PostPolicy::class, 'category']);
         Gate::resource('posts.user', PostPolicy::class);


    }
}
