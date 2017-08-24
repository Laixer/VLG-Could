<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

use VLG\GSSAuth\PortalUserProvider;
use VLG\GSSAuth\PortalGuard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Auth::provider('portal', function($app, array $config) {
            return new PortalUserProvider;
        });

        Auth::extend('portal', function($app, $name, array $config) {
            return new PortalGuard(Auth::createUserProvider($config['provider']));
        });
    }
}
