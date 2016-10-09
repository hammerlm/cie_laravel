<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('authenticate', function () {
            return Auth::check();
        });

        $gate->define('manage-news', function ($user) {


            return true;
        });

        $gate->define('manage-gamedays', function ($user) {

            return true;
        });

        $gate->define('manage-users', function ($user) {

            return true;
        });

        $gate->define('manage-playercards', function ($user) {

            return true;
        });

        $gate->define('manage-permissions', function ($user) {

            return true;
        });

        // $gate->define('view-statistics', function ($user) {

           // return true;
        // });

    }
}
