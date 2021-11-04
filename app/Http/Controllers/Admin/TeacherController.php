<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Teacher\TeacherInterface;
class TeacherController extends Controller
{
    public function __construct(TeacherInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }
    public function index(){
        return view('teachers.create_teacher',[
            'count' => $this->teacherRepository->count(),
        ]);
    }
    public function store(Request $request){
        $this->teacherRepository->store($request);
        return redirect()->back();
    }
    public function list(Request $request)
    {
        return view('teachers.all_teacher',[
            'count' => $this->teacherRepository->count(),
            'teachers' => $this->teacherRepository->list($request),
        ]);
    }
    public function display($id){
        return view('teachers.teacher_display', [
            'teacher' => $this->teacherRepository->get($id),
        ]);
    }
    public function edit($id){
        return view('teachers.edit_teacher', [
            'teacher' => $this->teacherRepository->get($id),
        ]);
    }
    public function update(Request $request){
        $this->teacherRepository->update($request);
        return redirect()->back();
    }
} 
