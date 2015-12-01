<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        $gate->before(function ($user, $ability) {

            if ($user->is('admin')) {
                return true;
            }
        });

        $gate->define('edit-permission', function ($user, $permission) {
            if ($user->permissions->contains($permission->id)) {
                return $user->permissions->find($permission->id)->pivot->is_master;
            }
            return false;
        });

        $gate->define('edit-profile', function ($user, $profile) {

            if ($user->id == $profile->id) {
                return true;
            }

            return false;
        });

    }
}
