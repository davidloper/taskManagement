@extends('layouts.layout')
@section('content')
  <div class="container con-min-height top-spacing-l">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            Users
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
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$user->user->name}}</td>
                    <td>{{getUserLevel($user->user_level)}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row top-spacing-m">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            Invite User
          </div>
          <div class="form-inline">
            <div class="card-body">
              <form action="/admins/project/invite-user" method="post">
                @csrf
                <input style="width:50% "class="form-control" placeholder="User ID" type="text" name="to_user_id">
                <input class="btn" type="submit" value="Invite">
              </form>
              <div class="top-spacing-s">
                @forelse($invitedUsers as $invitedUser)
                    <p>{{$invitedUser->fromUser->name}} has invited {{$invitedUser->toUser->name}}</p>
                @empty
                  <p>Nobody is invited</p>
                @endforelse
              </div> 
            </div>
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
    <div class="row top-spacing-m">
      <div class="col-12">
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
  </div>
@endsection