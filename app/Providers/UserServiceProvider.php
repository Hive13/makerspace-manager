<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use App\Models\Role;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //Every new user will add admin as friend. Admin can choose to accept/deny
        User::created(function ($user) {
            $admins = Role::where('name', 'admin')->get()->first()->users;
            foreach ($admins as $admin) {
                $user->befriend($admin);
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
