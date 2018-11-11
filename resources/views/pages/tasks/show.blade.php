@extends('layouts.layout')
@section('content')
<style>
.tr-height{
	height: 10px !important;
	line-height: 10px !important;
	min-height: 10px !important;
}
.bottom{
	position: absolute;
	bottom:0;
}

.card-info{
	min-height:190px !important;
	position:relative !important;
}
</style>
<div class="container con-min-height top-spacing-l">
	<div class="row" style="margin-top: 20px">
		<div class="col-lg-10">
			<div class="card bg-light mb-3">
		  	<div class="card-header">
		  		@if(Auth::user()->projectUser->user_level == 1)
		  			<div class="float-right"><a href="/admins/tasks/{{$task->id}}/edit" class="btn btn-info btn-sm">Edit</a></div>
		  			<form action="/admins/tasks/{{$task->id}}" method="post">
		  				{{csrf_field()}}
			  			<input type="hidden" name="_method" value="delete">
			  			<div class="float-right" style="padding-right: 10px">
			  				<button type="submit" class="btn btn-danger btn-sm">Delete</button>
			  			</div>
		  			</form>
		  			@if($task->status_id == status('pending'))
			  			<div class="dropdown" style="float: right; padding-right: 10px">
			  			  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
			  			    {{$task->status}}
			  			  </button>
			  			  <div class="dropdown-menu">
			  			    <form method="post" action="/task/{{$task->id}}/change-status">
			  			      {{csrf_field()}}
			  			      <input type="hidden" name="status" value="approved">
			  			      <button type="submit" class="dropdown-item">Approve</button>
			  			    </form>
			  			    <form method="post" action="/task/{{$task->id}}/change-status">
			  			      {{csrf_field()}}
			  			      <input type="hidden" name="status" value="rejected">
			  			      <button type="submit" class="dropdown-item">Reject</button>
			  			    </form>
			  			  </div>
			  			</div>
		  			@endif
		  		@endif
		  		<b>#{{ $task->id.'. ' }}{{$task->title}}</b>
		  	</div>
		  	<div class="card-body card-info">
		    	<h5 class="card-title" style="font-size:18px">{{$task->description}}</h5>
		    	<table class="table table-borderless bottom">
		    		<tbody>
		    			<tr class="tr-height">
		    				<td>
		    				Status: <span class="badge badge-secondary">{{ getStatus($task->status_id) }}</span>
		    				</td>
		    				<td><i class="far fa-user"></i>{{ ' ' }}Assign By: {{$task->user->name}}</td>
		    				<td><i class="fas fa-signal"></i>{{ ' ' }}Priority: {{$task->priority}}</td>
		    			</tr>
		    			<tr class="tr-height">
		    				<td><i class="far fa-clock"></i>{{ ' ' }}Est. Hour: {{$task->duration_number}}</td>
		    				<td><i class="far fa-calendar-alt"></i>{{ ' ' }}Created on: {{$task->created_at->format('d M Y')}}</td>
		    				<td></td>
		    			</tr>
		    		</tbody>
		    	</table>
		  	</div>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="card">
			  <div class="card-body">
			    <h5 class="card-title">Option</h5>
			    <form method="post" action="/tasks/{{ $task->id }}">
			    	@csrf
			    	<input type="hidden" name="_method" value="PUT">
			    	<input type="hidden" name="status_id" value="2">
				    <p><button type="submit" class="btn btn-secondary"><i class="fas fa-play-circle"></i></button><p>
			    </form>
			    <form method="post" action="/tasks/{{ $task->id }}">
			    	@csrf
			    	<input type="hidden" name="_method" value="PUT">
			    	<input type="hidden" name="status_id" value="5">
				    <p><button type="submit" class="btn btn-secondary"><i class="fas fa-check-square"></i></button><p>
			    </form>
			    <form method="post" action="/tasks/{{ $task->id }}">
			    	@csrf
			    	<input type="hidden" name="_method" value="PUT">
			    	<input type="hidden" name="status_id" value="3">
				    <p><button type="submit" class="btn btn-secondary"><i class="fas fa-times-circle"></i></button><p>
			    </form>
			  </div>
			</div>
		</div>
	</div>
	@foreach($comments as $comment)
		<div class="row" style="padding-top: 2%">
			<div class="col-lg-12">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">
				    	<b>{{$comment->user->name}}{{ ' ' }}</b>
				    	<span class="card-subtitle mb-2 text-muted" style="font-size:12px">
				    		{{($comment->created_at)->format('d M Y')}}
				    	</span>
				    </h5>
				    <p class="card-text">{{$comment->comment}}	</p>
 				  </div>
				</div>
			</div>
		</div>	
	@endforeach
	<div class="row" style="padding-top: 2%">
		<div class="col-lg-12">
			<form action="/comments" method="post">
				@csrf
				<input type="hidden" name="task_id" value="{{$task->id}}">
				<textarea name="comment" class="form-control" rows="4" cols="100"></textarea>
				<input class="btn btn-primary" type="submit" value="comment">
			</form>
		</div>
	</div>
</div>
@endsection