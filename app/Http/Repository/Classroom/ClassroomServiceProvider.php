<?php

namespace App\Http\Repository\Classroom;

use Illuminate\Support\ServiceProvider;

class ClassroomServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Classroom\ClassroomInterface',
            'App\Http\Repository\Classroom\ClassroomRepository'
        );
    }
}
