<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $table = 'examinations';
    // status
    const ACTIVE = 1;
    const INACTIVE = 0;
    //Exam type
    const type_WRITTEN = 1;
    const type_MCQ = 2;

    public function classroom()
    {
        return $this->hasOne(Classroom::class, 'id', 'classroom_id');
    }

    public function question()
    {
        return $this->hasMany(Question::class, 'examination_id');
    }
    public static function getType($type_id)
    {
        switch ($type_id) {
            case 1:
                return "<span class='text-bold'> Written </span>";
            case 2:
                return "<span class='text-bold'> MCQ </span>";;
        }
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
