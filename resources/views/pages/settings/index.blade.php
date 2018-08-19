@extends('layouts.layout')
@section('content')
<div class="container" style="min-height:800px">
	<div class="row">
		<div class="col-lg-4">
			<form action="/setting/createNewProject" method="post">
				@csrf
				<h4>Create new project</h4>
				<label>Project Name</label>
				<input type="text" name="project_name">
				<input type="submit">
			</form>	
		</div>
		<div class="col-lg-4">
			<form action="/setting/switchProject" method="post">
				@csrf
				<h4>Switch project</h4>
				<select name="project_id">
					@forelse($projectUser as $val)
						<option value="{{$val->project->id}}">{{$val->project->project_name}}</option>
					@empty
						You have no project
					@endforelse
				</select>
				<input type="submit">
			</form>		
		</div>
		<div class="col-lg-4">
			<form action="/setting/findProject" method="post">
				@csrf
				<h4>Find project</h4>
				<input type="text" name="project_id">
				<input type="submit" value="Find">
			</form>	
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<h4>Add user to project</h4>
			<form action="/setting/findUser" method="post">
				@csrf
				<h4>Find User</h4>
				<input type="text" name="user_id">
				<input type="submit" value="Find">
			</form>	
		</div>
		<div class="col-lg-6">
			<form action="/setting/editUser" method="post">
				@csrf
				<h4>Manage User</h4>
				<select name="user_id">
					@forelse($userProject as $val)
						<option value="{{$val->id}}">{{$val->user->name}}</option>
					@empty
						No Other user in this project
					@endforelse
			</form>
		</div>
	</div>
</div>
@endsection	