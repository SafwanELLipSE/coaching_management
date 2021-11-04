<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Grade\GradeInterface;
use App\Http\Repository\StudentGrading\StudentGradeInterface;
use App\Http\Repository\Classroom\ClassroomInterface;

class StudentGradeController extends Controller
{
    public function __construct(GradeInterface $gradeRepository, StudentGradeInterface $studentGradeRepository, ClassroomInterface $classroomRepository)
    {
        $this->gradeRepository = $gradeRepository;
        $this->studentGradeRepository = $studentGradeRepository;
        $this->classroomRepository = $classroomRepository;
    }
    public function index($id)
    {
        return view('grades.student.student_grading', [
            'id' => $id,
            'examinations' => $this->classroomRepository->listOfExams($id),
            'grades' => $this->gradeRepository->all(),
        ]);
    }
    public function gradeEstimation(Request $request){
        return response()->json($this->studentGradeRepository->determineGrade($request));
    }
}
