<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Course\CourseInterface;
use App\Http\Repository\Classes\ClassInterface;
use App\Http\Repository\Student\StudentInterface;
class StudentController extends Controller
{
    public function __construct(ClassInterface $classRepository, CourseInterface $courseRepository, StudentInterface $studentRepository)
    {
        $this->classRepository = $classRepository;
        $this->courseRepository = $courseRepository;
        $this->studentRepository = $studentRepository;
    }
    public function index(){
        return view('students.create_student',[
            'classes' => $this->classRepository->all(),
            'courses' => $this->courseRepository->all(),
            'count' => $this->studentRepository->count(),
        ]);
    }
    public function store(Request $request){
        $this->studentRepository->store($request);
        return redirect()->back();
    }
    public function allStudent(){
        return view('students.all_student',[
            'classes' => $this->classRepository->all(),
        ]);
    }
    public function list(Request $request){
        echo json_encode($this->studentRepository->list($request));
    }
    public function display($id){
        return view('students.display_student', [
            'student' => $this->studentRepository->get($id),
            'assignCourses' => $this->studentRepository->getAssignedCourses($id),
            'availableCourses' => $this->studentRepository->getAvailableCourses($id),
        ]);
    }
    public function edit($id){
        return view('students.edit_student', [
            'student' => $this->studentRepository->get($id),
            'classes' => $this->classRepository->all(),
            'courses' => $this->courseRepository->all(),
        ]);
    }
    public function update(Request $request){
        $this->studentRepository->update($request);
        return redirect()->back();
    }
    public function saveAssignCourse(Request $request){
        $this->studentRepository->assignNewCourses($request);
        return redirect()->back();
    }
    public function removeCourse($id) {
        $this->studentRepository->removeCoursesFromStudent($id);
        return redirect()->back();
    }
}
