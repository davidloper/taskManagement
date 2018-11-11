<?php

namespace App\Http\Controllers;

// use App\Task;
use App\Repositories\TaskRepository;
use App\User;
use App\Notification;
use App\Timeline;
use App\Comment;

use Illuminate\Http\Request;

use Auth;

use Carbon\Carbon;

class TaskController extends Controller
{   
    private $task;

    public function __construct(TaskRepository $task){
    	$this->middleware('auth');
        $this->task = $task;
    }

    public function index(){

        $tasks = $this->task->user()->orderByDesc('created_at')->paginate(15);
        
    	return view('pages.tasks.index',compact('tasks'));
    }

    public function show($id,Request $request){
        $task = $this->task->show($id);

        // $notification = $task->notification;
        // $notification->seen = 1;
        // $notification->save();
        
        $comments = $task->comments;

        return view('pages.tasks.show',compact('task','comments'));
    }

    public function update($id,Request $request){
        $this->task->updateStatus($id,$request->status_id);

        return redirect()->back();
    }
}
