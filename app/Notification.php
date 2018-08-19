<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
