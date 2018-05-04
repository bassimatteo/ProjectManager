@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9 pull-left">
	       <!-- Main jumbotron for a primary marketing message or call to action -->
			<div class="jumbotron">
    			<div class="container">
    				<h1 class="display-3">{{ $project->name }}</h1>
    				<p>{{ $project->description }}</p>
                    <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>  --> 
    			</div>
    		</div>
    	</div>
		<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
			<!-- <div class="p-3 mb-3 bg-light rounded">
    			<h4 class="font-italic">About</h4>
    			<p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    		</div> -->
    		<div class="p-3">
    			<h4 class="font-italic">Manage</h4>
    			<ol class="list-unstyled mb-0">
					<li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
   					<li><a href="/projects/create">Add Project</a></li>
					<li><a href="/projects">My projects</a></li>
					<li><a href="/projects/create">Create New project</a></li>

			@if($project->user_id == Auth::user()->id)

					<br/>
   					<li><a href="#" onclick="
   							var result = confirm('Are you sure you wish to delete this project?');
							if (result){
								event.preventDefault();
								document.getElementById('delete-form').submit();
							} "
						>Delete</a>
   						<form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}" 
							method="post" style="display: none;">
							<input type="hidden" name="_method" value="delete">
							{{ csrf_field() }}
						</form>
   					</li>
   			@endif
   			
                </ol>
   			</div>        
		</div>
	</div>   
</div> <!-- /container -->
 
@endsection