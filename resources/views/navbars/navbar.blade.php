
<body>
<style>
.btn-light{
	color:#626f7d !important;
}
.nohover:hover{
	background-color:#f8f9fa !important;
}
.company-name{
	color:#696969;padding: 2px 4px 2px; border:2px solid #A9A9A9;border-radius: 10px;
}
.company-name:hover{
	background-color:#DCDCDC;
}

</style>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
	  	<a class="navbar-brand" href="/home"><h3 class="company-name">{{@Auth::user()->project->name}}</h3></a>
	  	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
		    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
	  		@if(projectId()) 
		      <li class="nav-item">
		      	<a class="btn btn-light" href="/tasks"><i class="fas fa-tasks"></i>{{ ' ' }}My Task</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-light" href="/timeline"><i class="far fa-calendar-alt"></i>{{ ' ' }}Timeline</a>
					</li>
					@if(Auth::user()->projectUser->user_level)
						<li class="nav-item">
							<div class="dropdown">
								<button class="btn btn-light dropdown-toggle" data-toggle="dropdown" type="button">Admin</button>
								<div class="dropdown-menu">
								  <a class="dropdown-item" href="/admin/project-setting">Project Setting</a>
								  <hr>
								  <a class="dropdown-item" href="/task/create">Create Task</a>
								  <a class="dropdown-item" href="/task/admin">Manage Task</a>
								</div>
							</div>
						</li>
					@endif
				@endif
				<li class="nav-item">
	      	<div class="dropdown">
					  <button type="button" class="btn btn-light {!! $notifications->count()?'dropdown-toggle" data-toggle="dropdown"':'"' !!}>
					    <i class="far fa-bell"></i>{{ ' ' }}Notification
					    	<span class="badge badge-danger">{{$notifications->count()}}</span>
					  </button>
					  <div class="dropdown-menu">
					  	@foreach($notifications as $notification)
				    		<a class="dropdown-item" href="/task/{{$notification->task_id}}"><i style="color:#b7b7b7;"class="fas fa-tasks"></i>&nbsp;&nbsp;{{$notification->title}}</a>
				    	@endforeach
					  </div>
					</div>
				</li>
	    	</ul>
	    	<div class="form-inline my-2 my-lg-0">
		      	<input type="text" class="form-control" id="taskSearch" placeholder="Search Task" aria-label="Search Task">
	    	</div>
	    	<a style="margin-left: 1%" class="btn btn-light nohover" href="/setting"><i class="fas fa-cog"></i>&nbsp;Setting</a>
			<a style="margin-left: 1%" class="btn btn-light nohover" href="/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
  	</div>
	</nav>
<script>
	$(function(){
		$('#taskSearch').autocomplete({

			source: function(request,response){
				$.ajax({
					url:'{!!URL::to('/task/autoComplete')!!}',
					type: 'GET',
					dataType: 'JSON',
					data: {id : $('#taskSearch').val()},
					success: function(data){
						response($.map(data, function(item){
							return {label: item.id};
						}))
					},
				})
			},
			minlength: 1,
			select: function(e,ui){
				location.href = '{!!URL::to('/task/')!!}/' + ui.item.label;
			}
		});
	});

</script>


	