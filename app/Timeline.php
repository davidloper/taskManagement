<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = [
      'id'
    ]; 

    public function user(){
      return $this->belongsTo(User::class);
    }
     
    public function task(){
      return $this->belongsTo(Task::class);
    }  
}
