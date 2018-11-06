<?php

/*get current user project id*/
function projectId(){
  return auth()->user()->project_id;
}

/*get user id*/
function userId(){
  return auth()->user()->id;
}

/*get status from config*/
function status($name){
  return config('constants.status.'.$name);
}
function getStatus(int $id){
  $status = config('constants.status');
  return ucwords(array_flip($status)[$id]);
}

/*get priority from config*/
function priority($name){
  return config('constants.priority.'.$name);
}