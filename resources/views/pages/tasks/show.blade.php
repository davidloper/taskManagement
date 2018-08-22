@extends('layouts.layout')
@section('toggleBar')
@include('pages.tasks.components.toggleBar')
@endsection
@section('content')
<div class="row">
	<div class="col-lg-8">
		{{-- {{dd($task->user)}} --}}
		{{-- {{dd(Auth::user()->task)}} --}}
		<h2>Title: {{$task->title}}</h2>
		<h5>Description: {{$task->description}}</h5>
	</div>
	<div class="col-lg-4 text-right">
		<p>Status: {{$task->status}}</p>
		<p>Assign By: {{$task->user->name}}</p>
		<p>priority: {{$task->priority}}</p>
		<p>Estimated Completion: {{$task->duration_number}} {{$task->duration_type}}</p>
		<p>Created on: {{$task->created_at->format('d M Y')}}</p>
	</div>
</div>
@foreach($comments as $comment)
	<div class="row">
		<div class="col-lg-10 offset-1">
			<div class="border">
				<h5>{{$comment->user->name}}</h5>
				<p>{{$comment->comment}}</p>
			</div>
		</div>
	</div>	
@endforeach
<div class="row">
	<div class="col-lg-10 offset-1">
		<form action="/comment" method="post">
			@csrf
			<input type="hidden" name="task_id" value="{{$task->id}}">
			<textarea name="comment" rows="4"cols="100"></textarea>
			<input type="submit">

		</form>
	</div>
</div>
@endsection