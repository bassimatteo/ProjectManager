@extends('layouts.app')

@section('content')

<div class="col-md-6 col-lg-6">

	<div class="card card-primary">
		<div class="card-header"> Projects
    		@auth
    			 <a class="btn btn-primary float-right" href="/projects/create">Create project</a>
    		@endauth
    	</div>
  		<div class="card-body">
      		<ul class="list-group">
    			@foreach($projects as $project)
    				<li class="list-group-item"><a href="/projects/{{$project->id}}">{{ $project->name }}</a></li>
            	@endforeach
            </ul>
       	</div>
	</div>
</div>
@endsection