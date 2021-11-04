<?php

namespace App\Http\Repository\Attendance\Student;

use App\Models\Classroom;
use App\Models\Classroom_students;
use App\Models\Attendance_student;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class SAttendanceRepository implements SAttendanceInterface
{
    public function all()
    {
        return Attendance_student::all();
    }
    public function get($id)
    {
        return Attendance_student::find($id);
    }
    public function count(){}
    public function list($request)
    {
        $this->valid($request);

        $classroomStudents = Classroom_students::where('classroom_id', $request->post('id'))->get();
        $classroom = Classroom::find($request->post('id'));
        $data = "";
        $count = 1;
        foreach ($classroomStudents as $classroomStudent) {
            $checker = Attendance_student::checkStudentAttendance($classroomStudent->student_id);
            $disabled = ($checker != null || !(now()->format('H') <= $classroom->start_time)) ? 'disabled' : '';
            $selectedPresent = ($checker != null && $checker->status == 'P') ? 'selected' : '';
            $selectedLate = ($checker != null && $checker->status == 'L') ? 'selected' : '';
            $selectedAbsent = ($checker != null && $checker->status == 'A') ? 'selected' : '';

            $data .= "<tr>" .
            "<td>" . $count . "</td>" .
            "<td>" . $classroomStudent->student->user->name . "</td>" .
            "<td>" . "sdasdf" . "</td>" .
            "<td>" . "<div class='form-group'>
                <select name='studentAtt{$classroomStudent->student_id}' class='form-control text-dark' style='width:20%;'>
                    <option value='' disabled selected>Select</option>
                    <option class='bg-success' value='{$classroomStudent->student_id},P'{$disabled}{$selectedPresent}>P</option>
                    <option class='bg-warning' value='{$classroomStudent->student_id},L'{$disabled}{$selectedLate}>L</option>
                    <option class='bg-danger' value='{$classroomStudent->student_id},A'{$disabled}{$selectedAbsent}>A</option>
                </select>
            </div>" . "</td>" .
            "</tr>";
            $count++;
        }
        return (($data != "") ? $data : "<td colspan='4' class='text-dark text-center'>No Student found in the Classroom<td>");
    }
    public function store($request){
        $present_students = $request->post();
        //for late attendance 
        foreach ($present_students as $student) {
            $array[] = $student;
        }

        for ($i = 1; $i < count($array); $i++) {
            $separate = explode(",", $array[$i]);
            $attendance = new Attendance_student;
            $attendance->student_id = $separate[0];
            $attendance->date = now();
            $attendance->status = $separate[1];
            $attendance->save();
        }

        Alert::success('Success', 'Successfully Classroom attendance has been submitted.');
    }
    public function classroomDetails($request){
        $this->valid($request);

        $classroom = Classroom::join('courses', 'classrooms.course_id', '=', 'courses.id')
            ->join('classes', 'classrooms.class_id', '=', 'classes.id')
            ->where('classrooms.id', $request->post('id'))
            ->select('classes.name as nameClass', 'courses.name as nameCourse','classrooms.start_time','classrooms.days', 'classrooms.enrolled', 'classrooms.capacity')
            ->first();
        return $classroom;
    }
    public function studentAttendance($id){
        $allAttendedForAStudent = Attendance_student::where('student_id', $id)->get();
        $data = array();
        foreach ($allAttendedForAStudent as $student) {
            if($student->status == "P"){
                $status = 'Present';
                $background = '#51b54e';
                $border = '#377530';
            }elseif($student->status == "L"){
                $status = 'Late';
                $background = '#e3c652';
                $border = '#c2a800';
            }elseif ($student->status == "A") {
                $status = 'Absent';
                $background = '#eb6359';
                $border = '#993c36';
            }
            $localArray=[
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
            'student_id' => 'required',
            'month' => 'required',
            'year' => 'required|min:4|numeric',
        ]);

        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $studentID = $request->post('student_id');
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
        $getAttendance = Attendance_student::where('student_id', $studentID)
            ->whereYear('date', $year)->whereMonth('date', $month)
            ->select('date','status')
            ->get();
        // dd($getAttendance);
        $student = Student::find($studentID);

        return [
            'month' => $month,
            'year' => $year,
            'weekends' => $daysInAMonth - $workingDays,
            'daysInAMonth' => $daysInAMonth,
            'workingDays' => $workingDays,
            'getAttendance' => $getAttendance,
            'student' => $student,
        ];
    }
    private function valid($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:classrooms,id',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);
    }
    public function update($request){}
    public function delete($id){}
}
