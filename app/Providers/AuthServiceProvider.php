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

        $gate->define('manage-news', function () {
            $roles = session('roles');
            if(isset($roles)) {
                foreach($roles as $role) {
                    if($role->name == "newsmanager") {
                        return true;
                    }
                }
            }
            return false;
        });

        $gate->define('manage-gamedays', function () {
            $roles = session('roles');
            if(isset($roles)) {
                foreach($roles as $role) {
                    if($role->name == "gamedaymanager") {
                        return true;
                    }
                }
            }
            return false;
        });

        $gate->define('manage-users', function () {
            $roles = session('roles');
            if(isset($roles)) {
                foreach($roles as $role) {
                    if($role->name == "usermanager") {
                        return true;
                    }
                }
            }
            return false;
        });

        $gate->define('manage-playercards', function () {
            $roles = session('roles');
            if(isset($roles)) {
                foreach($roles as $role) {
                    if($role->name == "playercardmanager") {
                        return true;
                    }
                }
            }
            return false;
        });

        $gate->define('manage-permissions', function () {
            $roles = session('roles');
            if(isset($roles)) {
                foreach($roles as $role) {
                    if($role->name == "permissionmanager") {
                        return true;
                    }
                }
            }
            return false;
        });

        $gate->define('view-statistics', function () {
            $roles = session('roles');
            if(isset($roles)) {
                foreach($roles as $role) {
                    if($role->name == "statisticviewer") {
                        return true;
                    }
                }
            }
            return false;
        });

        $gate->define('troubleshoot', function () {
            $roles = session('roles');
            if(isset($roles)) {
                foreach($roles as $role) {
                    if($role->name == "troubleshooter") {
                        return true;
                    }
                }
            }
            return false;
        });

        $gate->define('have-a-role', function () {
            if(Auth::check()) {
                $roles = session('roles');
                if(count($roles) > 0) {
                    return true;
                }
            }
            return false;
        });

    }
}
