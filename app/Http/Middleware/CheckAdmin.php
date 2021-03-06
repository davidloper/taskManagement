<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

use App\ProjectUser;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $projectId = Auth::user()->project_id;
        $projectUser = ProjectUser::where('project_id',$projectId)->where('user_id',Auth::id())->first();

        if($projectUser && $projectUser->user_level > 0){
            return $next($request);
        }else{
            return redirect('/home');
        }
    }
}
