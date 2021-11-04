<?php

namespace App\Http\Repository\Examination;

use App\Models\Examination;
use App\Models\Question;
use App\Models\Student;
use App\Models\Examination_solution_mcq;
use App\Models\Examination_solution_written;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
class ExamRepository implements ExamInterface
{
    public function all()
    {
        return Examination::all();
    }
    public function get($id)
    {
        return Examination::find($id);
    }
    public function count()
    {
        return Examination::count();
    }
    public function paginate()
    {
        return Examination::paginate(10);
    }
    public function store($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $exam = new Examination;
        $this->saveData($exam, $request);
        $exam->is_active = Examination::ACTIVE;
        if ($exam->save()) {
            Alert::success('Success', 'Successfully Created a new Examination');
        }
    }
    public function list($request){
        $exams = $this->all();
        if ($request->post('classroom')) {
            $exams = Examination::where('classroom_id', $request->post('classroom'))->get();
        } elseif ($request->post('status')) {
            $exams = Examination::where('is_active', $request->post('status')-1)->get();
        } elseif ($request->post('type')) {
            $exams = Examination::where('type', $request->post('type')-1)->get();
        }

        $totalData = $exams->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($exams as $exam) {
            $show = route('exam.display', $exam->id);
            $localArray[0] = $exam->id;
            $localArray[1] = $exam->name;
            $localArray[2] = isset($exam->classroom->name) ? $exam->classroom->name : 'No Longer Available';
            $localArray[3] = ($exam->type == 1) ? "Written" : "MCQ";
            $localArray[4] = date('d.m.Y', strtotime($exam->date));
            $localArray[5] = date('H:s a', strtotime($exam->start_time));
            $localArray[6] = $exam->duration;
            $localArray[7] = $exam->marks;
            $localArray[8] = Examination::getStatus($exam->is_active);
            $localArray[9] = "
                <div class='btn-group'>
                    <a href='{$show}' class='btn btn-sm btn-dark-blue'><i class='fas fa-eye'></i></a>
                    <a class='btn btn-sm btn-dark-red' id='delete-exam' data-exam-id='{$exam->id}'><i class='fas fa-trash-alt'></i></a>
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

        $exam = $this->get($request->post('exam_id'));
        $this->saveData($exam, $request);
        $exam->is_active = Examination::ACTIVE;
        if ($exam->save()) {
            Alert::success('Success', 'Successfully Information of Examination has been updated');
        }
    }
    public function mcqSolution($request){
        // $validator = Validator::make($request->all(), [
        //     'examination_id'   => 'required',
        //     'answer'   => 'required',
        // ]);
        // if ($validator->fails()) {
        //     alert()->warning('Error Occurred', $validator->errors()->all()[0]);
        //     return redirect()->back()->withInput()->withErrors($validator);
        // }
        $question_answer = Question::where('examination_id', $request->post('examination_id'))->select('answer','mark')->get()->toArray();

        $marks = 0;
        for ($i = 1; $i <= count($question_answer); $i++) {
            $input[] = $request->post('answer' . $i);
            if (strtolower($question_answer[$i - 1]["answer"]) == strtolower($request->post('answer' . $i))) {
                $marks = $marks + $question_answer[$i - 1]["mark"];
            }
        }
        $answer = implode(",", $input);

        $student = Student::where('user_id', Auth::user()->id)->first();

        if(!empty($student)){
            $solution = new Examination_solution_mcq;
            $solution->student_id = $student->id;
            $solution->exam_id = $request->post('examination_id');
            $solution->solution = $answer;
            $solution->obtain_mark = $marks;

            if ($solution->save()) {
                Alert::success('Success', 'Successfully You have completed Your MCQ Examination.');
            }
        }
        else{
            Alert::warning('Error', 'The student don\'t existed.');
        }
    }
    public function markWritten($request){
        $validator = Validator::make($request->all(), [
            'select_student'   => 'required',
            'examination_id'   => 'required',
            'marks.*'   => 'required|numeric',
            'question_ids.*'   => 'required|numeric',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $marks = $request->post('marks');
        $questions = $request->post('question_ids');
        $existStudent = Examination_solution_written::where('student_id', $request->post('select_student'))
            ->where('student_id', $request->post('select_student'))->count();
        if(count($marks) != 0 && $existStudent == 0){
            foreach ($marks as $key => $element) {
                $written = new Examination_solution_written;
                $written->student_id = $request->post('select_student');
                $written->exam_id = $request->post('examination_id');
                $written->question_id = $questions[$key];
                $written->obtain_mark = $marks[$key];
                $written->save();
            }
            Alert::success('Success', 'Successfully You have completed Marking of Written Examination.');
        }else{
            Alert::success('Warning', 'Marking of this student is taken already.');
        }
    }
    public function statusOfSimilarClassroom($request)
    {
        $examination = Examination::where('classroom_id', $request->post('id'))->get();

        $countWritten = $examination->where('type', 1)->count();
        $countMcq = $examination->where('type', 2)->count();
        $totalMarks = $examination->sum('marks');

        $data = [
            'countWritten' => $countWritten,
            'countMcq' => $countMcq,
            'totalMarks' => $totalMarks
        ];

        return $data;
    }
    public function markExamsClassroom($request){
        $examination = Examination::where('classroom_id', $request->post('id'))->get()->sum('marks');
        $number = $request->post('numbers');
        $total = $number + $examination;
        return "$examination + $number = $total / 100";
    }
    public function delete($id){}
    private function valid($request)
    {
        return  Validator::make($request->all(), [
            'exam_name'   => 'required',
            'select_exam_type'  => 'required',
            'select_classroom'  => 'required',
            'exam_date' => 'required',
            'exam_start_time' => 'required',
            'exam_end_time' => 'required',
            'exam_marks' => 'required|numeric',
        ]);
    }
    private function saveData($data, $request)
    {
        $data->name = $request->post('exam_name');
        $data->type = $request->post('select_exam_type');
        $data->date = date('Y-m-d', strtotime($request->post('exam_date')));
        $data->start_time = date('H:i:s', strtotime($request->post('exam_start_time')));
        $data->end_time = date('H:i:s', strtotime($request->post('exam_end_time')));

        $startTime = \Carbon\Carbon::parse($request->post('exam_start_time'));
        $endTime = \Carbon\Carbon::parse($request->post('exam_end_time'));
        $totalDuration = $endTime->diffInMinutes($startTime);
        $data->duration = $totalDuration;

        $data->marks = $request->post('exam_marks');
        $data->classroom_id = $request->post('select_classroom');
    }
}
