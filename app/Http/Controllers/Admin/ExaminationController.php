<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Examination\ExamInterface;
use App\Http\Repository\Classroom\ClassroomInterface;
use App\Http\Repository\Question\QuestionInterface;
use PDF;
class ExaminationController extends Controller
{
    public function __construct(ExamInterface $examRepository, ClassroomInterface $classroomRepository, QuestionInterface $questionRepository)
    {
        $this->examRepository = $examRepository;
        $this->classroomRepository = $classroomRepository;
        $this->questionRepository = $questionRepository;
    }
    public function index()
    {
        return view('examinations.create_exam',[
            'classrooms' => $this->classroomRepository->all(),
            'count' => $this->examRepository->count(),
        ]);
    }
    public function store(Request $request)
    {
        $this->examRepository->store($request);
        return redirect()->back();
    }
    public function allExamination(Request $request)
    {
        return view('examinations.all_exam',[
            'classrooms' => $this->classroomRepository->all(),
            'count' => $this->examRepository->count(),
        ]);
    }
    public function list(Request $request){
        echo json_encode($this->examRepository->list($request));
    }
    public function display($id){
        return view('examinations.display_exam', [
            'exam' => $this->examRepository->get($id),
        ]);
    }
    public function edit($id){
        return view('examinations.edit_exam', [
            'exam' => $this->examRepository->get($id),
            'classrooms' => $this->classroomRepository->all(),
        ]);
    }
    public function update(Request $request){
        $this->examRepository->update($request);
        return redirect()->back();
    }
    public function printWrittenQuestion($id){
        // return view('questions.written_question_pdf', [
        //     'exam' => $this->examRepository->get($id),
        //     'questions' => $this->questionRepository->getAllQuestionOnExam($id),
        // ]);
        
        $pdf = PDF::loadView('questions.written_question_pdf', [
            'exam' => $this->examRepository->get($id),
            'questions' => $this->questionRepository->getAllQuestionOnExam($id),
        ])->setPaper('a4');
        return $pdf->download('app_' . $id . 'written_question.pdf');
    }
    public function mcqExamination($id){
        return view('questions.MCQ_question', [
            'exam' => $this->examRepository->get($id),
            'questions' => $this->questionRepository->getAllQuestionOnExam($id),
        ]);
    }
    public function mcqExamSubmission(Request $request){
        $this->examRepository->mcqSolution($request);
        return redirect()->back();
    }
    public function markingWrittenExam(Request $request, $id){
        // dd($this->classroomRepository->listOfStudentForMarking($id));
        return view('examinations.written_exam_marking', [
            'exam' => $this->examRepository->get($id),
            'questions' => $this->questionRepository->getAllQuestionOnExam($id),
            'enrolledStudentLists' => $this->classroomRepository->listOfStudentForMarking($id),
        ]);
    }
    public function submitWrittenMarks(Request $request){
        $this->examRepository->markWritten($request);
        return redirect()->back();
    }

    public function statusCountSimilarClassroom(Request $request){
        return response()->json($this->examRepository->statusOfSimilarClassroom($request));
    }
    public function markCheckClassroom(Request $request)
    {
        return response()->json($this->examRepository->markExamsClassroom($request));
    }
}
