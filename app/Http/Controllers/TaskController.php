<?php

namespace App\Http\Controllers;

use\App\Task;
use\App\User;

use Illuminate\Http\Request;

use Auth;

use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(){
        $tasks = Task::all();
        $tasks = $tasks->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('M Y');
        });
        //dd($tasks);

        // dd($task);
    	return view('pages.tasks.index',compact('tasks'));
    }
    public function create(Request $request){
        $users = User::all();
    	return view('pages.tasks.create',compact('users'));
    }
    public function store(Request $request){
        if($request->title && $request->description && $request->assign_to){
            $taskInfo = $request->all();
            //dd($taskInfo);
            $taskInfo['user_id'] = Auth::user()->id;
            

            Task::create($taskInfo);


            return redirect('/home');
        }
    }
    public function show($id,Request $request){
        $task = Task::find($id);

        return view('pages.tasks.show',compact('task'));
    }

}
