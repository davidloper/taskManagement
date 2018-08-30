@if(Route::getCurrentRoute()->getActionMethod() !== 'index')
<nav aria-label="breadcrumb">
  	<ol class="breadcrumb">
    	<li class="breadcrumb-item"><a href="/task">Task</a></li>
    	@if(Route::getCurrentRoute()->getActionMethod() == 'create')
    		<li class="breadcrumb-item">Create</li>
    	@elseif(Route::getCurrentRoute()->getActionMethod() == 'show')
    		<li class="breadcrumb-item">show</li>
    	@endif
  	</ol>
</nav>
@endif