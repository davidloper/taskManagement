@include('includes.header')
<body>
	<div class="container" style="min-height: 560px">
		<div class="row">
			<div class="col-lg-6">
				<h1>Dloper Task Management</h1>
				{{-- <h1>123</h1> --}}
			</div>
			<div class="col-lg-6 text-right">
				<h3 style="color:grey; padding-top:5px;">Try now for free!</h3>
			</div>
		</div>
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
				{{-- {{dd(asset('images'))}} --}}
				{{-- {{ dd(URL::to('/') )}} --}}
				<img class=""mx-auto" src="{{ URL::to('/') }}/images/taskManagement.png" width="900px">
			</div>
		</div>
	</div>
{{-- </body> --}}
@include('includes.footer')