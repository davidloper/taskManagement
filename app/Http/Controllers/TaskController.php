<?php

namespace App\Http\Controllers;

use\App\Task;
use\App\User;
use App\Comment;

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

    	return view('pages.tasks.index',compact('tasks'));
    }
    public function create(Request $request){
        $users = User::all();
    	return view('pages.tasks.create',compact('users'));
    }
    public function store(Request $request){
        if(Auth::user()->project_id == 0){
            return redirect()->back()->with('error','You have be a the project');
        }
        if($request->title && $request->description && $request->assign_to){
            $taskInfo = $request->all();
            $taskInfo['user_id'] = Auth::user()->id;
            $taskInfo['user_id'] = Auth::user()->id;
            
            Task::create($taskInfo + ['project_id' => Auth::user()->project_id]);


            return redirect('/home');
        }
    }
    public function show($id,Request $request){
        $task = Task::find($id);
        $notification = $task->notification;
        $notification->seen = 1;
        $notification->save();
        
        $comments = $task->comment;

        return view('pages.tasks.show',compact('task','comments'));
    }
    public function autoComplete(Request $request){
        // \Log::debug($request);
        $id = $request->id;
        $task = Task::where('id','LIKE','%'.$id.'%')->limit(5)->get();
        \Log::debug($task);
        return response()->json($task);
    }

}
