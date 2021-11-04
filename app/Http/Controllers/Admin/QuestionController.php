<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Question\QuestionInterface;
use App\Http\Repository\Examination\ExamInterface;
class QuestionController extends Controller
{
    
    public function __construct(QuestionInterface $questionRepository, ExamInterface $examRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->examRepository = $examRepository;
    }
    public function index()
    {
        return view('questions.create_question',[
            'examinations' => $this->examRepository->all(),
            'count' => $this->questionRepository->count(),
        ]);
    }
    public function store(Request $request){
        $this->questionRepository->store($request);
        return redirect()->back();
    }
    public function list(Request $request)
    {
        return view('questions.all_question',[
            'examinations' => $this->examRepository->paginate(),
        ]);
    }
    public function count(Request $request){
        return response()->json($this->questionRepository->countNumberOfExamQuestion($request));
    }
    public function remainerMark(Request $request){
        return response()->json($this->questionRepository->sumOfRemainingMarks($request));
    }
    public function listOfQuestions($id){
        return view('questions.question_list', [
            'exam' =>  $this->examRepository->get($id),
            'questions' => $this->questionRepository->getAllQuestionOnExam($id),
        ]);
    }
    public function edit($id){
        return view('questions.edit_question', [
            'examinations' => $this->examRepository->all(),
            'question' => $this->questionRepository->get($id),
        ]);
    }
    public function delete($id){
        
    }
    public function update(Request $request){
        $this->questionRepository->update($request);
        return redirect()->back();
    }
}
