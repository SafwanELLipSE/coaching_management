<?php

namespace App\Http\Repository\StudentGrading;

use Illuminate\Support\ServiceProvider;

class StudentGradeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\StudentGrading\StudentGradeInterface',
            'App\Http\Repository\StudentGrading\StudentGradeRepository'
        );
    }
}
