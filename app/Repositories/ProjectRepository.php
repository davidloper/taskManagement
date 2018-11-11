<?php
namespace App\Repositories;

use App\Project;

class ProjectRepository extends BaseRepository{

  private $project;
  
  function __construct(
    Project $project
  )
  {
    $this->project = $project;
  }

  public function current(){
    return auth()->user()->project;
  }

}