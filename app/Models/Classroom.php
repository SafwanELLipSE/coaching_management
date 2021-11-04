<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Classes;
use App\Models\Course;
use App\Models\Teacher;
class Classroom extends Model
{
    protected $table = 'classrooms';
    const ACTIVE = 1;
    const INACTIVE = 0;

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }
    public function examination()
    {
        return $this->belongsTo(Classroom::class);
    }
    public static function getStatus($status_id)
    {
        switch ($status_id) {
            case 0:
                return "<span class='badge badge-danger'> Inactive </span>";
            case 1:
                return "<span class='badge badge-success'> Active </span>";;
        }
    }
}
