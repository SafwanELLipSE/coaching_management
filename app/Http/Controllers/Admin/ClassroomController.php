<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Course\CourseInterface;
use App\Http\Repository\Classes\ClassInterface;
use App\Http\Repository\Teacher\TeacherInterface;
use App\Http\Repository\Classroom\ClassroomInterface;

class ClassroomController extends Controller
{
    public function __construct(ClassInterface $classRepository, CourseInterface $courseRepository, TeacherInterface $teacherRepository, ClassroomInterface $classroomRepository)
    {
        $this->classRepository = $classRepository;
        $this->courseRepository = $courseRepository;
        $this->teacherRepository = $teacherRepository;
        $this->classroomRepository = $classroomRepository;
    }
    public function index(){
        return view('classrooms.create_classroom',[
            'classes' => $this->classRepository->all(),
            'courses' => $this->courseRepository->all(),
            'teachers' => $this->teacherRepository->all(),
            'count'=> $this->classroomRepository->count(),
        ]);
    }
    public function store(Request $request){
        $this->classroomRepository->store($request);
        return redirect()->back();
    }
    public function allClassroom(){
        return view('classrooms.all_classroom', [
            'classes' => $this->classRepository->all(),
            'courses' => $this->courseRepository->all(),
            'teachers' => $this->teacherRepository->all(),
        ]);
    }
    public function list(Request $request)
    {
        echo json_encode($this->classroomRepository->list($request));
    }
    public function display($id){
        return view('classrooms.classroom_display', [
            'classroom' => $this->classroomRepository->get($id),
            'students' => $this->classroomRepository->getSameClassCourseStudent($id),
            'enrolledStudentLists' => $this->classroomRepository->listOfEnrolledStudent($id),
        ]);
    }
    public function edit($id){
        return view('classrooms.edit_classroom', [
            'classroom' => $this->classroomRepository->get($id),
            'classes' => $this->classRepository->all(),
            'courses' => $this->courseRepository->all(),
            'teachers' => $this->teacherRepository->all(),
        ]);
    }
    public function update(Request $request){
        $this->classroomRepository->update($request);
        return redirect()->back();
    }
    public function delete(Request $request){
        $this->classroomRepository->delete($request, $request->post('id'));
        return response()->json("Successfully, Classroom has been deleted", 200);
    }
    public function enrollStudent(Request $request){
        $this->classroomRepository->enrollNewStudent($request);
        return redirect()->back();
    }
    public function changeStatus($id){
        $this->classroomRepository->status($id);
        return redirect()->back();
    }
    public function removeStudent($id){
        $this->classroomRepository->removeEnrolledStudent($id);
        return redirect()->back();
    }
    public function createZoom(Request $request){
        $this->classroomRepository->makeVideoRoom($request);
        return redirect()->back();
    }
    public function removeZoom($id){
        $this->classroomRepository->deleteMeetingroom($id);
        return redirect()->back();
    }
    public function editZoom(Request $request){
        $this->classroomRepository->updateMeetingroom($request);
        return redirect()->back();
    }
    public function assignedExams($id){
        return view('classrooms.exam_classroom', [
            'id' => $id,
            'examinations' => $this->classroomRepository->listOfExams($id),
        ]);
    }
}
