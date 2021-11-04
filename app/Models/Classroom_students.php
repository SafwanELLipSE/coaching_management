<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Classroom;

class Classroom_students extends Model
{
    protected $table = 'classroom_students';
    const ACTIVE = 1;
    const INACTIVE = 0;
    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }
    public function classroom()
    {
        return $this->hasOne(Classroom::class, 'id', 'classroom_id');
    }

    public static function getStatus($status_id)
    {
        switch ($status_id) {
            case 0:
                return "<span class='badge badge-danger'> Inactive </span>";
            case 1:
                return "<span class='badge badge-success'> Active </span>";;
        }
    }
}
