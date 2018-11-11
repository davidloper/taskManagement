<?php
namespace App\Repositories;

use App\ProjectUser;

class ProjectUserRepository extends BaseRepository{

  function __construct(ProjectUser $model){
    $this->model = $model;
  }

  public function currentProjectUsers(){
    return $this->model->with('user')->where('project_id',projectId())->get();
  } 
}