<?php

namespace App\Http\Controllers;

use App\Task;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $userId = Auth::user()->id;
        $allTasks = Task::all();
        $newTasks = $allTasks->where('ignored','!=',1)->where('started','!=',1)->where('completed','!=',1);
        $startedTasks = $allTasks->where('started',1)->where('completed','!=',1);
        // $ignoredTasks = Task::
        // $taskStatistic;
        $taskStatistic ['ignored'] = Task::where('user_id',$userId)->sum('ignored');
        $taskStatistic ['completed'] = Task::where('user_id',$userId)->sum('completed');
        

        return view('home',compact('allTasks','newTasks','startedTasks','taskStatistic'));
    }
    public function update(Request $request){
        
        $taskId = basename(request()->path());
        // dd('update');
        //dd($request.'->ignored');
        $success = 1;
        if($request->ignored){
            $task = Task::find($taskId);
            $task->ignored = $request->ignored;
            $task->update(); 
        }
        if($request->started){
            $task = Task::find($taskId);
            $task->started = $request->started;
            $task->update();
        }
        if($request->completed){
            $task = Task::find($taskId);
            $task->completed = $request->completed;
            $task->update();
        }
        if($request->remove){
            $task = Task::find($taskId);
            $task->ignored = null;
            $task->started = null;
        }

        $request->session()->flash('success','yayyy success!');
        
    return redirect('home');
    }
}
