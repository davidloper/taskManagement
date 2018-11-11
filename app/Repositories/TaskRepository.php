<?php
namespace App\Repositories;

use App\Task;

class TaskRepository extends BaseRepository{

  function __construct(Task $model){
    $this->model = $model;
  }

  public function rejected(){
    return $this->model->project()->user()->where('status_id',status('rejected'));
  }

  public function new(){
    return $this->model->project()->user()->where('status_id',status('new'));
  }

  public function started(){
    return $this->model->project()->user()->where('status_id',status('started'));
  }

  public function user(){
    return $this->model->project()->user();
  }

  public function project(){
    return $this->model->project();
  }

  public function updateStatus($taskID,$statusID){
    $task = $this->show($taskID);
    $task->status_id = $statusID;
    return $task->update();
  }

}