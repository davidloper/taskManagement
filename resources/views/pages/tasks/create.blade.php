@extends('layouts.layout')

{{-- @section('toggleBar') --}}
{{-- @endsection --}}
@section('content')
@include('pages.tasks.includes.breadcrumb')

<div class= "row justify-content-center align-self-center">
	<div class="col-lg-8">
		<form method="post" action="/task">
		{{csrf_field()}}
		  <div class="form-group">
		    <label>Task Title</label>
		    <input type="text" id="title" name="title" class="form-control">
		  </div>
		  <div class="form-group">
		    <label>Description</label>
		    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
		  </div>
		  <div class="row">
		  		<div class="col-lg-4 text-center">
					<div class="form-group">
					  	<label>Assign to</label>
							{{-- <input type="text" name="assign_to" class="form-control"> --}}
							<select class="custom-select" id="assign_to" name="assign_to">
									<option value="" selected hidden></option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
							</select>
					</div>
				</div>
				<div class="col-lg-4 text-center">
					<label>Priority</label>
					<select class="custom-select" id="priority" name="priority">
						{{-- <option selected>Open this select menu</option> --}}
						<option value="3">High</option>
						<option value="2" selected>Medium</option>
						<option value="1">Low</option>
					</select>
				</div>
				<div class="col-lg-4 text-center">
					<label>Estimated Duration</label>
					<div class="row">
						<div class="col-lg-6" style="padding-right: 0px">
							<input type="text" class="form-control" id="duration_number" name="duration_number">
						</div>
						<div class="col-lg-6" style="padding-left: 0px">
							<select class="custom-select" id="duration_type" name="duration_type">
								<option value="min">Min</option>
								<option value="hour" selected>Hour</option>
								<option value="day">Day</option>
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