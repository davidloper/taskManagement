<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\ProjectUser;
use App\User;

use Auth;

class SettingController extends Controller
{
    function index(){

    	$projectUser = ProjectUser::with('project')->where('user_id',Auth::id())->get();
    	$userProject = ProjectUser::with('user')
	    	->where('user_id','!=',Auth::id())
	    	->where('project_id',Auth::user()
	    	->project_id)->get();
    	return view('pages.settings.index',compact('projectUser','userProject'));
    }
    function createNewProject(Request $request){
    	// dd($request);
    	$project = Project::create($request->all());
    	$projectUser = new ProjectUser;
    	$projectUser->project_id = $project->id;
    	$projectUser->user_id = Auth::id();
    	$projectUser->user_level = 1;
    	$projectUser->save();
    	
    	return redirect()->back();
    }
    function switchProject (Request $request){
    	Auth::user()->project_id = $request->project_id;
    	Auth::user()->save();
    	return redirect()->back();
    		// dd(Auth::user());
    }
    function findProject (Request $request){
    	//just add project for now
    	// dd(Auth::user()->project_id);
    	Auth::user()->project_id = $request->project_id;
    	Auth::user()->save();

    	return redirect()->back();
    }
    function findUser (Request $request){
    	$user = User::find($request->user_id);
    	// dd($user);
    	if($user){
    		// dd(Auth::user()->project_id);
    		$projectUser = ProjectUser::firstOrNew(['user_id' => $user->id],['project_id' => Auth::user()->project_id]);
    		$projectUser->save();
    	}

    	return redirect()->back();
    }
}
