<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
	  	<a class="navbar-brand" href="#">Dashboard</a>
	  	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	    	<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		      	{{-- <li class="nav-item active">
	        	<a class="nav-link" href="{{route('manageTask')}}">Manage Task<span class="sr-only">(current)</span></a>
		      	</li> --}}
		      	<li class="nav-item">
			      	<div class="dropdown">
					  <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
					    Manage Task
					  </button>
					  <div class="dropdown-menu">
					    <a class="dropdown-item" href="#">Show Task</a>
					    <a class="dropdown-item" href="manageTask/create">Create Task</a>
					    <a class="dropdown-item" href="#">Edit Task</a>
					  </div>
					</div>
				</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="#">Notification</a>
	      		</li>
	    	</ul>
	    	<form class="form-inline my-2 my-lg-0">
	      		<input class="form-control mr-sm-2" type="search" placeholder="Search Task" aria-label="Search Task">
	      		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	    	</form>
	    	<a style="padding-left: 2%"class="navbar-brand" href="">Setting</a>
			<a style="padding-left: 2%"class="navbar-brand" href="/logout">Logout</a>

	  	</div>
	</nav>


	