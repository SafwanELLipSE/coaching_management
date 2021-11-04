<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Examination;
use App\Models\Examination_solution_written;
use App\Models\Examination_solution_mcq;

class Student_grading extends Model
{
    protected $table = 'student_gradings';

    public static function getMarkWritten($examID,$studentID){
        $totalMarks = Examination_solution_written::where('exam_id', $examID)
                        ->where('student_id', $studentID)->sum('obtain_mark');
        return $totalMarks;
    }

    public static function getMarkMCQ($examID, $studentID){
        $totalMarks = Examination_solution_mcq::where('exam_id', $examID)
            ->where('student_id', $studentID)->first();
        return $totalMarks->obtain_mark;
    }

}
