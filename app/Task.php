<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    ];
    
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->hasMany(Comment::class);
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

}
