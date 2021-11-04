<?php

namespace App\Http\Repository\Attendance\Teacher;

interface TAttendanceInterface
{
    public function all();
    public function get($id);
    public function weeklyHoliday();
    public function count();
    public function store($request);
    public function list($request);
    public function update($request);
    public function teacherAttendance($id);
    public function generateMonthlyAttendanceReport($request);
    public function delete($id);
}
