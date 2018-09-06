@extends('layouts.adminlte') 
@section('htmlheader_title') PunchInOut @endsection

@section('contentheader_title') PunchInOut @endsection

@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">PunchInOut</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
    				<div class="row">
						<div class="col-md-12">
							<table id="punchInOutDataTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Data</th>
										<th>In</th>
										<th>Out</th>
										<th>Giustificativo</th>
										<th>In</th>
										<th>Out</th>
										<th>Giustificativo</th>
									</tr>
								</thead>
								<tbody>
									<tr>
    									<th>Data</th>
										<th>In</th>
										<th>Out</th>
										<th>Giustificativo</th>
										<th>In</th>
										<th>Out</th>
										<th>Giustificativo</th>
    								</tr>
    								<tr>
        								<th>Data</th>
										<th>In</th>
										<th>Out</th>
										<th>Giustificativo</th>
										<th>In</th>
										<th>Out</th>
										<th>Giustificativo</th>
    								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div><!-- /.card-body -->
			</div><!-- /.card -->
		</div>
	</div>
</div>
@endsection
