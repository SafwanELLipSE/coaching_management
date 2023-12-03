<?php

namespace App\Http\Repository\Home;

use Illuminate\Support\ServiceProvider;

class HomeRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Home\HomeInterface',
            'App\Http\Repository\Home\HomeRepository'
        );
    }
}
