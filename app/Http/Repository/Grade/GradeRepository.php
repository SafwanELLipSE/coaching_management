<?php

namespace App\Http\Repository\Grade;

use App\Models\Grade;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class GradeRepository implements GradeInterface
{
    public function all(){
        return Grade::all();
    }
    public function get($id){
        return Grade::find($id);
    }
    public function count(){
        return Grade::count();
    }
    public function store($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $grade = new Grade();
        $this->saveData($grade, $request);
        if ($grade->save()) {
            Alert::success('Success', 'Successfully Created a new Grade');
        }
    }
    public function list($request)
    {
        $list = Grade::paginate(10);
        return $list;
    }
    public function update($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $grade = $this->get($request->post('grade_id'));
        $this->saveData($grade, $request);
        if ($grade->save()) {
            Alert::success('Success', 'Successfully, Grade has been updated.');
        }
    }
    public function delete($id){
        $grade = $this->get($id);
        $grade->delete();
        Alert::success('Success', 'Successfully, Grade has been Removed.');
    }
    private function valid($request)
    {
        return  Validator::make($request->all(), [
            'grade' => 'required',
            'starting_range' => 'required',
            'ending_range' => 'required',
            'point' => 'required',
        ]);
    }
    private function saveData($data, $request)
    {
        $data->from_range = $request->post('starting_range');
        $data->to_range = $request->post('ending_range');
        $data->grade = $request->post('grade');
        $data->point = $request->post('point');
    }
}
