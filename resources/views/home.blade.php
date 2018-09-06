@extends('layouts.adminlte') 
@section('htmlheader_title') Dashboard @endsection

@section('contentheader_title') Dashboard @endsection

@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Employees</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="employeeDataTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Browser</th>
								<th>Platform(s)</th>
								<th>Engine version</th>
								<th>CSS grade</th>
							</tr>
						</thead>
						<tbody>
						
							@foreach($users as $user)
    							<tr>
    								<td><a href="/users/{{$user->id}}/dashboard">{{ $user->name }}</a></td>
    								<td>Internet Explorer 4.0</td>
    								<td>Win 95+</td>
    								<td>4</td>
    								<td>X</td>
    							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		
		
		
		
		
		
		</div>
	</div>
</div>

<script>
  $(function () {
    $("#employeeDataTable").DataTable();
  });
  
</script>
@endsection
