@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9 pull-left">
	       <!-- Main jumbotron for a primary marketing message or call to action -->
			<div class="jumbotron">
    			<div class="container">
    				<h1 class="display-3">{{ $company->name }}</h1>
    				<p>{{ $company->description }}</p>
                    <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>  --> 
    			</div>
    		</div>
    		<div class="row">
    			@foreach($company->projects as $project)
    			<div class="col-md-4">
    				<h2>{{ $project->name }}</h2>
    				<p>{{ $project->description }}</p>
    				<p><a class="btn btn-secondary" href="/projects/{{ $project->id }}" role="button">View details &raquo;</a></p>
    			</div>
    			@endforeach
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
					<li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
   					<li><a href="/projects/create/{{ $company->id }}">Add Project</a></li>
					<li><a href="/companies">My Companies</a></li>
					<li><a href="/companies/create">Create New Company</a></li>
					
					<br/>
   					<li><a href="#" onclick="
   							var result = confirm('Are you sure you wish to delete this company?');
							if (result){
								event.preventDefault();
								document.getElementById('delete-form').submit();
							} "
						>Delete</a>
   						<form id="delete-form" action="{{ route('companies.destroy', [$company->id]) }}" 
							method="post" style="display: none;">
							<input type="hidden" name="_method" value="delete">
							{{ csrf_field() }}
						</form>
   					</li>
                </ol>
   			</div>        
		</div>
	</div>   
</div> <!-- /container -->
 
@endsection