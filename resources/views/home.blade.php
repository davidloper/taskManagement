@extends('layouts.layout')

@section('content')

    <style>
        .pad-top-3p{
            padding-top:3%;
        }
    </style>
    <div class="container">
        {{-- {{dd($success)}} --}}
        @if(session('success'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{session('success')}}
        </div>
        @endif
        <div class="row pad-top-3p">
            <div class="col-lg-6">
                <div class="card card-body bg-light">
                    New Task
                    <hr>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    User Id
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Description
                                </th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach($newTasks as $task)
                                <tr>
                                    <td>
                                        {{$task->user_id}}
                                    </td>
                                    <td>
                                        {{$task->title}}
                                    </td>
                                    <td>
                                        {{$task->description}}
                                    </td>
                                    <td>
                                        <form method="get" action="/manageTask/{{$task->id}}">
                                            {{csrf_field()}}
                                            <button type="submit">View</button>
                                        </form>
                                        <form method="post" action="/home/{{$task->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="started" value="1">
                                            <button type="submit">Start</button>
                                        </form>
                                        <form method="post" action="/home/{{$task->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="ignored" value="1">
                                            <button type="submit">Ignore</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-body bg-light">
                    Started Task
                    <hr>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    User Id
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Description
                                </th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach($startedTasks as $task)
                                <tr>
                                    <td>
                                        {{$task->user_id}}
                                    </td>
                                    <td>
                                        {{$task->title}}
                                    </td>
                                    <td>
                                        {{$task->description}}
                                    </td>
                                    <td>
                                        <form method="get" action="/manageTask/{{$task->id}}">
                                            {{csrf_field()}}
                                            <button type="submit">View</button>
                                        </form>
                                        <form method="post" action="/home/{{$task->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="remove" value="1">
                                            <button type="submit">Remove</button>
                                        </form>
                                        <form method="post" action="/home/{{$task->id}}">
                                            {{csrf_field()}}
                                            {{method_field('PATCH')}}
                                            <input type="hidden" name="completed" value="1">
                                            <button type="submit">Completed</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row pad-top-3p">
            <div class="col-lg-12 ">
                <div class="card card-block bg-faded">
                    Timeline $ statistics
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Total Task Ignored
                                </th>
                                <th>
                                    Total Task completed
                                </th>
                            <tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{$taskStatistic['ignored']}}
                                </td>
                                <td>
                                    {{$taskStatistic['completed']}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row pad-top-3p">
            <div class="col-lg-12">
                <div class="card card-body bg-light">
                    All Task
                    <hr>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    User Id
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Description
                                </th>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach($allTasks as $task)
                                <tr>
                                    <td>
                                        {{$task->user_id}}
                                    </td>
                                    <td>
                                        {{$task->title}}
                                    </td>
                                    <td>
                                        {{$task->description}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection