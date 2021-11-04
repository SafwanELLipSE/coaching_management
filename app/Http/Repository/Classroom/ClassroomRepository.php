<?php

namespace App\Http\Repository\Classroom;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Student_course;
use App\Models\Classroom_students;
use App\Models\Examination;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
class ClassroomRepository implements ClassroomInterface
{
    public function all()
    {
        return Classroom::all();
    }
    public function get($id)
    {
        return Classroom::find($id);
    }
    public function count()
    {
        return Classroom::count();
    }
    public function getSameClassCourseStudent($id){
        $classroom = $this->get($id);
        $getEnrolledStudents = Classroom_students::where('classroom_id', $id)->pluck('student_id');
        $sameCourseStudents =  Student_course::where('course_id', $classroom->course_id)->pluck('student_id');
        return Student::whereIn('id', $sameCourseStudents)->whereNotIN('id', $getEnrolledStudents)->where('class_id', $classroom->class_id)->get();
    }
    public function listOfStudentForMarking($id){
        $classroomID = Examination::where('id', $id)->pluck('classroom_id');
        $studentIds = Classroom_students::where('classroom_id', $classroomID)->pluck('student_id');
        return Student::whereIn('id', $studentIds)->get();
    }
    public function listOfEnrolledStudent($id)
    {
        return Classroom_students::where('classroom_id', $id)->paginate(10);
    }
    public function listOfExams($id){
        return Examination::where('classroom_id', $id)->get();
    }
    public function store($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $classroom = new Classroom;
        $this->saveData($classroom, $request);
        $classroom->enrolled = 0;
        $classroom->is_active = Classroom::ACTIVE;
        if ($classroom->save()) {
            Alert::success('Success', 'Successfully Created a new Classroom');
        }
    }
    public function list($request){
        $classrooms = $this->all();
        if ($request->post('class')) {
            $classrooms = Classroom::where('class_id', $request->post('class'))->get();
        } elseif ($request->post('course')) {
            $classrooms = Classroom::where('course_id', $request->post('course'))->get();
        } elseif ($request->post('teacher')) {
            $classrooms = Classroom::where('teacher_id', $request->post('teacher'))->get();
        } elseif ($request->post('status')) {
            $classrooms = Classroom::where('is_active', $request->post('status')-1)->get();
        }

        $totalData = $classrooms->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($classrooms as $classroom) {
            $show = route('classroom.display', $classroom->id);
            $localArray[0] = $classroom->id;
            $localArray[1] = $classroom->name;
            $localArray[2] = isset($classroom->class->name) ? $classroom->class->name : 'No Longer Available';
            $localArray[3] = isset($classroom->course->name) ? $classroom->course->name.' ('.$classroom->course->code.')' : 'No Longer Available';
            $localArray[4] = isset($classroom->teacher->user->name) ? $classroom->teacher->user->name. ' ('.$classroom->teacher->subject.')' : 'No Longer Available';
            $localArray[5] = $classroom->capacity;
            $localArray[6] = Classroom::getStatus($classroom->is_active);
            $localArray[7] = date('d.m.Y', strtotime($classroom->start_date));
            $localArray[8] = "
                <div class='btn-group'>
                    <a href='{$show}' class='btn btn-sm btn-dark-blue'><i class='fas fa-eye'></i></a>
                    <a class='btn btn-sm btn-dark-red' id='delete-classroom' data-classroom-id='{$classroom->id}'><i class='fas fa-trash-alt'></i></a>
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
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $classroom = $this->get($request->post('classroom_id'));
        $this->saveData($classroom, $request);
        if ($classroom->save()) {
            Alert::success('Success', 'Successfully, Classroom has been updated.');
        }
    }
    public function delete($request, $id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:classrooms,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $classroom = $this->get($id);
        $classroom->delete();
    }
    public function enrollNewStudent($request){
        $validator = Validator::make($request->all(), [
            'list_students'   => 'required',
            'classroom_id'  => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $classroom = Classroom::where('id',$request->post('classroom_id'))->first();
        $entryCount = count($request->post('list_students'));
        if($entryCount){
            if($entryCount + $classroom->enrolled <= $classroom->capacity){
                foreach ($request->post('list_students') as $student) {
                    $perCourse = new Classroom_students;
                    $perCourse->classroom_id  = $request->post('classroom_id');
                    $perCourse->student_id = $student;
                    $perCourse->is_active = Classroom_students::ACTIVE;
                    $perCourse->save();
                }
                $classroom->enrolled = $classroom->enrolled + $entryCount;
                $classroom->save();
                Alert::success('Success', 'Successfully, Students has been enrolled to the classroom.');
            }elseif($classroom->enrolled == $classroom->capacity){
                Alert::warning('Warning', 'Error!! The limit capacity is filled.');
            }else{
                Alert::warning('Warning', 'Error!! The limit capacity is filled, you can only add '. ($classroom->capacity - $classroom->enrolled).' Students');
            }
        }
    }
    public function status($id){
        $getStudent = Classroom_students::find($id);
        $getClassroom = Classroom::find($getStudent->classroom_id);

        if($getStudent->is_active == Classroom_students::ACTIVE){
            $getStudent->is_active = Classroom_students::INACTIVE;
            if($getStudent->save()){
                $getClassroom->enrolled -= 1;
                $getClassroom->save();
                Alert::success('Success', 'Successfully, Student has become Inactive from the classroom.');
            }
        }else if($getStudent->is_active == Classroom_students::INACTIVE){
            $getStudent->is_active = Classroom_students::ACTIVE;
            if($getStudent->save()){
                $getClassroom->enrolled += 1;
                $getClassroom->save();
                Alert::success('Success', 'Successfully, Student has become Active from the classroom.');
            }
        } 
    }
    public function removeEnrolledStudent($id){
        $getStudent = Classroom_students::find($id);
        $getClassroom = Classroom::find($getStudent->classroom_id);
        if ($getStudent->is_active == Classroom_students::ACTIVE) {
            $getClassroom->enrolled -= 1;
            $getClassroom->save();
            $getStudent->delete();
        }else if($getStudent->is_active == Classroom_students::INACTIVE){
            $getStudent->delete();
        }
        Alert::success('Success', 'Successfully, Student has been removed from the classroom.');
    }
    public function makeVideoRoom($request){
        $validator = Validator::make($request->all(), [
            'zoom_password'   => 'required',
            'classroom_id'  => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $classroom = Classroom::where('id', $request->post('classroom_id'))->first();

        $startTime = \Carbon\Carbon::parse($classroom->start_time);
        $endTime = \Carbon\Carbon::parse($classroom->end_time);
        $totalDuration = $endTime->diffInMinutes($startTime);

        $data =  [
            'topic' => $classroom->name,
            'agenda' => $classroom->name .'('. $classroom->teacher->user->name .')',
            'type' => 2,
            'start_time' => \Carbon\Carbon::now(),
            'timezone' => 'Asia/Dhaka',
            'duration' => "$totalDuration",
            'password' => $request->post('zoom_password'),
            'settings' => [
                'join_before_host'  =>  false,
                'host_video'        =>  false,
                'participant_video' => false,
                'mute_upon_entry'   => false,
                'enforce_login'     => true,
                'auto_recording'    => "none",
                'alternative_hosts' => ""
            ]
        ];

        $user = \Zoom::user()->find('me');

        if ($user->meetings()->create($data)) {
            $meetingRoom = $user->meetings()->where('topic', $classroom->name)->first();
            $classroom->zoom_id = $meetingRoom->id;
            $classroom->zoom_password = $request->post('zoom_password');
            $classroom->zoom_link = $meetingRoom->join_url;
            if($classroom->save()){
                Alert::success('Success', 'Successfully, A Room has been created for students to join.');
            }
        } else {
            Alert::warning('Warning', 'Error, There were some problem while setting up room.');
        }
    }
    public function deleteMeetingroom($id){
        $classroom = Classroom::where('id', $id)->first(); 
        $meeting = \Zoom::meeting()->find($classroom->zoom_id);
        if ($meeting->delete()) {
            $classroom->zoom_id = null;
            $classroom->zoom_password = null;
            $classroom->zoom_link = null;
            if ($classroom->save()) {
                Alert::success('Success', 'Successfully, A Room has been deleted.');
            }
        } else {
            Alert::warning('Warning', 'Error, There were problem while deletion.');
        }
    }
    public function updateMeetingroom($request){
        $validator = Validator::make($request->all(), [
            'zoom_password'   => 'required',
            'classroom_id'  => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $classroom = Classroom::where('id', $request->post('classroom_id'))->first();

        $startTime = \Carbon\Carbon::parse($classroom->start_time);
        $endTime = \Carbon\Carbon::parse($classroom->end_time);
        $totalDuration = $endTime->diffInMinutes($startTime);

        $data =  [
            'topic' => $classroom->name,
            'agenda' => $classroom->name . '(' . $classroom->teacher->user->name . ')',
            'type' => 2,
            'start_time' => \Carbon\Carbon::now(),
            'timezone' => 'Asia/Dhaka',
            'duration' => "$totalDuration",
            'password' => $request->post('zoom_password'),
            'settings' => [
                'join_before_host'  =>  false,
                'host_video'        =>  false,
                'participant_video' => false,
                'mute_upon_entry'   => false,
                'enforce_login'     => true,
                'auto_recording'    => "none",
                'alternative_hosts' => ""
            ]
        ];
        $user = \Zoom::user()->find('me');

        if ($user->meetings()->create($data)) {
            $meetingRoom = $user->meetings()->where('topic', $classroom->name)->first();
            $classroom->zoom_id = $meetingRoom->id;
            $classroom->zoom_password = $request->post('zoom_password');
            $classroom->zoom_link = $meetingRoom->join_url;
            if ($classroom->save()) {
                Alert::success('Success', 'Successfully, A Room has been updated for students to join.');
            }
        } else {
            Alert::warning('Warning', 'Error, There were some problem couht not be uodate setting up room.');
        }
    }
    private function valid($request)
    {
        return  Validator::make($request->all(), [
            'classroom_name'   => 'required',
            'select_class'  => 'required',
            'select_course'   => 'required',
            'select_teacher'  => 'required',
            'student_capacity'   => 'required|numeric',
            'list_days'   => 'required',
            'start_time'   => 'required',
            'end_time'   => 'required',
            'starting_date'   => 'required',
            'ending_date'   => 'required',
        ]);
    }
    private function saveData($data, $request){
        $data->name = $request->post('classroom_name');
        $data->class_id = $request->post('select_class');
        $data->course_id = $request->post('select_course');
        $data->teacher_id = $request->post('select_teacher');
        $data->capacity = $request->post('student_capacity');
        $data->start_date = date('Y-m-d', strtotime($request->post('starting_date')));
        $data->end_date = date('Y-m-d', strtotime($request->post('ending_date')));
        $data->start_time = date('H:i:s', strtotime($request->post('start_time')));
        $data->end_time = date('H:i:s', strtotime($request->post('end_time')));
        if($request->post('list_days')){
            foreach($request->post('list_days') as $day){
                $selectedDays[] = $day;
            }
        }
        $allDays = implode(",", $selectedDays);
        $data->days = $allDays;
    }
}
