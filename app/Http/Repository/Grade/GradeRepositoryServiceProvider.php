<?php

namespace App\Http\Repository\Grade;

use Illuminate\Support\ServiceProvider;

class GradeRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Grade\GradeInterface',
            'App\Http\Repository\Grade\GradeRepository'
        );
    }
}
