@extends('layouts.layout')

@section('content')

<div class= "row justify-content-center align-self-center">
	<div class="col-lg-8">
		@if(Route::currentRouteName() == 'task.create')
			<form method="post" action="/task">
		@elseif(Route::currentRouteName() == 'task.edit')
			<form method="post" action="/task/{{$task->id}}">
			<input name="_method" type="hidden" value="PUT">
		@endif
		{{csrf_field()}}
		  <div class="form-group">
		    <label>Task Title</label>
		    <input type="text" id="title" name="title" class="form-control" value="{{$task->title}}">
		  </div>
		  <div class="form-group">
		    <label>Description</label>
		    <textarea class="form-control" id="description" name="description" rows="5">{{$task->description}}</textarea>
		  </div>
		  <div class="row">
		  		<div class="col-lg-4 text-center">
					<div class="form-group">
					  	<label>Assign to</label>
							{{-- <input type="text" name="assign_to" class="form-control"> --}}
							<select class="custom-select" id="assign_to" name="assign_to">
									<option selected hidden></option>
								@foreach($users as $user)
								@php 
								$task->assign_to == $user->id? $selected = 'selected': $selected = '';
								@endphp
									<option value="{{$user->id}}" {{$selected}}>{{$user->name}}</option>
								@endforeach
							</select>
					</div>
				</div>
				<div class="col-lg-4 text-center">
					<label>Priority</label>
					<select class="custom-select" id="priority" name="priority">
						@php
							$values = ['1' => 'High','2' => 'Medium','3' => 'Low'];
						@endphp
						@foreach($values as $key => $value)
							@php
							$value == $task->priority? $selected = 'selected': $selected = '';
							@endphp
							<option value="{{$key}}" {{$selected}}>{{$value}}</option>	
						@endforeach
					</select>
				</div>
				<div class="col-lg-4 text-center">
					<label>Estimated Duration</label>
					<div class="row">
						<div class="col-lg-6" style="padding-right: 0px">
							<input type="text" class="form-control" id="duration_number" name="duration_number" value="{{$task->duration_number}}">
						</div>
						<div class="col-lg-6" style="padding-left: 0px">
							<select class="custom-select" id="duration_type" name="duration_type">
								@php
								$values = ['min','hour','day'];
								@endphp
								@foreach($values as $value)
								@php
									$value == $task->duration_type? $selected = 'selected': $selected = '';
								@endphp
								<option value="{{$value}}" {{$selected}}>{{ucfirst($value)}}</option>
								@endforeach
								{{-- <option value="min">Min</option>
								<option value="hour" selected>Hour</option>
								<option value="day">Day</option> --}}
							</select>
						</div>
					</div>
				</div>
		  	</div>
		  	<input type="hidden" name="status" value="new">
		  	<input class="btn btn-success" id="createTaskBtn" type="submit">
		</form>
	</div>
</div>
<script>
	$(function(){
		$('#title').focus();
		$('#createTaskBtn').click(function(){
			if($('#title').val() === ""){
				alert('Please enter title');
				return false;
			}if($('#desciption').val() === ""){
				alert('Please enter desciption');
				return false;
			}
			if($('#assign_to').val() === ""){
				alert('Please select Assign to');
				return false;
			} 
			if($('#duration_number').val() === ""){
				alert('Please enter duration number');
				return false;
			}
			if(isNaN($('#duration_number').val())){
				alert('Please enter number to duration number');
				return false;
			}  
		});
	});
</script>

@endsection