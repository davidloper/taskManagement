<?php

namespace App\Http\Controllers;

use App\Task;
use App\Repositories\UserRepository;

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
        // dd($user);
        $this->middleware('auth');
        $this->middleware('admin')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //dd(Carbon::now('Asia/Kuala_Lumpur')->addDay(2));
        // $userId = Auth::user()->id;
        $allTasks = Task::project()->get();

        
        return view('pages.home',compact('completedTask','newTasks','startedTasks','taskStatistic'));
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
