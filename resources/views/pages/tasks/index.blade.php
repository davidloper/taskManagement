@component('pages.components.card',['title' => 'Task'])
@slot('slot')
<table class="table table-borderless table-striped table-hover">
    <thead>
        <th style="width:1%;"></th>
        <th style="width:10%;"></th>
        <th style="width:10%;">Task #</th>
        <th>Title</th>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr class="pointer" onclick="window.location='/tasks/{{ $task->id }}';">
            <td><h4><i style="color:{{ $task->priority == priority('low')?($task->priority == priority('medium')?'#32CD32':'#F0E68C'):'#FF0000' }}" class="fas fa-poll"></i></h4></td>
            <td><h4><span class="badge badge-secondary">{{ getStatus($task->status_id) }}</span></h4></td>
            <td>#{{ $task->id }}</td>
            <td>{{ $task->title }}</td>   
        </tr>
        @endforeach
    </tbody>
</table>
{{ $tasks->render() }}
@endslot
@endcomponent