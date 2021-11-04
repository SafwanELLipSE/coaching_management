<?php

namespace App\Http\Repository\Attendance\Teacher;

use App\Models\Teacher;
use App\Models\Attendance_teacher;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class TAttendanceRepository implements TAttendanceInterface
{
    public function all(){
        return Attendance_teacher::all();
    }
    public function get($id){
        return Attendance_teacher::find($id);
    }
    public function weeklyHoliday(){
        $days = Carbon::now()->daysInMonth;
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $count = 0;
        for ($i = 1; $i <= $days; $i++) {
            $dayName = now()->setYear($currentYear)->setMonth($currentMonth)->setDay($i)->format('l');
            if (($dayName != "Friday") && ($dayName != "Saturday")) {
                $attendanceDates[] = $dayName;
                $count++;
            }
        }
        return $days - $count;
    }
    public function count()
    {
    }
    public function store($request)
    {
        $present_teachers = $request->post();
        //for late attendance 
        foreach($present_teachers as $teacher){
            $array[] = $teacher;
        }

        for ($i = 1; $i < count($array); $i++) {
            $separate = explode(",", $array[$i]);
            $attendance = new Attendance_teacher;
            $attendance->teacher_id = $separate[0];
            $attendance->date = now();
            $attendance->status = $separate[1];
            $attendance->save();
        }

        Alert::success('Success', 'Successfully Teacher Attendance has been submitted.');
    }
    public function teacherAttendance($id){
        $allAttendedForAStudent = Attendance_teacher::where('teacher_id', $id)->get();
        $data = array();
        foreach ($allAttendedForAStudent as $student) {
            if ($student->status == "P") {
                $status = 'Present';
                $background = '#51b54e';
                $border = '#377530';
            } elseif ($student->status == "L") {
                $status = 'Late';
                $background = '#e3c652';
                $border = '#c2a800';
            } elseif ($student->status == "A") {
                $status = 'Absent';
                $background = '#eb6359';
                $border = '#993c36';
            }
            $localArray = [
                'title' => $status,
                'start' => $student->date,
                'allDay' => true,
                'backgroundColor' => $background,
                'borderColor' => $border,
            ];
            $data[] = $localArray;
        }
        $json = json_encode($data);
        return $json;
    }
    public function generateMonthlyAttendanceReport($request){
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required',
            'month' => 'required',
            'year' => 'required|min:4|numeric',
        ]);

        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $teacherID = $request->post('teacher_id');
        $month = $request->post('month');
        $year = $request->post('year');

        $daysInAMonth = Carbon::create($year, $month)->daysInMonth;
        $workingDays = 0;
        for ($i = 1; $i <= $daysInAMonth; $i++) {
            $dayName = now()->setYear($year)->setMonth($month)->setDay($i)->format('l');
            if (($dayName != "Friday") && ($dayName != "Saturday")) {
                $attendanceDates[] = $dayName;
                $workingDays++;
            }
        }
        $getAttendance = Attendance_teacher::where('teacher_id', $teacherID)
                    ->whereYear('date',$year)->whereMonth('date', $month)
                    ->get();
        $teacher = Teacher::find($teacherID);
            
        return [
            'month' => $month,
            'year' => $year,
            'weekends' => $daysInAMonth - $workingDays,
            'daysInAMonth' => $daysInAMonth,
            'workingDays' => $workingDays,
            'getAttendance' => $getAttendance,
            'teacher' => $teacher,
        ];
    }
    public function list($request)
    {
    }
    public function update($request)
    {
    }
    public function delete($id)
    {
    }
}
