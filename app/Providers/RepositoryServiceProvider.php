<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\ApisConfigRepository::class, \App\Repositories\ApisConfigRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ApisConfigsRepository::class, \App\Repositories\ApisConfigsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TesteEmersonRepository::class, \App\Repositories\TesteEmersonRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmersonTesteRepository::class, \App\Repositories\EmersonTesteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EmersonTestesRepository::class, \App\Repositories\EmersonTestesRepositoryEloquent::class);
        //:end-bindings:
    }
}
