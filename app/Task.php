<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Task extends Model
{
    protected $fillable = [
    	'user_id',
    	'title',
    	'description',
    	'assign_to',
    	'priority',
    	'duration_number',
    	'duration_type',
    	'status',
        'project_id',
    ];
    
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function notification(){
        return $this->hasOne(Notification::class);
    }

    public function getPriorityAttribute($value){
        if($value == 1){
            return 'Low';
        }elseif($value == 2){
            return 'Medium';
        }elseif($value == 3){
            return 'High';
        }
    }
    public function getStatusAttribute($value){
        return ucwords($value);
    }
    public function scopeProject($query){
        return $query->where('project_id',Auth::user()->project_id);
    }

}
