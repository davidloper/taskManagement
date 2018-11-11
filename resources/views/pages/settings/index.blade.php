@extends('layouts.layout')
@section('content')
  <div class="container con-min-height top-spacing-l">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-user"></i>{{ ' ' }}Account Info
          </div>
          <div class="card-body">
            <table class="table table-borderless">
              <tbody>
                <tr>
                  <td><i class="fas fa-id-card"></i>{{ ' ' }}<b>ID: </b> {{$user->id}}</td>
                  <td><i class="fas fa-envelope"></i>{{ ' ' }}<b>Email: </b>{{$user->email}}</td>
                  <td><i class="fas fa-user-tag"></i>{{ ' ' }}<b>Username: </b>{{$user->username}}</td>
                </tr>
              <tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row top-spacing-l">
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
                <div class="top-spacing-xs">
                  <input class="form-control" type="password" placeholder="Confirm Password" name="confirmPassword">
                  <input type="hidden" name="type" value="password">
                  <input type="submit" class="btn">
                </div>
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
@endsection 