
<body>
<style>
.btn-light{
	color:#626f7d !important;
}
.nohover:hover{
	background-color:#f8f9fa !important;
}
</style>						  		{{-- {{dd($notifications)}} --}}
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
  		@php
  		// dd(Auth::user()->projectUser);
  		// dd(Auth::user()->project_id)
  		// dd(Auth::user()->projectUser->project);
  		Auth::user()->project_id == 0? $name = 'DashBoard': $name = Auth::user()->projectUser->project->project_name;
  		@endphp
	  	<a class="navbar-brand" href="/home"><h2>{{$name}}</h2></a>
	  	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		      	{{-- <li class="nav-item active">
	        	<a class="nav-link" href="{{route('manageTask')}}">Manage Task<span class="sr-only">(current)</span></a>
		      	</li> --}}
		      	<li class="nav-item">
			      	<div class="dropdown">
					  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
					    Task
					  </button>
					  <div class="dropdown-menu">
					    <a class="dropdown-item" href="/task">Show Task</a>
					    <a class="dropdown-item" href="/task/create">Create Task</a>
					    {{-- <a class="dropdown-item" href="#">Edit Task</a> --}}
					  </div>
					</div>
				</li>
				<li class="nav-item">
			      	<div class="dropdown">
					  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
					    Notification
					  </button>
					  <div class="dropdown-menu">
					  	@forelse($notifications as $notification)
				    		<a class="dropdown-item" href="/task/{{$notification->task_id}}"><b>New Task! </b>{{$notification->title}}</a>
				    	@empty
				    	&nbsp;Nothing to show
				    	@endforelse
				    	<a class="dropdown-item" href="/notifications/markAsSeen"><b>Mark all as seen</b></a>
					  </div>
					</div>
				</li>
	    	</ul>
	    	
  {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
  {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
  {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
	    	<div class="form-inline my-2 my-lg-0">
	    		{{-- <form action="/task" method="get"> --}}
	    			{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
		      		<input type="text" class="form-control" id="taskSearch" placeholder="Search Task" aria-label="Search Task">
	    	</div>
	    	<a style="margin-left: 1%"class="btn btn-light nohover" href="/setting"><i class="fas fa-cog"></i>&nbsp;Setting</a>
			<a style="margin-left: 1%"class="btn btn-light nohover" href="/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>

	  	</div>
	</nav>
<script>
	$(function(){
		// alert(123);
		// alert();
		$('table').DataTable();
		$('#taskSearch').autocomplete({

			source: function(request,response){
				$.ajax({
					url:'{!!URL::to('/task/autoComplete')!!}',
					type: 'GET',
					dataType: 'JSON',
					data: {id : $('#taskSearch').val()},
					success: function(data){
						console.log(data);
						response($.map(data, function(item){
							return {label: item.id};
						}))
					},
					error:function(data){
						console.log(data);
					}
				})
			},
			minlength: 1,
			select: function(e,ui){
				// console.log(e,ui);
				console.log(ui.item.id);
				// debugger;
				location.href = '{!!URL::to('/task/')!!}/' + ui.item.label;
			}
		});
	});

</script>


	