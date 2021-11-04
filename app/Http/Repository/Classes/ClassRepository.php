<?php

namespace App\Http\Repository\Classes;

use App\Models\Classes;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ClassRepository implements ClassInterface
{
    public function all(){
        return Classes::all();
    }
    public function get($id){
        return Classes::find($id);
    }
    public function count(){
        return Classes::count();
    }
    public function store($request){
        $validator = Validator::make($request->all(), [
            'class_name'   => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $class = new Classes();
        $class->name = $request->post('class_name');
        if($class->save()){
            Alert::success('Success', 'Successfully Created a new Class');
        }
    }
    public function list($request){
        if(empty($request->class_search)){
            $list = Classes::paginate(10);
        }else{
            $list = Classes::where('name', 'LIKE','%'.$request->class_search.'%')
            ->paginate(10);
            $list->appends($request->all());
        }
        return $list;
    }
    public function update($request){
        $validator = Validator::make($request->all(), [
            'class_name'   => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $class = $this->get($request->post('class_id'));
        $class->name = $request->post('class_name');
        if($class->save()){
            Alert::success('Success', 'Successfully, Class has been updated.');
        }
    }
    public function delete($id){
        $class = $this->get($id);
        $class->delete();
        Alert::success('Success', 'Successfully, Class has been Removed.');
    }
}
