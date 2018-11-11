@component('pages.components.card',['title' => 'Task'])
@slot('slot')
<table class="table table-borderless table-striped table-hover">
    <tbody>
        @foreach($tasks as $task)
        <tr class="pointer" onclick="window.location='/tasks/{{ $task->id }}';">
            <td style="width:1%;"><h4><i style="color:{{ $task->priority == priority('low')?($task->priority == priority('medium')?'#32CD32':'#F0E68C'):'#FF0000' }}" class="fas fa-poll"></i></h4></td>
            <td style="width:10%;"><h4><span class="badge badge-secondary">{{ getStatus($task->status_id) }}</span></h4></td>
            <td>
                <span class="task-l-b">#{{ $task->id.'. ' }}</span><span class="task-l">{{ $task->title }}</span>
                <br>
                <span class="task-xs">{{ dMY($task->created_at) }}</span>
            </td>   
        </tr>
        @endforeach
    </tbody>
</table>
{{ $tasks->render() }}
@endslot
@endcomponent