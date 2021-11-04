<?php

namespace App\Http\Repository\Course;

use Illuminate\Support\ServiceProvider;

class CourseRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Course\CourseInterface',
            'App\Http\Repository\Course\CourseRepository'
        );
    }
}
