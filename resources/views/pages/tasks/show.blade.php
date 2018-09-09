@extends('layouts.layout')
@section('content')
{{-- <div class="container"> --}}
	<div class="row" style="margin-top: 20px">
		<div class="col-lg-7 offset-1">
			<div class="card bg-light mb-3" style="max-width: 50rem;">
			  	<div class="card-header">
			  		@if(Auth::user()->projectUser->user_level == 1)
			  			<div class="float-right"><a href="/task/{{$task->id}}/edit" class="btn btn-info btn-sm">Edit</a></div>
			  			<form action="/task/{{$task->id}}" method="post">
			  				{{csrf_field()}}
				  			<input type="hidden" name="_method" value="delete">
				  			<div class="float-right" style="padding-right: 10px">
				  				<button type="submit" class="btn btn-danger btn-sm">Delete</button>
				  			</div>
			  			</form>
			  			@if(strcasecmp($task->status,'Awaiting Approval') == 0)
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
			  		@else
			  			<div class="float-right"><a href="/task/{{$task->id}}/edit" class="btn btn-info btn-sm">Edit</a></div>
			  		@endif
			  		{{$task->title}}
			  	</div>
			  	<div class="card-body" style="min-height:190px">
			    	<h5 class="card-title">Description</h5>
			    	<p class="card-text">{{$task->description}}</p>
			  	</div>
			</div>
		</div>
		<div class="col-lg-4 text-right">
			<div class="card" style="width: 18rem;">
		    <ul class="list-group list-group-flush">
					<li class="list-group-item">Status: {{$task->status}}</li>
					<li class="list-group-item">Assign By: {{$task->user->name}}</li>
					<li class="list-group-item">Priority: {{$task->priority}}</li>
					<li class="list-group-item">Estimated Completion: {{$task->duration_number}} {{$task->duration_type}}</li>
					<li class="list-group-item">Created on: {{$task->created_at->format('d M Y')}}</li>
		    </ul>
			</div>
		</div>
	</div>
	@foreach($comments as $comment)
		<div class="row" style="padding-top: 2%">
			<div class="offset-1 col-lg-10">
				<div class="card">
				  <div class="card-body">
				    <h5 class="card-title">{{$comment->user->name}}</h5>
				    <h6 class="card-subtitle mb-2 text-muted">{{($comment->created_at)->format('d M Y')}}</h6>
				    <p class="card-text">{{$comment->comment}}	</p>
 				  </div>
				</div>
			</div>
		</div>	
	@endforeach
	<div class="row" style="padding-top: 2%">
		<div class="col-lg-10 offset-1">
			<form action="/comment" method="post">
				@csrf
				<input type="hidden" name="task_id" value="{{$task->id}}">
				<textarea name="comment" class="form-control" rows="4"cols="100"></textarea>
				<input class="btn btn-primary" type="submit" value="comment">

			</form>
		</div>
	</div>
{{-- </div> --}}
@endsection