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
    
@include('pages.tasks.includes.breadcrumb')
<ul class="nav nav-tabs">
	<li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#allTask">All Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#newTask">New Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#startedTask">Started Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#completedTask">Completed Task</a>
    </li>
</ul>
<div class="tab-content" style="margin-top: 20px">

    <div class="tab-pane fade show active" id="allTask">
        <table class="table table-striped">
        	<thead>
        		<tr>
        			<th style="width:8%">Task no.</th>
        			<th style="width:72%">Title</th>
        			<th style="width:20%">Status</th>
        		</tr>
        	</thead>
        	<tbody>
        		{{-- @foreach($task as $val) --}}
        		@foreach($tasks as $task)
        			@php

        				if($task->status === 'New'){
        				$color = 'table-info';
        				}
        				elseif($task->status === 'Started'){
        				$color = 'table-primary';
        				}
        				elseif($task->status === 'Ignored'){
        				$color = 'table-secondary';
        				}
        				elseif($task->status === 'Awaiting Approval'){
        				$color = 'table-warning';
        				}
        				elseif($task->status === 'Rejected'){
        				$color = 'table-danger';
        				}
        				elseif($task->status === 'Approved'){
        				$color = 'table-success';
        				}
        				else{
        					// dd($val->sata)
        					$color = '';
        				}

        			@endphp
        			<tr class="{{$color}}">
        				<td><a href="/task/{{$task->id}}">{{$task->id}}</a></td>
        				<td>{{$task->title}}</td>
        				{{-- <td>{{$task->description}}</td> --}}
        				

        				<td >{{$task->status}}</td>
        			</tr>
        		@endforeach
        	</tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="newTask">
    	<table class="table table-hover">
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
                        <td> {{$task->id}} </td>
                        <td> {{$task->title}} </td>
                        <td class="btn-group">
                            <form method="get" action="/task/{{$task->id}}">
                                {{csrf_field()}}
                                <button class="btn btn-primary"type="submit"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View</button>
                            </form>
                            <form method="post" action="/home/{{$task->id}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <input type="hidden" name="status" value="started">
                                <button class="btn btn-success"type="submit"><i class="far fa-play-circle"></i>&nbsp;Start</button>
                            </form>
                            <form method="post" action="/home/{{$task->id}}">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <input type="hidden" name="status" value="ignored">
                                <button class="btn btn-warning"type="submit"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Ignore</button>
                            </form>
                        </td>
                    </a></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="startedTask">
        <table class="table table-hover">
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
                        <td> {{$task->id}} </td>
                        <td> {{$task->title}} </td>
                        <td class="btn-group">
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="completedTask">
        <table class="table table-hover">
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
                $class = '';
                $task->status === 'Awaiting Approval'? $color = 'table-secondary': '';
                $task->status === 'Rejected'? $color = 'table-danger':'';
                $task->status === 'Approved'? $color = 'table-success':'';
                @endphp
                    <tr class="{{$color}}">
                        <td><a href="/task/{{$task->id}}"> {{$task->id}} </a></td>
                        <td> {{$task->title}} </td>
                        <td>{{$task->status}}</td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function(){
        setTimeout(function(){
            $('.alert').hide('blind',{},500);
        },3000);

    });
</script>
@endsection

