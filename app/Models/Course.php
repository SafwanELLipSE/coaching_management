<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
}
