<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectMessageRepository;
use App\Repositories\TaskRepository;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;


class HomeController extends Controller
{
    private $projectMessage;

    private $task;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProjectMessageRepository $projectMessage,
        TaskRepository $task
    )
    {
        $this->middleware('auth');
        $this->projectMessage = $projectMessage;
        $this->task = $task;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(!projectId()) return self::noProjectIndex();

        $messages = $this->projectMessage->messagesGrouped();
        $rejectedTask = $this->task->rejected()->orderBy('updated_at')->limit(10)->get();
        $newtask = $this->task->new()->orderBy('updated_at')->limit(10)->get();
        $startedTask = $this->task->started()->orderBy('updated_at')->limit(10)->get();

        $tasks = collect()->put('Rejected',$rejectedTask)->put('New',$newtask)->put('Started',$startedTask);
        return view('pages.home',compact('messages','tasks'));
    }

    function noProjectIndex(){
        $invitations = InviteUser::where('to_user_id',Auth::id())->get();
        return view ('pages.home_no_project',compact('invitations'));
    }
}
