<?php

namespace App\Http\Repository\Attendance\Student;

use Illuminate\Support\ServiceProvider;

class SAttendanceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Http\Repository\Attendance\Student\SAttendanceInterface',
            'App\Http\Repository\Attendance\Student\SAttendanceRepository'
        );
    }
}
