<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Teacher;

class Classroom_group_chat extends Model
{
    protected $table = 'classroom_group_chats';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function teacherData()
    {
        return $this->hasOneThrough(User::class, Teacher::class);
    }
}
