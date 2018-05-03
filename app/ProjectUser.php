<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    //
    protected $fillable = [
        'project_id',
        'users_id'
        
    ];}
