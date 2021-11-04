<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    const ACTIVE = 1;
    const INACTIVE = 0;

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
