<?php

namespace App\Http\Repository\Student;

use Illuminate\Support\ServiceProvider;

class StudentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Student\StudentInterface',
            'App\Http\Repository\Student\StudentRepository'
        );
    }
}
