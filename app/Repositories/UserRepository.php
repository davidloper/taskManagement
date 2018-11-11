<?php
namespace App\Repositories;

use App\User;
use App\ProjectUser;

class UserRepository extends BaseRepository{

  private $projectUser;
  
  function __construct(
    User $model,
    ProjectUser $projectUser
  ){
    $this->model = $model;
    $this->projectUser = $projectUser;
  }

  public function users(){
    $userIDs = $this->projectUser->where('project_id',projectId())->get()->pluck('user_id');
    return $this->model->find($userIDs);
  }

}