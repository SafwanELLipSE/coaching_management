<?php

namespace App\Http\Repository\Teacher;

use App\Models\Teacher;
use App\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TeacherRepository implements TeacherInterface
{
    public function all(){
        return Teacher::all();
    }
    public function get($id){
        return Teacher::find($id);
    }
    public function count(){
        return Teacher::count();
    }
    public function store($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = new User();
        $this->saveDataUser($user, $request);
        $user->access_level = User::ACCESS_LEVEL_TEACHER;
        $user->password = Hash::make("12345678");
        if($user->save()){
            $teacher = new Teacher();
            $this->saveDataTeacher($teacher, $request);
            $teacher->user_id = $user->id;
            $this->saveImage($teacher, $request);
            $teacher->isActive = Teacher::ACTIVE;
            if ($teacher->save()) {
                Alert::success('Success', 'Successfully Created a new Teacher');
            }
        }
    }
    public function list($request){
        if (empty($request->teacher_search)) {
            $list = Teacher::paginate(10);
        } else {
            $list = Teacher::where('designation', 'LIKE', '%' . $request->teacher_search . '%')
                ->orWhere('subject', 'LIKE', '%' . $request->teacher_search . '%')
                ->orWhere('qualification', 'LIKE', '%' . $request->teacher_search . '%')
                ->orWhere('institute', 'LIKE', '%' . $request->teacher_search . '%')
                ->orWhere('address', 'LIKE', '%' . $request->teacher_search . '%')
                ->paginate(10);
            $list->appends($request->all());
        }
        return $list;
    }
    public function update($request){
        $validator = $this->validEdit($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = $this->getUser($request->post('user_id'));
        $this->saveDataUser($user, $request);
        if ($user->save()) {
            $teacher = $this->get($request->post('teacher_id'));
            $this->saveDataTeacher($teacher, $request);
            if ($request->file('teacher_image')) {
                if ($teacher->image != null) {
                    $path_image = public_path() . '/teacher_images/' . $teacher->image;
                    if (file_exists($path_image) == true) {
                        unlink($path_image);
                    }
                }
            }
            $this->saveImage($teacher, $request);
            if ($teacher->save()) {
                Alert::success('Success', 'Successfully Teacher Information has been updated.');
            }
        }
    }
    public function delete($id){}
    private function valid($request)
    {
        return  Validator::make($request->all(), [
            'teacher_name'   => 'required',
            'teacher_email'  => 'required|email|unique:users,email',
            'teacher_phone'   => 'required|unique:users,phone',
            'national_id'  => 'required|unique:teachers,national_id',
            'teacher_gender'   => 'required',
            'teacher_dob'   => 'required|date',
            'teacher_qualification'   => 'required',
            'teacher_designation'   => 'required',
            'teacher_subject'   => 'required',
            'teacher_qualification'   => 'required',
            'teacher_institute'   => 'required',
            'teacher_salary'   => 'required|numeric',
            'teacher_address'   => 'required',
            'teacher_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
    }
    private function validEdit($request)
    {
        return  Validator::make($request->all(), [
            'teacher_name'   => 'required',
            'teacher_email'  => 'required|email',
            'teacher_phone'   => 'required',
            'national_id'  => 'required',
            'teacher_gender'   => 'required',
            'teacher_dob'   => 'required|date',
            'teacher_qualification'   => 'required',
            'teacher_designation'   => 'required',
            'teacher_subject'   => 'required',
            'teacher_qualification'   => 'required',
            'teacher_institute'   => 'required',
            'teacher_salary'   => 'required|numeric',
            'teacher_address'   => 'required',
            'teacher_image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
    }
    private function saveDataUser($data, $request)
    {
        $data->name = $request->post('teacher_name');
        $data->email = $request->post('teacher_email');
        $data->phone = $request->post('teacher_phone');
    }
    private function saveDataTeacher($data, $request)
    {
        $data->national_id = $request->post('national_id');
        $data->gender = $request->post('teacher_gender');
        $data->salary = $request->post('teacher_salary');
        $data->experience = $request->post('teacher_experience');
        $data->dob = date('Y-m-d', strtotime($request->post('teacher_dob')));
        $data->qualification = $request->post('teacher_qualification');
        $data->institute = $request->post('teacher_institute');
        $data->address = $request->post('teacher_address');
        $data->designation = $request->post('teacher_designation');
        $data->subject = $request->post('teacher_subject');
    }
    private function saveImage($data, $request)
    {
        if ($request->file('teacher_image')) {
            $image = $request->file('teacher_image');
            $new_name = Auth::user()->id . '_p_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('teacher_images'), $new_name);
            $data->image = $new_name;
        }
    }
    private function getUser($id){
        return User::find($id);
    }
}
