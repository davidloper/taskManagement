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

function getUserLevel(int $id){
  $status = config('constants.userLevel');
  return ucwords(array_flip($status)[$id]);
}

/*get priority from config*/
function priority($name){
  return config('constants.priority.'.$name);
}

function dMY($Ymd){
  return Carbon\Carbon::parse($Ymd)->format('d M Y');
}

function navTitle($segment1){
  return config('constants.navbar2.'.$segment1.'.title');
}

function navChild($segment1){
  return config('constants.navbar2.'.$segment1.'.child');
}