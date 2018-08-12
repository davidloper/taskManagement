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
        $notication = new Notification;
        $notication->user_id = $task->assign_to;
        $notication->task_id = $task->id;
        $notication->title = $task->title;
        $notication->description = $task->description;
        $notication->save();

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
