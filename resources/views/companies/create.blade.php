@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9 pull-left">
	       <!-- Main jumbotron for a primary marketing message or call to action -->
			<div class="col-sm-12 col-md-12 col-lg-12">
					<h1>Create new project</h1>
    				<form method="post" action="{{ route('companies.store') }}">
					{{ csrf_field() }}
					
					<div class="form-group">
						<label for="company-name">Name<span class="required">*</span></label>
						<input placeholder="Enter name"
								id="comapany-name"
								required
								name="name"
								spellcheck="false"
								class="form-control"/>
						</div>	
						<div class="form-group">
						<label for="company-description">Description<span class="required">*</span></label>
						<textarea placeholder="Enter description"
								style="resize: vertical"
								id="comapany-content"
								name="description"
								rows="5" spellcheck="false"
								class="form-control autosize-target text-left"></textarea>
					</div>	
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Submit" />
					</div>

				</form>	
    			
    		</div>
    	</div>
		<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
			<!-- <div class="p-3 mb-3 bg-light rounded">
    			<h4 class="font-italic">About</h4>
    			<p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    		</div> -->
    		<div class="p-3">
    			<h4 class="font-italic">Actions</h4>
    			<ol class="list-unstyled mb-0">
    				<li><a href="/companies">View my Companies</a></li>
                </ol>
   			</div>        
		</div>
	</div>   
</div> <!-- /container -->
 
@endsection