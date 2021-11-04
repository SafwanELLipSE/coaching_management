<?php

namespace App\Http\Repository\Classes;

use Illuminate\Support\ServiceProvider;

class ClassRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Classes\ClassInterface',
            'App\Http\Repository\Classes\ClassRepository'
        );
    }
}
