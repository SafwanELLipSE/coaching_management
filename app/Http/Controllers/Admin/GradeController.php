<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Grade\GradeInterface;

class GradeController extends Controller
{
    public function __construct(GradeInterface $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }
    public function index()
    {
        return view('grades.create_grade', [
            'count' => $this->gradeRepository->count(),
        ]);
    }
    public function store(Request $request)
    {
        $this->gradeRepository->store($request);
        return redirect()->back();
    }
    public function list(Request $request)
    {
        return view('grades.all_grade', [
            'count' => $this->gradeRepository->count(),
            'grades' => $this->gradeRepository->list($request),
        ]);
    }
    public function edit($id){
        return view('grades.edit_grade', [
            'grade' => $this->gradeRepository->get($id),
        ]);
    }
    public function update(Request $request){
        $this->gradeRepository->update($request);
        return redirect()->back();
    }
    public function delete($id){
        $this->gradeRepository->delete($id);
        return redirect()->back();
    }
}
