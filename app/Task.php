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
}
