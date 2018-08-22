@extends('layouts.layout')

@section('content')
    
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#newTask">New Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#startedTask">Started Task</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#completedTask">Completed Task</a>
    </li>
</ul>
<div class="tab-content" style="margin-top: 20px">
    <div class="tab-pane fade show active" id="newTask">
        <table class="table table-hover">
            <thead>
                @if(!$newTasks->isEmpty())
                    <th style="width:10%;"> No. </th> 
                    <th style="width:30%;"> Title </th>
                    <th style="width:40%;"> Description </th>
                    <th style="width:20%;"></th>
                @else
                    <th class="ta-mid-grey">You have no new task!</th>
                @endif
            </thead>
            <tbody>
                @foreach($newTasks as $task)
                    <tr>
                        <td> {{$task->id}} </td>
                        <td> {{$task->title}} </td>
                        <td> {{$task->description}} </td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="startedTask">
        <table class="table table-hover">
            <thead>
                <tr>
                    @if(!$startedTasks->isEmpty())
                        <th> No. </th>
                        <th> Title </th>
                        <th style="width:600px"> Description </th>
                        <th></th>
                    @else
                        <th class="ta-mid-grey">You have no started task!</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($startedTasks as $task)
                    <tr>
                        <td> {{$task->id}} </td>
                        <td> {{$task->title}} </td>
                        <td> {{$task->description}} </td>
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
                                <button class="btn btn-success"type="submit"><i class="fas fa-paper-plane"></i>Submit</button>
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
                        {{-- <th> User Id </th> --}}
                        <th> Title </th>
                        <th> Description </th>
                        <th>Completed Date</th>
                        <th>Status</th>
                    @else

                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($completedTask as $task)
                @php
                $class = '';
                $task->status === 'Awaiting Approval'? $color = 'info': '';
                $task->status === 'Rejected'? $color = 'danger':'';
                $task->status === 'Approved'? $color = 'success':'';
                @endphp
                    <tr class="{{$color}}">
                        {{-- <td> {{$task->user_id}} </td> --}}
                        <td> {{$task->title}} </td>
                        <td> {{$task->description}} </td>
                        <td>{{$task->updated_at->format('d M Y')}}</td>
                        <td>{{$task->status}}</td>
                        {{-- <hr> --}}
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

