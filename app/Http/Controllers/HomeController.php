<?php

namespace App\Http\Controllers;

use App\Task;
use App\ProjectMessage;
use App\Timeline;
use App\InviteUser;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(!projectId()) return self::noProjectIndex();
        $messages = ProjectMessage::where('project_id',userId())->orderBy('created_at')->get()->groupBy(function($val){
            return $val->user->name;
        });
        $rejectedTask = Task::project()->user()->where('status_id',status('rejected'))->orderBy('updated_at')->limit(10)->get();
        $newtask = Task::project()->user()->where('status_id',status('new'))->orderByDesc('priority')->limit(10)->get();
        $startedTask = Task::project()->user()->where('status_id',status('started'))->orderBy('created_at')->limit(10)->get();
        $tasks = collect()->put('Rejected',$rejectedTask)->put('New',$newtask)->put('Started',$startedTask);
        return view('pages.home',compact('messages','tasks'));
    }

    function noProjectIndex(){
        $invitations = InviteUser::where('to_user_id',Auth::id())->get();
        return view ('pages.home_no_project',compact('invitations'));
    }
}
