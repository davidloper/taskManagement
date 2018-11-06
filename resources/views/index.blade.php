@include('includes.header')
<body>
	<div>
		<nav class="navbar navbar-light bg-light">
		  	<h5>Dloper Task Management</h5>
		</nav>
 	</div>
	<div class="container" style="padding-top:1rem">
 		<div class="row">
			<div class="col-lg-6">
				<a class="btn btn-primary btn-block"href="/login">Click here to login</a>
			</div>
			<div class="col-lg-6">
				<a class="btn btn-secondary btn-block" href="/register">Click here to register</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 mx-auto text-center">
				<img class=""mx-auto" src="{{ URL::to('/') }}/images/taskManagement.png" width="900px">
			</div>
		</div>
	</div>
