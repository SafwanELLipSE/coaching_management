<?php

namespace App\Http\Repository\Chat;

interface ChatInterface
{
    public function all();
    public function getByClassroom($id);
    public function store($request);
    public function list($request);
    public function update($request);
    public function delete($id);
}
