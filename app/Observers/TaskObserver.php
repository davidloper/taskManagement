<?php

namespace App\Observers;

use App\Task;
use App\Notification;

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
            // dd($task->title);
            // dd(strlen($task->title));
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
    public function updated(Task $task)
    {
        // dd(2);
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
