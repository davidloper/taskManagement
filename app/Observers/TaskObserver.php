<?php

namespace App\Observers;

use App\Task;
use App\Notification;
use App\Timeline;

use Auth;
class TaskObserver
{
    /**
     * Handle to the task "created" event.
     *
     * @param  \App\Task  $task
     * @return void
     */

    public function created(Task $task)
    {   
        if(strlen($task->title) > 50){
            $task->title = substr($task->title, -(50 - strlen($task->title)));
            $task->title = $task->title.'...'; 
        }
        $notification = new Notification;
        $notification->user_id = $task->assign_to;
        $notification->task_id = $task->id;
        $notification->title = $task->title;
        $notification->project_id = $task->project_id;
        $notification->save();

    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function updating(Task $task)
    {
        $originalStatus = $task->getOriginal('status');
        $updatedStatus = $task->getAttribute('status');

        if($originalStatus !== $updatedStatus){
            $user = Auth::user();
            $timeline = new Timeline;
            $timeline->user_id = $user->id;
            $timeline->project_id = $user->project_id;
            $timeline->task_id = $task->id;
            $timeline->action = $updatedStatus;
            $timeline->save();
        }
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        // dd(3);
    }
}
