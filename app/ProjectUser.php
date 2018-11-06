<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
	protected $cast = ['user_level' => 'int'];

	protected $guarded = ['id'];
    public function project(){
    	return $this->belongsTo(Project::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
