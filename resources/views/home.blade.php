@extends('layouts.layout')

@section('content')
    
    <style>
        .pad-top-3p{
            padding-top:3%;
        }
        .ta-mid-grey{
            text-align: center;
            color: lightgrey;
            font-size: 25px;
        }

        .status-btn{
            cursor:default !important;
            /*padding:1px 5px 1px;*/
        }
    </style>
    {{-- {{dd(route('task.test'))}} --}}
    <div class="container-fluid">
        {{-- {{dd($success)}} --}}
        @if(session('success'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{session('success')}}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger">
            <strong>Error!</strong>{{session('error')}}
        </div>
        @endif
        <div class="row pad-top-3p">
            <div class="col-lg-12">
                <div class="card card-body bg-light">
                    <a class="text-info"><h4><strong>New Task</strong></h4></a>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @if(!$newTasks->isEmpty())
                                    <th> No. </th> 
                                    <th> Title </th>
                                    <th> Description </th>
                                    <th></th>
                                @else
                                <th class="ta-mid-grey">You have no new task!</th>
                                @endif
                             <tr>
                        </thead>
                        <tbody>
                            {{-- {{dd($newTasks)}} --}}
                            @foreach($newTasks as $task)
                                <tr>
                                    <td> {{$task->id}} </td>
                                    <td> {{$task->title}} </td>
                                    <td> {{$task->description}} </td>
                                    <td class="btn-group">
                                        <form method="get" action="/task/{{$task->id}}">
                                            {{csrf_field()}}
                                            <button type="submit">View</button>
                                        </form>
                                        <form method="post" action="/home/{{$task->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="status" value="started">
                                            <button type="submit">Start</button>
                                        </form>
                                        <form method="post" action="/home/{{$task->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="status" value="ignored">
                                            <button type="submit">Ignore</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-body bg-light">
                    <a class="text-primary"><h4><strong>Started Task</strong></h4></a>
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
                            <tr>
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
                                            <button class="btn btn-secondary"type="submit"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                        </form>
                                        <form method="post" action="/home/{{$task->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="status" value="ignored">
                                            <button class="btn btn-secondary" type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        </form>
                                        <form method="post" action="/home/{{$task->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="status" value="awaiting approval">
                                            <button class="btn btn-secondary"type="submit"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="row pad-top-3p">
            <div class="col-lg-12 ">
                <div class="card card-block bg-faded">
                    Timeline $ statistics
                    <table>
                        <thead>
                            <tr>
                                <th> Total Task Ignored </th>
                                <th> Total Task completed </th>
                            <tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> {{$taskStatistic['ignored']}} </td>
                                <td> {{$taskStatistic['completed']}} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
        <div class="row pad-top-3p">
            <div class="col-lg-12">
                <div class="card card-body bg-light">
                    <a class="text-success"><h4><strong>Completed Task</strong></h4></a>
                    <table class="table">
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
                            <tr>
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

