<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance_teacher extends Model
{
    protected $table = 'attendance_teachers';

    static public function checkTeacherAttendance($id){
        return Attendance_teacher::where('teacher_id', $id)->where('date', Carbon::now()->format('Y-m-d'))->first();
    }
}
