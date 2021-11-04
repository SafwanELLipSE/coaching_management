<?php

namespace App\Http\Repository\Teacher;

use Illuminate\Support\ServiceProvider;

class TeacherServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Teacher\TeacherInterface',
            'App\Http\Repository\Teacher\TeacherRepository'
        );
    }
}
