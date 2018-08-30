<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = [
		'task_id',
		'user_id',
		// 'title',
		'comment',
		// 'description',
	];

	public function user(){
		return $this->belongsTo(new User);
	}
}
