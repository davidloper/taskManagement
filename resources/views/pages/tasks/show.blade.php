@extends('layouts.layout')


@section('toggleBar')
@include('pages.tasks.components.toggleBar')
@endsection
@section('content')
	<div class="row">
		<div class="col-lg-8">
			<h2>Title: {{$task->title}}</h2>
			<h5>Description: {{$task->description}}</h5>
		</div>
		<div class="col-lg-4 text-right">
			<p>Status:</p>
			<p>Assign By:</p>
			<p>priority:</p>
			<p>Estimated Completion:</p>
			<p>Created on: </p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10 offset-1">
			<form action="/comment" method="post">
				<textarea rows="4"cols="100"></textarea>
				<input type="submit">

			</form>
		</div>
	</div>
</div>
@endsection