<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Attendance\Teacher\TAttendanceInterface;
use App\Http\Repository\Teacher\TeacherInterface;
use PDF;
class TeacherAttendanceController extends Controller
{
    public function __construct(TAttendanceInterface $teacherAttendanceRepository, TeacherInterface $teacherRepository)
    {
        $this->teacherAttendanceRepository = $teacherAttendanceRepository;
        $this->teacherRepository = $teacherRepository;
    }
    public function index(){
        return view('attendance.teacher.teacher_attendance',[
            'count' => $this->teacherRepository->count(),
            'weeklyHoliday' => $this->teacherAttendanceRepository->weeklyHoliday(),
            'teachers' => $this->teacherRepository->all(),
        ]);
    }
    public function storeTeacherAttendance(Request $request){
        $this->teacherAttendanceRepository->store($request);
        return redirect()->back();
    }
    public function displayAttendanceTeacher($id){
        return view('attendance.teacher.teacher_attendance_view', [
            'attendedTeachers' => $this->teacherAttendanceRepository->teacherAttendance($id),
            'teacher' => $this->teacherRepository->get($id),
        ]);
    }
    public function monthlyReportTeacher(Request $request){
        $report = $this->teacherAttendanceRepository->generateMonthlyAttendanceReport($request);
        $pdf = PDF::loadView('attendance.teacher.teacher_report_attendance', [
            'report' => $report
        ])->setPaper('A4', 'landscape');
        return $pdf->download('teacher_attendance_'. $request->post('teacher_id') .'.pdf');
    }
}
