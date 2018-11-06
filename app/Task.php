<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Task extends Model
{
    protected $fillable = [
    	'id'
    ];
    
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function assignToUser(){
        return $this->belongsTo(User::class,'assign_to','id');   
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function notification(){
        return $this->hasOne(Notification::class);
    }

    public function scopeUser($query){
        return $query->where('project_id',UserId());
    }

    public function scopeProject($query){
        return $query->where('project_id',projectId());
    }

}
