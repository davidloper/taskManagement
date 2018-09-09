<?php

namespace App\Http\Controllers;

use App\Task;
use App\ProjectMessage;
use App\Timeline;

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
        $projectMessages = ProjectMessage::where('project_id',Auth::user()->project_id)->get();
        $completedTasks = Task::where('status','Completed')->get();
        $completedTasks = $completedTasks->map(function($value){
            $value->month = ($value->created_at)->format('M');
            return  $value;
        });
        $now = Carbon::now();
        $months = [];
        for($i = 0; $i < 6; $i++){
            
            $num = 0;
            foreach($completedTasks as $task){
                if($task->month == $now->copy()->subMonths($i)->format('M')){
                    $num += 1;
                }
                $months [$now->copy()->subMonths($i)->format('M')] = $num;
            }
        }
        $months = array_reverse($months);
        $timelines = Timeline::orderBy('created_at','desc')->limit(5)->get();
        $tasks = Task::orderBy('created_at','desc')->limit(5)->get();
        $events = $timelines->merge($tasks);
        // dd($timelines,$tasks,$events);
        $events = $events->sortByDesc('created_at');
        $events = $events->take(5);
        return view('pages.home',compact('projectMessages','months','events'));
    }
}
