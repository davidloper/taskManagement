<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\TaskRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ProjectUserRepository;
use App\Repositories\ProjectMessageRepository;
use App\Repositories\InviteUserRepository;

use App\Task;
use App\ProjectUser;
use App\ProjectMessage;
use App\Project;
use App\InviteUser;
use Illuminate\Http\Request;

class AdminController extends Controller
{  

  private $task;
  private $user;
  private $project;
  private $projectUser;
  private $projectMessage;
  private $inviteUser;

  function __construct(
    UserRepository $user,
    TaskRepository $task,
    ProjectRepository $project,
    ProjectUserRepository $projectUser,
    ProjectMessageRepository $projectMessage,
    InviteUserRepository $inviteUser
  )
  {
    $this->task = $task;
    $this->user = $user;
    $this->project = $project;
    $this->projectUser = $projectUser;
    $this->projectMessage = $projectMessage;
    $this->inviteUser = $inviteUser;
  }

  function indexTask(){
    $tasks = $this->task->project()->orderByDesc('created_at')->paginate(15);
        
    return view('pages.admins.tasks.index',compact('tasks'));
  }

  function createTask(){
    $users = $this->user->users();
    $task = $this->task->getModel();    
    return view('pages.admins.tasks.create_edit',compact('users','task'));
  }

  function storeTask(Request $request){
    $task = $request->all();
    $task['user_id'] = userId();
    $task['project_id'] = projectId();
    
    $task = $this->task->create($task);
    return redirect('/tasks/'.$task->id);
  }

  function editTask($id,Request $request){
    $task = $this->task->show($id);
    $users = $this->user->users();
    return view('pages.admins.tasks.create_edit',compact('users','task'));
  }

  function updateTask($id,Request $request){
    $task = $this->task->update($request->all(),$id);
    return redirect('/tasks/'.$task);
  }

  function deleteTask($id){
    $this->task->delete($id);
  return redirect('/tasks');
  }

  function editProject(){
    $projectUsers = $this->projectUser->currentProjectUsers();
    $project = $this->project->current();
    $projectMessages = $this->projectMessage->messages();
    $invitedUsers = $this->inviteUser->projectWith();

    return view('pages.admins.projects.edit',compact('projectMessages','projectUsers','project','invitedUsers'));
  }
  function inviteUser(){
    
  }



}
