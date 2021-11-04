<?php

namespace App\Http\Repository\Attendance\Teacher;

use Illuminate\Support\ServiceProvider;

class TAttendanceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Attendance\Teacher\TAttendanceInterface',
            'App\Http\Repository\Attendance\Teacher\TAttendanceRepository'
        );
    }
}
