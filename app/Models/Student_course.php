<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
class Student_course extends Model
{
    protected $table = 'student_courses';

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
