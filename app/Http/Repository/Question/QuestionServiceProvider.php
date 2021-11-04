<?php

namespace App\Http\Repository\Question;

use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Question\QuestionInterface',
            'App\Http\Repository\Question\QuestionRepository'
        );
    }
}
