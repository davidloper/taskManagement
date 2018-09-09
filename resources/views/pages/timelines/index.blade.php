@extends('layouts.layout')
@section('content')
@php
$now = \Carbon\Carbon::now();
@endphp
<div class="row">
  <div class="col-10 offset-1">
    @foreach($timelines as $key => $timeline)
    <table class="table">
      <thead>
        <th>{{$key}}</th>
        <th></th>
      </thead>
      <tbody>
        @foreach($timeline as $key2 => $tl)
             {{-- {{ dd($tl->task->title) }} --}}
          @if(isset($tl->task->title))
            <tr>
              <td>
                @if($tl->created_at->diffInHours($now) < 1)
                {{($tl->created_at)->diffInMinutes($now)}}
                @else
                {{($tl->created_at)->format('g:i A')}}
                @endif
              </td>
              <td>
              <button class="btn btn-success btn-sm">{{$tl->user->name}}</button>
               {{$tl->action}} task 
              <button class="btn btn-secondary btn-sm">{{$tl->task->title}}</button>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
    @endforeach
  </div>
</div>
@endsection