<?php
namespace App\Repositories;

use App\ProjectMessage;

class ProjectMessageRepository extends BaseRepository{

  function __construct(ProjectMessage $model){
    $this->model = $model;
  }

  public function messagesGrouped (){
    return $this->model->where('project_id',userId())->orderBy('created_at')->get()->groupBy(function($val){
      return $val->user->name;
    });
  }

  public function messages(){
    return $this->model->where('project_id',projectId())->get();
  }
}