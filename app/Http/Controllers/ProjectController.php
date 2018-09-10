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
    public function __construct(){
      $this->middleware('auth');
      $this->middleware('admin');
    }
    public function index(){

      $projectUsers = ProjectUser::with('user')->where('project_id',Auth::user()->project_id)->get();
      $project = Project::find(Auth::user()->project_id);
      $projectMessages = ProjectMessage::where('project_id',Auth::user()->project_id)->get();

      $invitedUsers = InviteUser::with('toUser')->with('fromUser')->where('project_id',Auth::user()->project_id)->get();
      // dd($invitedUsers);
      // dd($invitedUsers);
      return view('pages.admins.project_settings.index',compact('projectMessages','projectUsers','project','invitedUsers'));
    }
    public function changeProjectName($id, Request $request){
      $project = Project::find($id);
      $project->name = $request->name;
      $project->update();

      return redirect()->back();
    }
    public function inviteUser (Request $request){
      $user = User::find($request->to_user_id);
      if($user){
        $thisUser = Auth::user();
        $inviteUser = InviteUser::firstOrCreate([
          'project_id' => $thisUser->project_id,
          'to_user_id' => $request->to_user_id,
          'from_user_id' => $thisUser->id,
        ]);

        return redirect()->back()->with('success','invitation has sent');
      }else{
        return redirect()->back()->with('error','User not found');
      }
    }
}
