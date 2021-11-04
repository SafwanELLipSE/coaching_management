<?php

namespace App\Http\Repository\Student;

use App\Models\Student;
use App\Models\Student_course;
use App\Models\Course;
use App\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentRepository implements StudentInterface
{
    public function all(){
        return Student::all();
    }
    public function get($id){
        return Student::find($id);
    }
    private function getUser($id)
    {
        return User::find($id);
    }
    public function getAssignedCourses($id){
        return Student_course::where('student_id', $id)->paginate(5);
    }
    public function getAvailableCourses($id)
    {
        $course_ids = Student_course::where('student_id', $id)->pluck('course_id');
        return Course::whereNotIn('id', $course_ids)->get();
    }
    public function count(){
        return Student::count();
    }
    public function store($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = new User();
        $this->saveDataUser($user, $request);
        $user->access_level = User::ACCESS_LEVEL_STUDENT;
        $user->password = Hash::make("12345678");
        if ($user->save()) {
            $student = new Student();
            $this->saveData($student, $request);
            $student->user_id = $user->id;
            $student->is_active = Student::ACTIVE;
            $this->saveImage($student, $request);
            if ($student->save()) {
                $this->saveStudentCourses($request, $student->id);
                Alert::success('Success', 'Successfully Created a new Student');
            }
        }
    }
    public function list($request){
        $students = $this->all();
        if ($request->post('class')) {
            $students = Student::where('class_id',$request->post('class'))->get();
        } elseif ($request->post('status')) {
            $students = Student::where('is_active',$request->post('status')-1)->get();
        }

        $totalData = $students->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($students as $student) {
            $show = route('student.display', $student->id);
            $attendance = route('student.display_student', $student->id);
            $localArray[0] = $student->id;
            $localArray[1] = isset($student->user->name) ? $student->user->name : 'No Longer Available';
            $localArray[2] = isset($student->user->email) ? $student->user->email : 'No Longer Available';
            $localArray[3] = isset($student->user->phone) ? $student->user->phone : 'No Longer Available';
            $localArray[4] = isset($student->class->name) ? $student->class->name : 'No Longer Available';
            $localArray[5] = Student::getStatus($student->is_active);
            $localArray[6] = date('d.m.Y', strtotime($student->created_at));
            $localArray[7] = "
                <div class='btn-group'>
                    <a href='{$show}' class='btn btn-sm btn-dark-blue'><i class='fas fa-eye'></i></a>
                    <a href='{$attendance}'class='btn btn-sm btn-deep-purple'><i class='far fa-calendar-alt'></i></a>
                    <a class='btn btn-sm btn-dark-red' id='delete-student' data-student-id='{$student->id}'><i class='fas fa-trash-alt'></i></a>
                </div>";
            $toReturn[] = $localArray;
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $toReturn
        );
        return $json_data;
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
            $student = $this->get($request->post('student_id'));
            $this->saveData($student, $request);
            if ($request->file('student_image')) {
                if ($student->image != null) {
                    $path_image = public_path() . '/student_images/' . $student->image;
                    if (file_exists($path_image) == true) {
                        unlink($path_image);
                    }
                }
            }
            $this->saveImage($student, $request);
            if ($student->save()) {
                Alert::success('Success', 'Successfully Student Information has been updated.');
            }
        }
    }
    public function delete($id){}
    public function assignNewCourses($request){
        $this->saveStudentCourses($request,$request->post('student_id'));
        Alert::success('Success', 'Successfully New Courses has been assigned.');
    }
    public function removeCoursesFromStudent($id){
        $student = Student_course::find($id);
        if($student->delete()){
            Alert::success('Success', 'Successfully Course has been removed from the student.');
        }
    }
    private function valid($request)
    {
        return  Validator::make($request->all(), [
            'student_name'   => 'required',
            'student_email'  => 'required|email|unique:users,email',
            'student_phone'   => 'required|unique:users,phone',
            'student_gender'   => 'required',
            'father_name'   => 'required',
            'father_nid'  => 'required|unique:students,father_nid',
            'father_occupation'   => 'required',
            'mother_name'   => 'required',
            'mother_nid'  => 'required|unique:students,mother_nid',
            'mother_occupation'   => 'required',
            'student_dob'   => 'required',
            'select_class'   => 'required',
            'list_courses'   => 'required',
            'guidance_email'   => 'required|email|unique:students,guidance_email',
            'guidance_phone'   => 'required|unique:students,guidance_mobile',
            'student_address'   => 'required',
            'student_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
    }
    private function validEdit($request)
    {
        return  Validator::make($request->all(), [
            'student_name'   => 'required',
            'student_email'  => 'required|email',
            'student_phone'   => 'required',
            'student_gender'   => 'required',
            'father_name'   => 'required',
            'father_nid'  => 'required',
            'father_occupation'   => 'required',
            'mother_name'   => 'required',
            'mother_nid'  => 'required',
            'mother_occupation'   => 'required',
            'student_dob'   => 'required',
            'select_class'   => 'required',
            'guidance_email'   => 'required|email',
            'guidance_phone'   => 'required',
            'student_address'   => 'required',
            'student_image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
    }
    private function saveDataUser($data, $request)
    {
        $data->name = $request->post('student_name');
        $data->email = $request->post('student_email');
        $data->phone = $request->post('student_phone');
    }
    private function saveData($data, $request)
    {
        $data->gender = $request->post('student_gender');
        $data->father_name = $request->post('father_name');
        $data->father_nid = $request->post('father_nid');
        $data->father_occupation = $request->post('father_occupation');
        $data->mother_name = $request->post('mother_name');
        $data->mother_nid = $request->post('mother_nid');
        $data->mother_occupation = $request->post('mother_occupation');
        $data->guidance_email = $request->post('guidance_email');
        $data->guidance_mobile = $request->post('guidance_phone');
        $data->dob = date('Y-m-d', strtotime($request->post('student_dob')));
        $data->address = $request->post('student_address');
        $data->class_id = $request->post('select_class');
    }
    private function saveStudentCourses($request, $id){
        // dd(count($request->post('list_courses')));
        if (count($request->post('list_courses')) != 0) {
            foreach ($request->post('list_courses') as $course) {
                $perCourse = new Student_course;
                $perCourse->student_id = $id;
                $perCourse->course_id = $course;
                $perCourse->save();
            }
        }
    }
    private function saveImage($data, $request)
    {
        if ($request->file('student_image')) {
            $image = $request->file('student_image');
            $new_name = Auth::user()->id . '_p_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('student_images'), $new_name);
            $data->image = $new_name;
        }
    }
}
