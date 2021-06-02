<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\UserEventsPosts;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-only', function($user){
            if($user->isAdmin == 1){
                return true;
            }
            return false;
        });

        Gate::define('non-verified-users', function($user){
            if($user->email_verified_at == NULL){
                return true;
            }

            return false;
        });

        Gate::define('allow-update', function($user, $post_info){

            if($user->id == $post_info[0]->user_id){
                return true;
            }
            return false;
        });

    }
}
