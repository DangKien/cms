<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FrontendProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Menu', function ($app) {
            return new \App\Libs\Providers\Frontend\Menu();
        });

        $this->app->singleton('Home', function ($app) {
            return new \App\Libs\Providers\Frontend\Home();
        });

        $this->app->singleton('News', function ($app) {
            return new \App\Libs\Providers\Frontend\News();
        });

        $this->app->singleton('Setting', function ($app) {
            return new \App\Libs\Providers\Frontend\Setting();
        });

        $this->app->singleton('TagFrontend', function ($app) {
            return new \App\Libs\Providers\Frontend\Tag();
        });

        $this->app->singleton('CountView', function ($app){
            return new \App\Libs\Providers\Frontend\CountView();
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        return ['Menu', 'Home', 'News', 'Setting', 'TagFrontend'];
    }
}
