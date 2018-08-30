<div class="container-fluid" style="min-height: 80vh">
@if(session('success'))
    <div class="alert alert-success">
        <strong>Success!</strong> {{session('success')}}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        <strong>Error!</strong>{{session('error')}}
    </div>
@endif

{{$slot}}
	   </div>
		<nav class="navbar navbar-light bg-light">
		      <span class="navbar-text">
		          Copyright @ {{\Carbon\Carbon::now()->format('Y')}}
		      </span>
		</nav>
	</body>
</html>
