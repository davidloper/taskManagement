@extends('layouts.layout')
@section('toggleBar')
@include('pages.tasks.components.toggleBar')
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			{{-- {{dd($task->user)}} --}}
			{{-- {{dd(Auth::user()->task)}} --}}
			<div class="card bg-light mb-3" style="max-width: 50rem;">
			  	<div class="card-header">{{$task->title}}</div>
			  	<div class="card-body">
			    	<h5 class="card-title">Description</h5>
			    	<p class="card-text">{{$task->description}}</p>
			  	</div>
			</div>
			{{-- <h2>Title: {{$task->title}}</h2>
			<h5>Description: {{$task->description}}</h5> --}}
		</div>
		<div class="col-lg-4 text-right">
			{{-- <div class="card">
				<div class="card-body">
					<p>Status: {{$task->status}}</p>
					<p>Assign By: {{$task->user->name}}</p>
					<p>priority: {{$task->priority}}</p>
					<p>Estimated Completion: {{$task->duration_number}} {{$task->duration_type}}</p>
					<p>Created on: {{$task->created_at->format('d M Y')}}</p>
				</div>
			</div> --}}
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
			{{-- <div class="col-lg-10 offset-1">
				<div class="card">
					<h5>{{$comment->user->name}} - {{($comment->created_at)->format('d M Y')}}</h5>
					<p>{{$comment->comment}}</p>
				</div>
			</div> --}}
			<div class="col-lg-10 offset-1">
				<div class="card" style="width: 57rem;">
				  <div class="card-body">
				    <h5 class="card-title">{{$comment->user->name}}</h5>
				    <h6 class="card-subtitle mb-2 text-muted">{{($comment->created_at)->format('d M Y')}}</h6>
				    <p class="card-text">{{$comment->comment}}	</p>
{{-- 				    <a href="#" class="card-link">Card link</a>
				    <a href="#" class="card-link">Another link</a>
 --}}				  </div>
				</div>
			</div>
		</div>	
	@endforeach
	<div class="row" style="padding-top: 2%">
		<div class="col-lg-10 offset-1">
			<form action="/comment" method="post">
				@csrf
				<input type="hidden" name="task_id" value="{{$task->id}}">
				<textarea name="comment" rows="4"cols="100"></textarea>
				<input type="submit">

			</form>
		</div>
	</div>
</div>
@endsection