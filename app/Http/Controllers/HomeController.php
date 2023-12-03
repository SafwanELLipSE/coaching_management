<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Home\HomeInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomeInterface $homeInterface)
    {
        $this->middleware('auth');
        $this->homeInterface = $homeInterface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'studentCount' => $this->homeInterface->studentCount(),
            'teacherCount' => $this->homeInterface->teacherCount(),
            'classesCount' => $this->homeInterface->classesCount(),
            'classroomCount' => $this->homeInterface->classroomCount(),
            'courseCount' => $this->homeInterface->courseCount(),
            'examinationCount' => $this->homeInterface->examinationCount(),
            'questionCount' => $this->homeInterface->questionCount(),
            'gradeCount' => $this->homeInterface->gradeCount(),
        ]);
    }
}
