<?php
namespace App\Repositories;

use App\InviteUser;

class InviteUserRepository extends BaseRepository{

  function __construct(InviteUser $model){
    $this->model = $model;
  }
  public function projectWith(){
    return $this->model->with('toUser')->with('fromUser')->where('project_id',projectId())->get();
  }
}