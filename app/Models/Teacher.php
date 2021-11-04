<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Teacher extends Model
{
    protected $table = 'teachers';
    const ACTIVE = 1;
    const INACTIVE = 0;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
