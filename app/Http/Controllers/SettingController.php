<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\ProjectUser;
use App\User;
use App\InviteUser;

use Auth;

class SettingController extends Controller
{
    function index(){

    	$projectUser = ProjectUser::with('project')->where('user_id',Auth::id())->get();
        // dd($projectUser);
    	$userProject = ProjectUser::with('user')
	    	->where('user_id','!=',Auth::id())
	    	->where('project_id',Auth::user()
	    	->project_id)->get();
        $user = Auth::user();
        $invitations = InviteUser::with(['fromUser','project'])->where('to_user_id',Auth::id())->get();
    	return view('pages.settings.index',compact('projectUser','userProject','user','invitations'));
    }
    function createNewProject(Request $request){
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
    function editUserInfo (Request $request){
        $user = Auth::user();
        switch($request->type){
            case 'username':
                $request->validate([
                    $request->type => 'required|min:6'
                ]);
                break;
            case 'email':
                $request->validate([
                    $request->type => 'required|email'
                ]);
                break;
            case 'password':
                if($request->password == $request->confirmPassword){
                    $request->validate([
                        $request->type => 'required|min:6'
                    ]);
                }else{
                    return redirect()->back()->with('error',' Password does not match');
                }
                break;
        }
        if($request->type == 'email'){
            $user->{$request->type} = Hash::make($request->{$request->type});
        }else{
            $user->{$request->type} = $request->{$request->type};
        }

        $user->save();
        $successMsg = ucfirst($request->type).' Successfully Saved'; 
        return redirect()->back()->with('success',$successMsg);
    }
    function updateInvitation (Request $request){
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
