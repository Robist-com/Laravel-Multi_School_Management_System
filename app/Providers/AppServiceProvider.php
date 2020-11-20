<?php

namespace App\Providers;

use App\Observers\SchoolObserver;
use App\School;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use \Blade;
use Illuminate\Support\Facades\Blade as FacadesBlade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        FacadesBlade::setEchoFormat('e(utf8_encode(%s))');
        School::observe(SchoolObserver::class);


    }
}
