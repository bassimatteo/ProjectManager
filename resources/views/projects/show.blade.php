@extends('layouts.app')

@section('content')

<div class="container">
	
  <div class="row">
	
		
		<div class="col-sm-9 col-md-9 col-lg-9 pull-left">
		<div class="jumbotron">
    			<div class="container">
    				<h1 class="display-3">{{ $project->name }}</h1>
    				<p>{{ $project->description }}</p>
    			</div>
    		</div>
    	   	@include('partials.comment')

    		<div class="container-fluid">
    		  		<form method="post" action="{{ route('comments.store') }}">
    			{{ csrf_field() }}
    		
    			<input type="hidden" name="commentable_type" value="App\Project">
    			<input type="hidden" name="commentable_id" value="{{ $project->id }}">
    			
    			<div class="form-group">
    				<label for="comment-content">Comment</label> 
     				<textarea placheolder="Enter comment" 
    					style=""
    					id="comment-content"
     					name="body"
    					rows="3" spellcheck="false"
     					class="form-control autosize-target text-left"></textarea>    			
     			</div>
     			<div class="form-group">
   				<label for="comment-content">Proof of work done</label> 
    				<textarea placheolder="Enter url or screenshot" 
    					style="resize: vertical"
    					id="comment-url"
     					name="url"
     					rows="2" spellcheck="false"
    					class="form-control autosize-target text-left"></textarea>    			 
     			</div> 
     			<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Submit" />
				</div>
    		</form>
    		</div>
    		    
    	</div>
		<div class="col-sm-3 col-md-3 col-lg-3 pull-right">

    		<div class="p-3">
    			<h4 class="font-italic">Manage</h4>
    			<ol class="list-unstyled mb-0">
					<li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
   					<li><a href="/projects/create">Add Project</a></li>
					<li><a href="/projects">My projects</a></li>

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
                
                <hr/>
                
                <h4 class="font-italic">Members</h4>
                <div class="row">
                	<form id="add-user" action="{{ route('projects.adduser') }}" 
						method="post">
					{{ csrf_field() }}
					<input type="hidden" name="project_id" value="{{ $project->id }}">	
					
                    <div class="input-group mb-3">
      					<input type="text" name="email" class="form-control" placeholder="Email..." aria-label="Recipient's username" aria-describedby="basic-addon2">
      					<div class="input-group-append">
        					<button class="btn btn-outline-secondary" type="submit">Add</button>
      					</div>
    				</div>
    				</form>
                </div>
                <div class="row">
                	<ol class="list-unstyled mb-0">
                	@foreach($project->users as $user)
    					<li><a href="/users/{{ $user->id }}">{{ $user->email }}</a></li>
    				@endforeach
					</ol> 
                </div>
   			</div>        
		</div>
	</div>  
</div> <!-- /container -->
 
@endsection