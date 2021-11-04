<?php

namespace App\Http\Repository\StudentGrading;

use App\Models\Student_grading;
use App\Models\Grade;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
class StudentGradeRepository implements StudentGradeInterface
{
    public function all(){
        return Student_grading::all();
    }
    public function get($id){
        return Student_grading::find($id);
    }
    public function determineGrade($request){
        $validator = Validator::make($request->all(), [
            'marks'   => 'required',
        ]);
        if ($validator->fails()) 
            return response()->json($validator->errors()->all()[0], 422);

        $grade = Grade::where('from_range', '>=', $request->post('marks'))
                ->where('to_range', '<=', $request->post('marks'))->first()->id;

        return $grade;
    }
    public function count(){}
    public function store($request){}
    public function list($request){}
    public function update($request){}
    public function delete($id){}
}
