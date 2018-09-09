@extends('layouts.layout')

@section('content')
<style>
.w-10{
    width:10% !important;
}
.w-65{
    width:65% !important;
}
.w-25{
    width:25% !important;
}
</style>

<ul class="nav nav-tabs">
	<li class="nav-item">
        <a class="nav-link" data-toggle="tab" onclick="window.location = '#1'" href="#allTask">My Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" onclick="window.location = '#2'" href="#newTask">New Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" onclick="window.location = '#3'" href="#startedTask">Started Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" onclick="window.location = '#4'" href="#completedTask">Completed Task</a>
    </li>
</ul>
<div class="tab-content" style="margin-top: 20px">

    <div class="tab-pane fade show active" id="allTask">
        <table class="table table-striped dataTable">
        	<thead>
        		<tr>
        			<th style="width:8%">Task no.</th>
        			<th style="width:72%">Title</th>
        			<th style="width:20%">Status</th>
        		</tr>
        	</thead>
        	<tbody>
        		@foreach($tasks as $task)
        			<tr>
        				<td><a class="btn btn-secondary btn-sm" href="/task/{{$task->id}}">{{$task->id}}</a></td>
        				<td>{{$task->title}}</td>
                        @php
                        switch($task->status){
                            case 'New':
                                $color = 'primary';
                                break;
                            case 'Started':
                                $color = 'info';
                                break;
                            case 'Ignored':
                                $color = 'warning';
                                break;
                            case 'Completed':
                                $color = 'success';
                                break;
                            default :
                                $color = '';
                        }
                        @endphp
        				<td><button class="btn btn-outline-{{$color}} btn-sm">{{$task->status}}</button></td>
        			</tr>
        		@endforeach
        	</tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="newTask">
    	<table class="table table-striped dataTable">
            <thead>
                @if(!$newTasks->isEmpty())
                    <th class="w-10"> No. </th> 
                    <th class="w-65"> Title </th>
                    {{-- <th style="width:40%;"> Description </th> --}}
                    <th class="w-25"></th>
                @else
                    <th class="ta-mid-grey">You have no new task!</th>
                @endif
            </thead>
            <tbody>
                @foreach($newTasks as $task)
                    <tr> 
                        <td><a class="btn btn-secondary btn-sm" href="/task/{{$task->id}}">{{$task->id}}</a></td>
                        <td> {{$task->title}} </td>
                        <td>
                            <div class="btn-group">
                              <a class="btn btn-secondary btn-sm" type="button" href="/task/{{$task->id}}">
                                View</a>
                              </a>
                              <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <div class="dropdown-menu">
                                {{-- <a class="dropdown-item" href="/task/{{$task->id}}"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View</a> --}}
                                <form method="post" action="/task/{{$task->id}}/change-status/">
                                    {{csrf_field()}}
                                    <input type="hidden" name="status" value="started">
                                    <button class="dropdown-item"type="submit"><i class="far fa-play-circle"></i>&nbsp;Start</button>
                                </form>
                                <form method="post" action="/task/{{$task->id}}/change-status/">
                                    {{csrf_field()}}
                                    <input type="hidden" name="status" value="ignored">
                                    <button class="dropdown-item" type="submit"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Ignore</button>
                                </form>
                              </div>
                            </div>
                        </td>
                        {{-- <td class="btn-group">
                            <a class="btn btn-secondary" href="/task/{{$task->id}}"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View</a>
                            <form method="post" action="/home/{{$task->id}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <input type="hidden" name="status" value="started">
                                <button class="btn btn-secondary"type="submit"><i class="far fa-play-circle"></i>&nbsp;Start</button>
                            </form>
                            <form method="post" action="/home/{{$task->id}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <input type="hidden" name="status" value="ignored">
                                <button class="btn btn-warning"type="submit"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Ignore</button>
                            </form>
                        </td> --}}
                    </a></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="startedTask">
        <table class="table table-striped dataTable">
            <thead>
                @if(!$startedTasks->isEmpty())
                    <th class="w-10" > No. </th>
                    <th class="w-65"> Title </th>
                    <th class="w-25"></th>
                @else
                    <th class="ta-mid-grey">You have no started task!</th>
                @endif
            </thead>
            <tbody>
                @foreach($startedTasks as $task)
                    <tr>
                        <td><a class="btn btn-secondary btn-sm" href="/task/{{$task->id}}">{{$task->id}}</a></td>
                        <td> {{$task->title}} </td>
                        {{-- <td class="btn-group">
                            <form method="get" action="/manageTask/{{$task->id}}">
                                {{csrf_field()}}
                                <button class="btn btn-primary"type="submit"><i class="fa fa-eye" aria-hidden="true"></i>View</button>
                            </form>
                            <form method="post" action="/home/{{$task->id}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <input type="hidden" name="status" value="ignored">
                                <button class="btn btn-warning" type="submit"><i class="fa fa-times" aria-hidden="true"></i>Ignore</button>
                            </form>
                            <form method="post" action="/home/{{$task->id}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <input type="hidden" name="status" value="awaiting approval">
                                <button class="btn btn-success"type="submit"><i class="fas fa-paper-plane"></i>Submit
                                </button>
                            </form>
                        </td> --}}
                        <td>
                            <div class="btn-group">
                              <a class="btn btn-secondary btn-sm" type="button" href="/task/{{$task->id}}">
                                View</a>
                              </a>
                              <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <div class="dropdown-menu">
                                <form method="post" action="/task/{{$task->id}}/change-status/">
                                    {{csrf_field()}}
                                    <input type="hidden" name="status" value="awaiting approval">
                                    <button class="dropdown-item"type="submit"><i class="fas fa-paper-plane"></i>&nbsp;Completed</button>
                                </form>
                                <form method="post" action="/task/{{$task->id}}/change-status/">
                                    {{csrf_field()}}
                                    <input type="hidden" name="status" value="ignored">
                                    <button class="dropdown-item" type="submit"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Ignore</button>
                                </form>
                              </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="completedTask">
        <table class="table table-hover dataTable">
            <thead>
                <tr>
                    @if(!$completedTask->isEmpty())
                        <th class="w-10">No.</th>
                        <th class="w-65"> Title </th>
                        <th class="w-25">Status</th>
                    @else

                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($completedTask as $task)
                @php
                $task->status === 'Awaiting Approval'? $color = 'secondary':'';
                $task->status === 'Rejected'? $color = 'danger':'';
                $task->status === 'Approved'? $color = 'success':'';
                @endphp
                    <tr>
                        <td><a class="btn btn-secondary btn-sm" href="/task/{{$task->id}}">{{$task->id}}</a></td>
                        <td> {{$task->title}} </td>
                        <td><button class="btn btn-outline-{{$color}} btn-sm">{{$task->status}}</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
        url = window.location.href;
        lastChar = url.slice(-1);
        tablinks = $('.nav-tabs').children().children();
        if(!isNaN(lastChar)){
            $(tablinks[lastChar - 1]).addClass('active');
        }
        else{
            $(tablinks[0]).addClass('active');
        }
        setTimeout(function(){
            $('.alert').hide('blind',{},500);
        },3000);

    });
</script>
@endsection

