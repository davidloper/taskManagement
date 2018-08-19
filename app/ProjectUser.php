<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
	protected $cast = ['user_level' => 'int'];

	protected $fillable = ['user_id','project_id'];
    public function project(){
    	return $this->belongsTo(Project::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
