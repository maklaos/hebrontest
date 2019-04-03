<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\RedmineConnect;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('redmine', function () {
            return new RedmineConnect(config('redmine.redmine_api_key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
