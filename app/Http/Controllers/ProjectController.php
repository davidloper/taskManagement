<?php

namespace App\Http\Controllers;

use App\ProjectMessage;
use App\ProjectUser;
use App\Project;
use App\User;
use App\InviteUser;
use Illuminate\Http\Request;

use Auth;

class ProjectController extends Controller
{

  function index(){
    $projectUser = ProjectUser::with('project')->where('user_id',Auth::id())->get();
    $userProject = ProjectUser::with('user')
      ->where('user_id','!=',Auth::id())
      ->where('project_id',Auth::user()
      ->project_id)->get();
      $user = Auth::user();
      $invitations = InviteUser::with(['fromUser','project'])->where('to_user_id',Auth::id())->get();
    return view('pages.projects.index',compact('projectUser','userProject','user','invitations'));
  }

  function store(Request $request){
    $project = Project::create($request->all());
    $projectUser = new ProjectUser;
    $projectUser->project_id = $project->id;
    $projectUser->user_id = Auth::id();
    $projectUser->user_level = 2;
    $projectUser->save();
    
    return redirect()->back()->with('success', 'Project successfully created');
  }

  function switchProject (Request $request){
    Auth::user()->project_id = $request->project_id;
    Auth::user()->save();
    return redirect()->back();
  }

  function invitation (Request $request){
      switch($request->type){
          case 'accept':
              $inviteUser = InviteUser::find($request->id);
              $projectUser = new ProjectUser;
              $projectUser->project_id = $inviteUser->project->id;
              $projectUser->user_id = Auth::id();
              $projectUser->user_level = 0;
              $projectUser->save();
              $inviteUser->delete();

              break;
          case 'reject':
              InviteUser::destroy($request->id);
              break;
      }
      $successMsg = 'Invitation successfully '.$request->type.'ed';
      return redirect()->back()->with('success',$successMsg);
  }
}
