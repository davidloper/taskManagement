@extends('layouts.layout')
@section('content')

<ul class="nav nav-tabs">
  <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#project-message">Edit Project Message</a>
    </li>
</ul>
<div class="row" style="margin-top:20px">
  <div class="col-10 offset-1">
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