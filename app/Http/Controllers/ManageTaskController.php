<?php

namespace App\Http\Controllers;

use\App\Task;
use Illuminate\Http\Request;

use Auth;

class ManageTaskController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
    	return view('pages.manageTasks.index');
    }
    public function create(Request $request){
    	if($request->title && $request->description){
    		$taskInfo = $request->all();

    		$taskInfo['user_id'] = Auth::user()->id;
    		

    		Task::create($taskInfo);


    		return redirect('/home');
    	}
    	return view('pages.manageTasks.create');
    }
    public function update(Request $request){

    }
    public function show(Request $request){
        dd('show');
    }

}
