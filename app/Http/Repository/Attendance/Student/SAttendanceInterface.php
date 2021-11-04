<?php

namespace App\Http\Repository\Attendance\Student;

interface SAttendanceInterface
{
    public function all();
    public function get($id);
    public function count();
    public function store($request);
    public function list($request);
    public function classroomDetails($request);
    public function studentAttendance($id);
    public function generateMonthlyAttendanceReport($request);
    public function update($request);
    public function delete($id);
}
