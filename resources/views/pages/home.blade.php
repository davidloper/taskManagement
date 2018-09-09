@extends('layouts.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<div class="row">
    <div class="col-10 offset-1" style="margin-top:20px">
        <div class="card mb-3">
          <div class="card-header">Admin Message:</div>
          <div class="card-body">
            {{-- <h5 class="card-title">Dark card title</h5> --}}
            @foreach($projectMessages as $key => $msg)
                <p class="card-text">{!!$msg->message!!}</p>
                @if($key < count($projectMessages) - 1)
                    <hr>
                @endif
            @endforeach
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-3 offset-1">
        <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">
                Performance Chart
            </div>
            <div class="card-body text-primary">
                <canvas id="myChart" width="100" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card mb-3">
            <div class="card-header">
                Latest Event
            </div>
            <div class="card-body">
                @foreach($events as  $key => $event)
                    @if($event->getTable() == 'timelines')
                        <p class="card-text">
                            <button class="btn btn-success btn-sm">{{$event->user->name}}</button>
                             {{$event->action}} task 
                            <button class="btn btn-secondary btn-sm">{{$event->task->title}}</button>
                        </p>
                    @elseif($event->getTable() == 'tasks')
                        <p class="card-text">
                            Task 
                            <button class="btn btn-secondary btn-sm">{{$event->title}}</button>
                             assigned to 
                            <button class="btn btn-success btn-sm">{{$event->user->name}}</button>
                         </p>
                    @endif
                    @if($key < count($events) - 1)
                        <hr>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="row">
</div>
<script>
@php
$jsonMonths = json_encode($months);
$monthWords = array_keys($months);
$monthWords = '[\''.implode('\',\'',$monthWords).'\']';

// dd($monthWords);
@endphp
var ctx = document.getElementById("myChart").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'line',
    data: {

        // labels: $.map({!$jsonMonthWords!},function(e1){ return e1; }),
        labels: {!!$monthWords!!},
        datasets: [{
            label: '# of tasks completed',
            data: $.map({!!$jsonMonths!!},function(e1){ return e1; }),
            // data: $.map(,function(e1){ return e1; }),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 0,
                    stepSize:1,
                    // beginAtZero:true
                }
            }]
        }
    }
});
</script>
@endsection