@extends('layouts.layout')

@section('content')

<table class="dataTable table-striped">
  <thead>
    <tr>
      <th style="width:8%">Task no.</th>
      <th style="width:16%">Username</th>
      <th style="width:50%">Title</th>
      <th style="width:13%">Status</th>
      <th style="width:13%">action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($projectTasks as $task)
      <tr>
        <td><a class="btn btn-secondary" href="/task/{{$task->id}}">{{$task->id}}</td>
        <td>{{$task->assignToUser->name}}</td>
        <td>{{$task->title}}</td>
        <td>
          @if($task->status == 'Awaiting Approval')
            <div class="dropdown">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                {{$task->status}}
              </button>
              <div class="dropdown-menu">
                <form method="post" action="/task/{{$task->id}}/change-status">
                  {{csrf_field()}}
                  <input type="hidden" name="status" value="approved">
                  <button type="submit" class="dropdown-item">Approve</button>
                </form>
                <form method="post" action="/task/{{$task->id}}/change-status">
                  {{csrf_field()}}
                  <input type="hidden" name="status" value="rejected">
                  <button type="submit" class="dropdown-item">Reject</button>
                </form>
              </div>
            </div>
          @else
            <button class="btn btn-outline-secondary">{{{$task->status}}}</button>
          @endif
        </td>
        <td>
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Option
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/task/{{$task->id}}/edit">Edit</a>
              <form method="post" action="/task/{{$task->id}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="delete">
                <input type="submit" class="dropdown-item" value="Delete">
              </form>
            </div>
          </div>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection