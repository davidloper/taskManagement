<?php

namespace App\Http\Controllers;

use App\Task;

use Illuminate\Http\Request;
use Carbon\Carbon;
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
        //dd(Carbon::now('Asia/Kuala_Lumpur')->addDay(2));
        $userId = Auth::user()->id;
        $allTasks = Task::all();

        $completedTask = Task::where('status','awaiting approval')->orWhere('status','rejected')->orWhere('status','approved')->get();

        $newTasks = $allTasks->where('status','new');
        $startedTasks = $allTasks->where('status','started');
        // $ignoredTasks = Task::
        // $taskStatistic;
        //$taskStatistic ['ignored'] = Task::where('user_id',$userId)->sum('ignored');
        //$taskStatistic ['completed'] = Task::where('user_id',$userId)->sum('completed');

        // dd($newTasks);
        

        return view('home',compact('completedTask','newTasks','startedTasks','taskStatistic'));
    }
    public function update(Request $request){
        
        $taskId = basename(request()->path());
    
        if($request->status === 'ignored'){
            self::updateStatus($taskId,$request);
            $request->session()->flash('success','Task Successfully Ingored!');
        }
        if($request->status === 'started'){
            self::updateStatus($taskId,$request);
            $request->session()->flash('success','Task Successfully Started!');
        }
        if($request->status === 'awaiting approval'){
            self::updateStatus($taskId,$request);
            $request->session()->flash('success','Task Successfully Completed!');
        }
        if($request->status === 'removed'){
            self::updateStatus($taskId,$request);
            $request->session()->flash('success','Task Successfully Removed!');
        }

        $request->session()->flash('error','Something went wrong!');
        
    return redirect('home');
    }
    function updateStatus($taskId,$request){
        $task = Task::find($taskId);
            $task->status = $request->status;
            $task->update();
    }
}
