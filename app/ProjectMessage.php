<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMessage extends Model
{
  protected $fillable = [
    'id'
  ];

  function user()
  {
    return $this->belongsTo(User::class);
  }
}
