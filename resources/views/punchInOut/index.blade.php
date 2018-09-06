@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('BADGE') }}</div>

				<div class="card-body">
					@if (session('title'))
					<div class=" {{ session('class') }} ">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<h5>
							<i class="icon fa fa-ban"></i> {{ session('title') }}
						</h5>
						{{ session('body') }}
					</div>
					@endif
					<script type="text/javascript">
                    	window.setTimeout(function() {
    						$(".alert").fadeTo(500, 0).slideUp(500, function(){
    							$(this).remove(); 
    						});
    					}, 4000);
                    </script>

					<form method="POST" action="{{ route('punchinouts.store') }}" id="punch_in_out">
						@csrf

						<div class="form-group row">
							<label for="badge" class="col-sm-3 col-form-label text-md-right">{{__('Badge') }}</label>

							<div class="col-md-6">
								<input id="badge" type="text" pattern="[0-9]*" inputmode="numeric" class="form-control input-lg" name="badge" required autofocus>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3"></div>
    						<div class="funkyradio col-md-6">
    							@foreach ($justifications as $j)
    								<div class="funkyradio-success">
    									<input type="radio" name="justification" id="{{ $j->id }}" value="{{ $j->id }}" /> <label
    										for="{{ $j->id }}">{{ $j->name }}</label>
    								</div>
								@endforeach
    							   							
    						</div>
						</div>


						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-lg btn-primary">{{ __('INVIO')	}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
