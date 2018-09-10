@extends('layouts.layout')
@section('content')

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#project-setting">Project Setting</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#project-message">Project Message</a>
  </li>
</ul>

<div class="tab-content" style="margin-top: 20px">
  <div class="tab-pane fade show active" id="project-setting">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            Manage User
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <th style="width:10%">No.</th>
                <th style="width:20%">Name</th>
                <th>User Level</th>
              </thead>
              <tbody>
                @foreach($projectUsers as $key => $user)
                @php
                $key += 1;
                @endphp
                  <tr>
                    <td>{{$key}}</td>
                    <td>{{$user->user->name}}</td>
                    @php
                    $user->user_level == 1? $level = 'Admin': $level = "Moderator";
                    @endphp
                    <td>{{$level}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            Invite User
          </div>
          <div class="form-inline">
            <div class="card-body">
              <form action="/admin/project-setting/invite-user" method="post">
                @csrf
                <input style="width:50% "class="form-control" placeholder="User ID" type="text" name="to_user_id">
                <input class="btn" type="submit" value="Invite">
              </form> 
            </div>
          </div>
          <div class="card">
          @forelse($invitedUsers as $invitedUser)
            <div class="card-body">
              <p>{{$invitedUser->fromUser->username}} has invited {{$invitedUser->toUser->username}}</p>
            </div>
          @empty
            <p>Nobody is invited</p>
          @endforelse
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            Change Project Name
          </div>
          <div class="form-inline">
            <div class="card-body">
              <form action="/admin/project-setting/name/{{$project->id}}" method="post">
                @csrf
                <input style="width:50% "class="form-control" placeholder="Project Name" type="text" name="name" value="{{$project->name}}">
                <input class="btn" type="submit" value="Confirm">
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade show" id="project-message">
    <form method="post" action="/admin/project-message">
      {{csrf_field()}}
      <table class="table">
        <thead>
          <tr>
            <th style="width:10%">No.</th>
            <th style="width:90%">Message</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
            $unusedSlot = 3 - count($projectMessages);
            $no = 0; 
          @endphp

            @foreach($projectMessages as $msg)
              @php
                $no += 1; 
              @endphp
              <tr>
                <td>{{$no}}</td>
                <input type="hidden" name="id[]" value="{{$msg->id}}">
                <td ><input class="form-control" style="width:100%" type="text" name="message[]" value="{{$msg->message}}"></td>
                <td></td>
              </tr>
            @endforeach
            @for($i = 0; $i < $unusedSlot; $i++)
              @php
                $no += 1; 
              @endphp
              <tr>
                <td>{{$no}}</td>
                <input type="hidden" name="id[]" value="0">
                <td ><input class="form-control" style="width:100%" type="text" name="message[]" value=""></td>
                <td></td>
              </tr>
            @endfor
        </tbody>
      </table>
      <input type="submit" class="btn btn-primary" value="Save">
    </form>
  </div>
</div>
@endsection