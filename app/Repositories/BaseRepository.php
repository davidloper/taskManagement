<?php

namespace App\Repositories;

abstract class BaseRepository{
  protected $model;

  public function all(){
    return $this->model->all();
  }

  public function create(array $data){
    return $this->model->create($data);
  }

  public function update(array $data, $id){
    $record = $this->show($id);
    $record->update($data);
    return $record;
  }

  public function delete($id){
    return $this->model->destroy($id);
  }

  public function show($id){
    return $this->model->findOrFail($id);
  }

  public function getModel(){
    return $this->model;
  }

  public function setModel($model){
    $this->model = $model;
    return $this;
  }

  public function with($relations){
    return $this->model->with($relations);
  }

}