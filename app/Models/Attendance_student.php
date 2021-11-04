<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance_student extends Model
{
    protected $table = 'attendance_students';

    static public function checkStudentAttendance($id)
    {
        return self::where('student_id', $id)->where('date', Carbon::now()->format('Y-m-d'))->first();
    }
}
