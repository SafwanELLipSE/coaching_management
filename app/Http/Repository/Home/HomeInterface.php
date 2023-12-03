<?php

namespace App\Http\Repository\Home;

interface HomeInterface
{
    public function studentCount();
    public function teacherCount();
    public function classesCount();
    public function classroomCount();
    public function courseCount();
    public function examinationCount();
    public function questionCount();
    public function gradeCount();
}
