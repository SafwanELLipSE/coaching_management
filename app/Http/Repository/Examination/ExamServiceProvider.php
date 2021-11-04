<?php

namespace App\Http\Repository\Examination;

use Illuminate\Support\ServiceProvider;

class ExamServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Examination\ExamInterface',
            'App\Http\Repository\Examination\ExamRepository'
        );
    }
}
