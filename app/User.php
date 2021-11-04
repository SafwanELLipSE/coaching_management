<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Student;
use App\Models\Teacher;
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    const ACCESS_LEVEL_MASTER_ADMIN = 'master_admin';
    const ACCESS_LEVEL_ACCOUNTS = 'account';
    const ACCESS_LEVEL_TEACHER = 'teacher';
    const ACCESS_LEVEL_STUDENT = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isMasterAdmin()
    {
        return in_array($this->access_level, [self::ACCESS_LEVEL_MASTER_ADMIN]);
    }
    public function isStudent()
    {
        return in_array($this->access_level, [self::ACCESS_LEVEL_STUDENT]);
    }
    public function isTeacher()
    {
        return in_array($this->access_level, [self::ACCESS_LEVEL_TEACHER]);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id','id');
    }
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id','id');
    }
}
