<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name', 
        'description',
        'days',
        'company_id',
        'users_id'
        
    ];
    
    public function user(){
        return $this->belongsToMany('App\User');
    }
    
    public function company(){
        return $this->belongsTo('App\Company');
    }
    
    public function comment(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}
