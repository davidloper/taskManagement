@extends('layouts.layout')
@section('content')
  <div class="container con-min-height top-spacing-l">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
           Project Invitation 
          </div>
          <div class="card-body">
            @foreach($invitations as $invitation)
              <div class="form-inline">
                <p>{{$invitation->fromUser->username}} invited You to join {{$invitation->project->name}}
                  <form action="/home/projects/invitation" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$invitation->id}}">
                    <input type="hidden" name="type" value="accept">
                    &nbsp;<button type="submit" class="btn btn-success">Accept</button>
                  </form>
                  <form action="/home/projects/invitation" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$invitation->id}}">
                    <input type="hidden" name="type" value="reject">
                    &nbsp;<button type="submit" class="btn btn-danger">Reject</button>
                  </form>
                </p>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            Create New Project
          </div>
          <div class="form-inline">
            <div class="card-body">
              <form action="/home/projects" method="post">
                {{csrf_field()}}
                <input class="form-control" type="text" placeholder="Project Name" name="name">
                <input class="btn" type="submit">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            Switch Project
          </div>
          <div class="form-inline">
            <div class="card-body">
              <form action="/home/projects/switch-project" method="post">
                {{csrf_field()}}
                <select class="form-control" name="project_id">
                  <option value="0">-- Not in Project --</option>
                  @forelse($projectUser as $val)
                    @php
                    $val->project->id == Auth::user()->project_id? $selected = 'selected': $selected = '';
                    @endphp
                    <option value="{{$val->project->id}}" {{$selected}}>{{$val->project->name}}</option>
                  @empty
                    You have no project
                  @endforelse
                </select>
                <input class="btn" type="submit">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection