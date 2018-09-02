
<body>
<style>
.btn-light{
	color:#626f7d !important;
}
.nohover:hover{
	background-color:#f8f9fa !important;
}
</style>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
  		@php
  		Auth::user()->project_id == 0? $name = 'DashBoard': $name = Auth::user()->projectUser->project->name;
  		@endphp
	  	<a class="navbar-brand" href="/home"><h2>{{$name}}</h2></a>
	  	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		      	<li class="nav-item">
			      	<div class="dropdown">
					  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
					    Task
					  </button>
					  <div class="dropdown-menu">
					    <a class="dropdown-item" href="/task">Show Task</a>
					    <a class="dropdown-item" href="/task/create">Create Task</a>
					  </div>
					</div>
				</li>
				<li class="nav-item">
					<button class="btn btn-light"><a>Timeline</a></button>
				</li>
				<li class="nav-item">
					<button class="btn btn-light dropdown-toggle"><a>Admin</a></button>
				</li>
				<li class="nav-item">
			      	<div class="dropdown">
					  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
					    Notification
					    @if($notifications->count() > 0)
					    	<span class="badge badge-danger">{{$notifications->count()}}</span>
					    @endif
					  </button>
					  <div class="dropdown-menu">
					  	@forelse($notifications as $notification)
				    		<a class="dropdown-item" href="/task/{{$notification->task_id}}"><b>New Task! </b>{{$notification->title}}</a>
				    		<a class="dropdown-item bg-info" href="/notifications/markAsSeen">Mark all as seen</a>
				    	@empty
				    	&nbsp;Nothing to show
				    	@endforelse
					  </div>
					</div>
				</li>
	    	</ul>
	    	<div class="form-inline my-2 my-lg-0">
		      	<input type="text" class="form-control" id="taskSearch" placeholder="Search Task" aria-label="Search Task">
	    	</div>
	    	<a style="margin-left: 1%"class="btn btn-light nohover" href="/setting"><i class="fas fa-cog"></i>&nbsp;Setting</a>
			<a style="margin-left: 1%"class="btn btn-light nohover" href="/logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>

	  	</div>
	</nav>
<script>
	$(function(){
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
				console.log(ui.item.id);
				location.href = '{!!URL::to('/task/')!!}/' + ui.item.label;
			}
		});
	});

</script>


	