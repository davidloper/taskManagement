@extends('layouts.layout')
@section('content')
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#project-setting">Project Setting</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#account-setting">Account Setting</a>
  </li>
</ul>
<div class="tab-content" style="margin-top: 20px">
  <div class="tab-pane fade show active" id="project-setting">
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
                  <form action="/setting/invitation" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$invitation->id}}">
                    <input type="hidden" name="type" value="accept">
                    &nbsp;<button type="submit" class="btn btn-success">Accept</button>
                  </form>
                  <form action="/setting/invitation" method="post">
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
              <form action="/setting/createNewProject" method="post">
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
              <form action="/setting/switchProject" method="post">
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
  <div class="tab-pane fade show" id="account-setting">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            Account Info
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <th>User ID</th>
                <th>Email</th>
                <th>Username</th>
              </thead>
              <tbody>
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->username}}</td>
                </tr>
              <tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            Change Password
          </div>
          <div class="form-inline">
            <div class="card-body">
              <form action="/setting/user/" method="post">
                {{csrf_field()}}
                <input class="form-control" type="password" placeholder="Password" name="password">
                <input class="form-control" type="password" placeholder="Confirm Password" name="confirmPassword">
                <input type="hidden" name="type" value="password">
                <input type="submit" class="btn">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            Change Username
          </div>
          <div class="form-inline">
            <div class="card-body">
              <form action="/setting/user/" method="post">
                {{csrf_field()}}
                <input class="form-control" type="text" placeholder="Username" name="username">
                <input type="hidden" name="type" value="username">
                <input type="submit" class="btn">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-header">
            Change Email
          </div>
          <div class="form-inline">
            <div class="card-body">
              <form action="/setting/user/" method="post">
                {{csrf_field()}}
                <input class="form-control" type="text" placeholder="Email" name="email">
                <input type="hidden" name="type" value="email">
                <input type="submit" class="btn">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 