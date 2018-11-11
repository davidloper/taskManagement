<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'title',
    	'description',
        'assign_to',
        'priority',
        'duration_number',
        'duration_type',
        'status_id',

    ];
    
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function assignToUser(){
        return $this->belongsTo(User::class,'assign_to','id');   
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function notification(){
        return $this->hasOne(Notification::class);
    }

    public function scopeUser($query){
        return $query->where('assign_to',UserId());
    }

    public function scopeProject($query){
        return $query->where('project_id',projectId());
    }

}
