<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Notification;
use App\Timeline;
use App\Comment;

use Illuminate\Http\Request;

use Auth;

use Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
        // $this->middleware('admin')->only(['create','store','edit','update','admin','destroy']);
    }

    public function index(){

        $tasks = Task::project()->where('assign_to',Auth::id())->orderByDesc('created_at')->paginate(15);
        
    	return view('pages.tasks.index',compact('tasks'));
    }

    public function create(Request $request){
        $users = User::all();
        $task = new Task;    
    	return view('pages.tasks.admin_create_edit',compact('users','task'));
    }

    public function store(Request $request){
        if(Auth::user()->project_id == 0){
            return redirect()->back()->with('error','You have be a the project');
        }
        if($request->title && $request->description && $request->assign_to){
            $taskInfo = $request->all();
            $taskInfo['user_id'] = Auth::user()->id;
            $taskInfo['user_id'] = Auth::user()->id;
            
            $task = Task::create($taskInfo + ['project_id' => Auth::user()->project_id]);
        }
        return redirect('/task/'.$task->id);
    }

    public function edit($id){
        $task = Task::find($id);
        $users = User::where('project_id',Auth::user()->project_id)->get();

        return view('pages.tasks.admin_create_edit',compact('task','users'));
    }

    public function update($id,Request $request){
        $task = Task::find($id);
        $task->update($request->all());
        return redirect('/task/'.$id);
    }

    public function destroy($id){
        Notification::where('task_id',$id)->delete();
        Timeline::where('task_id',$id)->delete();
        Comment::where('task_id',$id)->delete();
        $task = Task::destroy($id);
        return redirect()->back();
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
        $id = $request->id;
        $task = Task::where('project_id',Auth::user()->project_id)->where('id','LIKE','%'.$id.'%')->limit(5)->get();
        \Log::debug($task);
        return response()->json($task);
    }
    
    public function changeStatus($id,Request $request){
        $task = Task::find($id);
        $task->status = $request->status;
        $task->update();
        return redirect()->back();
    }
    public function admin(){
        $projectTasks = Task::project()->get();

        return view('pages.tasks.admin_index',compact('projectTasks'));
    }

}
