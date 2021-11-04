<?php

namespace App\Http\Repository\StudentGrading;

interface StudentGradeInterface
{
    public function all();
    public function get($id);
    public function determineGrade($request);
    public function count();
    public function store($request);
    public function list($request);
    public function update($request);
    public function delete($id);
}
