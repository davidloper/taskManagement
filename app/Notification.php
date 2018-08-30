<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Notification extends Model
{
    protected $fillable = [
    	'user_id',
    	'task_id',
		'title',
		'description',
	];
	public function scopeNotSeen($query){
		return $query->where('seen',0);
	}
	public function scopeProject($query){
		return $query->where('project_id',Auth::user()->project_id);
	}
}
