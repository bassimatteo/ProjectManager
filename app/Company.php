<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'description',
        'users_id'
      ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function projects(){
        return $this->hasMany('App\Project');
    }
    
    public function comment(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}
