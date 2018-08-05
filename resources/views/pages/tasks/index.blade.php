@extends('layouts.layout')

@section('toggleBar')
@include('pages.tasks.components.toggleBar')
@endsection
@section('content')
	<div class= "row justify-content-center align-self-center">
		<div class="col-lg-10">
			@foreach($tasks as $key => $task)
				<h3>{{$key}}</h3>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Task no.</th>
							<th>Title</th>
							<th>Description</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($task as $val)
							<tr>
								<td><a href="/task/{{$val->id}}">{{$val->id}}</a></td>
								<td>{{$val->title}}</td>
								<td>{{$val->description}}</td>
								@php

									if($val->status === 'new'){
									$color = 'bg-info';
									}
									elseif($val->status === 'started'){
									$color = 'bg-primary';
									}
									elseif($val->status === 'ignored'){
									$color = 'bg-secondary';
									}
									elseif($val->status === 'awaiting approval'){
									$color = 'bg-warning';
									}
									elseif($val->status === 'rejected'){
									$color = 'bg-danger';
									}
									elseif($val->status === 'approved'){
									$color = 'bg-success';
									}

								@endphp

								<td class="{{$color}}">{{$val->status}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endforeach
		</div>
	</div>
</div>
@endsection