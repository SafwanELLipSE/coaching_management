<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Course\CourseInterface;

class CourseController extends Controller
{
    public function __construct(CourseInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    public function index(){
        return view('courses.create_course',[
            'count' => $this->courseRepository->count(),
        ]);
    }
    public function store(Request $request){
        $this->courseRepository->store($request);
        return redirect()->back();
    }
    public function list(Request $request)
    {
        return view('courses.all_course',[
            'count' => $this->courseRepository->count(),
            'courses' => $this->courseRepository->list($request),
        ]);
    }
    public function edit($id){
        return view('courses.edit_course',[
            'course' => $this->courseRepository->get($id),
        ]);
    }
    public function update(Request $request){
        $this->courseRepository->update($request);
        return redirect()->back();
    }
    public function delete($id){
        $this->courseRepository->delete($id);
        return redirect()->back();
    }
}
