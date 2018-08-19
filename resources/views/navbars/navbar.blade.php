
<body>
						  		{{-- {{dd($notifications)}} --}}
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
	  	<a class="navbar-brand" href="/home">Dashboard</a>
	  	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		      	{{-- <li class="nav-item active">
	        	<a class="nav-link" href="{{route('manageTask')}}">Manage Task<span class="sr-only">(current)</span></a>
		      	</li> --}}
		      	<li class="nav-item">
			      	<div class="dropdown">
					  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
					    Manage Task
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
				    		<a class="dropdown-item"href="/notifications/markAsSeen"><b>Mark all as seen</b></a>
				    	@empty
				    	Nothing to show
				    	@endforelse
					  </div>
					</div>
				</li>
	    	</ul>
	    	<div class="form-inline my-2 my-lg-0">
	    		{{-- <form action="/task" method="get"> --}}
		      		<input class="form-control mr-sm-2" id="taskSearch" placeholder="Search Task" aria-label="Search Task">
		      		<a class="btn btn-outline-success my-2 my-sm-0" href="">Search</a>
	      		{{-- </form> --}}
	    	</div>
	    	<a style="padding-left: 2%"class="navbar-brand" href="/setting">Setting</a>
			<a style="padding-left: 2%"class="navbar-brand" href="/logout">Logout</a>

	  	</div>
	</nav>
<script>
	$(function(){
		// alert(123);
		// alert();
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
				debugger;
				location.href = '{!!URL::to('/task/')!!}/' + ui.item.label;
			}
		});
	});

</script>


	