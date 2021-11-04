<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Attendance\Student\SAttendanceInterface;
use App\Http\Repository\Classroom\ClassroomInterface;
use App\Http\Repository\Student\StudentInterface;
use PDF;
class StudentAttendanceController extends Controller
{
    public function __construct(SAttendanceInterface $studentAttendanceRepository, ClassroomInterface $classroomRepository, StudentInterface $studentRepository)
    {
        $this->studentAttendanceRepository = $studentAttendanceRepository;
        $this->classroomRepository = $classroomRepository;
        $this->studentRepository = $studentRepository;
    }
    public function index()
    {
        return view('attendance.student.student_attendance',[
            'classrooms' => $this->classroomRepository->all(),
        ]);
    }
    public function listOfAttendance(Request $request){
        echo $this->studentAttendanceRepository->list($request);
    }
    public function storeStudentAttendance(Request $request){
        $this->studentAttendanceRepository->store($request);
        return redirect()->back();
    }
    public function classroomInformation(Request $request)
    {
        echo $this->studentAttendanceRepository->classroomDetails($request);
    }
    public function displayAttendanceStudent($id){
        return view('attendance.student.student_attendance_view',[
            'attendedStudents' => $this->studentAttendanceRepository->studentAttendance($id),
            'student' => $this->studentRepository->get($id),
        ]);
    }
    public function monthlyReportStudent(Request $request)
    {
        $report = $this->studentAttendanceRepository->generateMonthlyAttendanceReport($request);
        $pdf = PDF::loadView('attendance.student.student_report_attendance', [
            'report' => $report
        ])->setPaper('A4', 'landscape');
        return $pdf->download('student_attendance_' . $request->post('student_id') . '.pdf');
    }
}
