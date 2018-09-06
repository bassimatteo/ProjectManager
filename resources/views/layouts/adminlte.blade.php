<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	
	@section('htmlheader')
  	  @include('layouts.partials.htmlheader')
	@show
	@section('scripts')
	    @include('layouts.partials.scripts')
	@show

    <body class="skin-blue sidebar-mini">
        <div id="app" v-cloak>
            <div class="wrapper">
        
                @include('layouts.partials.mainheader')
            
                @include('layouts.partials.sidebar')
            
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
            
              	@include('layouts.partials.contentheader')
       
          
               		@if (session('title'))
					<div class=" {{ session('class') }} " style="margin-left: 15px; margin-right: 15px;">
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

            		
                    <!-- Main content -->
                    <section class="content">
                        <!-- Your Page Content Here -->
                        @yield('main-content')
                    </section><!-- /.content -->
                </div><!-- /.content-wrapper -->
            
                @include('layouts.partials.controlsidebar')
            
                @include('layouts.partials.footer')
        
        	</div><!-- ./wrapper -->
        </div>
    </body>
</html>
