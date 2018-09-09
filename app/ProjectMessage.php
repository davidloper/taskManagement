<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMessage extends Model
{
    protected $fillable = [
      'project_id',
      'message'
    ];
}
