<?php

namespace App\Http\Repository\Student;

interface StudentInterface
{
    public function all();
    public function get($id);
    public function getAssignedCourses($id);
    public function getAvailableCourses($id);
    public function count();
    public function store($request);
    public function list($request);
    public function update($request);
    public function delete($id);
    public function assignNewCourses($request);
    public function removeCoursesFromStudent($id);
}
