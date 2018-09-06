<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PunchInOut extends Model
{    
    use SoftDeletes;

    protected $table = 'punch_in_outs';  
  
    protected $dates = ['deleted_at'];
    
       protected $fillable = [
        'punch_justifications_id',
        'punch_timestamp',
        'user_id'
    ];
    

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function punchJustification(){
        return $this->belongsTo('App\PunchJustifications', 'punch_justifications_id');
    }
    
}
