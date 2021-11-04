<?php

namespace App\Http\Repository\Question;

use App\Models\Examination;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionRepository implements QuestionInterface
{
    public function all(){
        return Question::all();
    }
    public function get($id){
        return Question::find($id);
    }
    public function getAllQuestionOnExam($id)
    {
        return Question::where('examination_id', $id)->get();;
    }
    public function count(){
        return Question::count();
    }
    public function countNumberOfExamQuestion($request){
        return Question::where('examination_id', $request->post('id'))->count();
    }
    public function sumOfRemainingMarks($request)
    {
        $examination = Examination::where('id', $request->post('id'))->first()->marks;
        $question = Question::where('examination_id', $request->post('id'))->sum('mark');
        $mark = $request->post('mark');
        $current = $question + $mark;
        return "$question + $mark = $current / $examination";
    }
    public function store($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $question = new Question;
        $this->saveData($question, $request);
        $question->is_active = Question::ACTIVE;
        if ($question->save()) {
            Alert::success('Success', 'Successfully Created a new Question');
        }
    }
    public function list($request){}
    public function update($request){
        $validator = $this->valid($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $id = $request->post('question_id');

        $question = $this->get($id);
        $this->saveData($question, $request);
        if ($question->save()) {
            Alert::success('Success', 'Successfully, Question Data has been updated');
        }
    }
    public function delete($id){}
    private function valid($request)
    {
        return Validator::make($request->all(), [
            'select_examination'  => 'required',
            'question'  => 'required|min:2',
            'type'  => 'required',
            'option' => 'required',
            'mark' => 'required',
        ]);
    }
    private function saveData($data, $request)
    {
        $data->examination_id = $request->post('select_examination');
        $data->question = $request->post('question');
        $data->type = $request->post('type');
        if (!empty($request->post('answer'))) {
            $data->answer =  $request->post('answer');
        } else {
            $data->answer =  null;
        }
        $data->number_option = $request->post('option');
        $data->mark = $request->post('mark');

        if ($request->post('option') != 0) {
            for ($i = 1; $i <= $request->post('option'); $i++) {
                $input[] = $request->post('option' . $i);
            }
            $allOption = implode(",", $input);
            $data->option_list = $allOption;
        } else {
            $data->option_list = null;
        }
    }
}
