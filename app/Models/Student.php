<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Course;
class Student extends Model
{
    protected $table = 'students';
    const ACTIVE = 1;
    const INACTIVE = 0;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function class()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
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
