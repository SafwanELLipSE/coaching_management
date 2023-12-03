<?php

namespace App\Http\Repository\Home;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Examination;
use App\Models\Question;
use App\Models\Classes;
use App\Models\Classroom;
use App\Models\Grade;

class HomeRepository implements HomeInterface
{
    public function studentCount(){
        return Student::count();
    }

    public function teacherCount(){
        return Teacher::count();
    }

    public function classesCount(){
        return Classes::count();
    }

    public function classroomCount(){
        return Classroom::count();
    }

    public function courseCount(){
        return Course::count();
    }

    public function examinationCount(){
        return Examination::count();
    }

    public function questionCount(){
        return Question::count();
    }

    public function gradeCount(){
        return Grade::count();
    }
}
