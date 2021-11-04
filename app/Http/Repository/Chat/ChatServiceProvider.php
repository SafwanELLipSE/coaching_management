<?php

namespace App\Http\Repository\Chat;

use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Chat\ChatInterface',
            'App\Http\Repository\Chat\ChatRepository'
        );
    }
}
