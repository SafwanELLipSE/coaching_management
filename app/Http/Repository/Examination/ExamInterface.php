<?php

namespace App\Http\Repository\Examination;

interface ExamInterface
{
    public function all();
    public function get($id);
    public function count();
    public function paginate();
    public function store($request);
    public function list($request);
    public function update($request);
    public function mcqSolution($request);
    public function markWritten($request);
    public function statusOfSimilarClassroom($request);
    public function markExamsClassroom($request);
    public function delete($id);
}
