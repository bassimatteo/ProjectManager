<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    //
    protected $fillable = [
        'users_id',
        'task_id'
    ];
}
