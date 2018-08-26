@extends('layouts.layout')
@section('content')

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#adminPanel">Admin Panel</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#startedTask">User Panel</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#completedTask">Account Setting</a>
    </li>
</ul>

<div class="tab-content" style="margin-top: 20px">
    <div class="tab-pane fade show active" id="adminPanel">
		<div class="row">
			<div class="col-lg-4 card">
				<div class="form-group">
					<form action="/setting/createNewProject" method="post">
						@csrf
						<label>Create New Project</label>
						<input class="form-control" type="text" placeholder="Project Name" name="project_name">
						<input class="btn" type="submit">
					</form>	
				</div>
			</div>
			<div class="col-lg-4 card">
				<div class="form-group">
					<form action="/setting/switchProject" method="post">
						@csrf
						<label>Switch Project</label>
						<select class="form-control" name="project_id">
							@forelse($projectUser as $val)
								<option value="{{$val->project->id}}">{{$val->project->project_name}}</option>
							@empty
								You have no project
							@endforelse
						</select>
						<input class="btn" type="submit">
					</form>
				</div>		
			</div>
			<div class="col-lg-4 card">
				<div class="form-group">
					<form action="/setting/findProject" method="post">
						@csrf
						<label>Find project</label>
						<input class="form-control" type="text" name="project_id">
						<input class="btn" type="submit" value="Find">
					</form>	
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 card">
				<div class="form-group">
					<form action="/setting/findUser" method="post">
						@csrf
						<label>Add user to project</label>
						<input class="form-control" placeholder="Find User" type="text" name="user_id">
						<input class="btn" type="submit" value="Find">
					</form>	
				</div>
			</div>
			<div class="col-lg-6 card">
				<div class="form-group">
					<form action="/setting/editUser" method="post">
						@csrf
						<label>Manage User</label>
						<select class="form-control" name="user_id">
							@forelse($userProject as $val)
								<option value="{{$val->id}}">{{$val->user->name}}</option>
							@empty
								No Other user in this project
							@endforelse
						</select>
						<input class="btn" type="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection	