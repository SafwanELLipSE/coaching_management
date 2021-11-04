<?php

namespace App\Http\Repository\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CourseRepository implements CourseInterface
{
    public function all(){
        return Course::all();
    }
    public function get($id){
        return Course::find($id);
    }
    public function count(){
        return Course::count();
    }
    public function store($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $course = new course();
        $this->saveData($course, $request);
        if($course->save()){
            Alert::success('Success', 'Successfully Created a new Course');
        }
    }
    public function list($request)
    {
        if(empty($request->course_search)){
            $list = Course::paginate(10);
        }else{
            $list = Course::where('name', 'LIKE','%'.$request->course_search.'%')
            ->orWhere('code','LIKE','%'.$request->course_search.'%')
            ->paginate(10);
            $list->appends($request->all());
        }
        return $list;
    }
    public function update($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $course = $this->get($request->post('course_id'));
        $this->saveData($course, $request);
        if($course->save()){
            Alert::success('Success', 'Successfully, Course has been updated.');
        }
    }
    public function delete($id){
        $course = $this->get($id);
        $course->delete();
        Alert::success('Success', 'Successfully, Course has been Removed.');
    }
    private function valid($request)
    {
        return  Validator::make($request->all(), [
            'course_name'   => 'required',
            'course_code'  => 'required',
            'course_mark'  => 'required',
        ]);
    }
    private function saveData($data, $request){
        $data->name = $request->post('course_name');
        $data->code = $request->post('course_code');
        $data->marks = $request->post('course_mark');
    }
}
