<?php

namespace App\Http\Repository\Grade;

interface GradeInterface
{
    public function all();
    public function get($id);
    public function count();
    public function store($request);
    public function list($request);
    public function update($request);
    public function delete($id);
}
