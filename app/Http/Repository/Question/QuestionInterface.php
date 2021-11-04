<?php

namespace App\Http\Repository\Question;

interface QuestionInterface
{
    public function all();
    public function get($id);
    public function count();
    public function countNumberOfExamQuestion($request);
    public function sumOfRemainingMarks($request);
    public function store($request);
    public function list($request);
    public function update($request);
    public function delete($id);
}
