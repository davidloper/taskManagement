@extends('layouts.layout')

@section('toggleBar')
@include('pages.manageTasks.components.toggleBar')
@endsection
@section('content')
<div class="container" style="padding-top: 3%">
	<div class= "row justify-content-center align-self-center">
		<div class="col-lg-8">
			<form method="get" action="/manageTask/create">
			  <div class="form-group">
			    <label>Task Title</label>
			    <input type="text" name="title" class="form-control">
			  </div>
			  <div class="form-group">
			    <label>description</label>
			    <textarea class="form-control" name="description" rows="5"></textarea>
			  </div>
			  <input type="submit">
			</form>
		</div>
	</div>
</div>

@endsection