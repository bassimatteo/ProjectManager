<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PunchJustifications extends Model
{    
    use SoftDeletes;

    protected $table = 'punch_justifications';  
  
    protected $dates = ['deleted_at'];
    
       protected $fillable = [
        'id',
        'name',
        'in_out',
        'visible',
        'visibleDashboard',
        'grouping'
    ]; 

}
