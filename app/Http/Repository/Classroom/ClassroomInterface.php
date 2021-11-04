<?php

namespace App\Http\Repository\Classroom;

interface ClassroomInterface
{
    public function all();
    public function get($id);
    public function getSameClassCourseStudent($id);
    public function listOfEnrolledStudent($id);
    public function listOfStudentForMarking($id);
    public function listOfExams($id);
    public function count();
    public function store($request);
    public function list($request);
    public function update($request);
    public function delete($request, $id);
    public function enrollNewStudent($request);
    public function status($id);
    public function removeEnrolledStudent($id);
    public function makeVideoRoom($request);
    public function deleteMeetingroom($id);
    public function updateMeetingroom($request);
}
