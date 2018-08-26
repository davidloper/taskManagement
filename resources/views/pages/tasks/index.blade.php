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
							<th style="width:8%">Task no.</th>
							<th style="width:72%">Title</th>
							{{-- <th>Description</th> --}}
							<th style="width:20%">Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($task as $val)
							@php

								if($val->status === 'New'){
								$color = 'table-info';
								}
								elseif($val->status === 'Started'){
								$color = 'table-primary';
								}
								elseif($val->status === 'Ignored'){
								$color = 'table-secondary';
								}
								elseif($val->status === 'Awaiting Approval'){
								$color = 'table-warning';
								}
								elseif($val->status === 'Rejected'){
								$color = 'table-danger';
								}
								elseif($val->status === 'Approved'){
								$color = 'table-success';
								}
								else{
									// dd($val->sata)
									$color = '';
								}

							@endphp
							<tr class="{{$color}}">
								<td><a href="/task/{{$val->id}}">{{$val->id}}</a></td>
								<td>{{$val->title}}</td>
								{{-- <td>{{$val->description}}</td> --}}
								

								<td >{{$val->status}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endforeach
		</div>
	</div>
</div>
@endsection