@extends('layouts.adminlte') 
@section('htmlheader_title') Dashboard @endsection

@section('contentheader_title') Dashboard @endsection

@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header">
					<div id="reportrange" class="btn btn-primary pull-right"><span></span> <b class="caret"></b></div>
					<h3 class="card-title">
						Ore Lavorate 
					</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">		
					<table id="timesheetTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							 <tr>
							 	<th>Utente</th>
								<th>Data</th>
								<th class="sum">Lavoro</th>
                				<th class="sum">Viaggio</th>
                				<th class="sum">Riposo</th>
                				<th class="sum">Totale Ore Lavorate</th>
            				</tr>
						</thead>
						<tbody>
							@foreach($timesheets as $timesheet)
    							<tr>
    								<td>{{ $timesheet->user }}</td>
    								<td>{{ $timesheet->data }}</td>
    								<td>{{ $timesheet->lavoro }}</td>
    								<td>{{ $timesheet->viaggio }}</td>
    								<td>{{ $timesheet->riposo }}</td>
        							<td>{{ $timesheet->ore_lavorate }}</td>
    							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th>Total Lavoro</th>
								<th>Total Viaggio</th>
								<th>Total Riposo</th>
								<th>Totale Ore Lavorate</th>
            				</tr>
        				</tfoot>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->



<!-- ------------------------------------------------------------------------------------------------------------------- -->


			<div class="card">
				<div class="card-header">
					<h3 class="card-title">
						Timbrature
						@if( Auth::user()->role->id < 3 )  
    						<a class="btn btn-primary float-right" href="#" data-toggle="modal" data-target="#punchModal" id="punchModalButton" accesskey="n">Inserisci Timbratura</a>
    					 @endif
					</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="punchsDataTable" class="table table-bordered table-striped" cellspacing="0" width="100%">
						<thead>
							 <tr>
								<th>Nome</th>
								<th>Giustificativo</th>
                				<th colspan="3">Timbratura</th>
                				<th colspan="3">Timbratura Originale</th>
            				</tr>
							<tr>
								<th><input type="text" placeholder="Cerca" /></th>
								<th><input type="text" placeholder="Cerca" /></th>
								<th><input type="text" placeholder="Cerca" /></th>
								<th class="no-sort">Data</th>
								<th class="no-sort">Ora</th>
								<th class="no-sort">Timbratura</th>
								<th class="no-sort">Data</th>
								<th class="no-sort">Ora</th>								
							</tr>
						</thead>
						<tbody>
							@foreach($punchs as $punch)
    							<tr @if( Auth::user()->role->id < 3 )   data-toggle="modal" data-id="{{ $punch->id }}" data-target="#punchModal"  @endif>
    								<td>{{ $punch->user_name }}</td>
    								<td>{{ $punch->j_name }}</td>
    								<td>{{ date('d/m/Y - H:i', strtotime($punch->punch_timestamp)) }}</td>
        							<td>{{ date('d/m/Y', strtotime($punch->punch_timestamp)) }}</td>
        							<td>{{ date('H:i', strtotime($punch->punch_timestamp)) }}</td>
        						@if ($punch->created_at != $punch->punch_timestamp)
        							<td>{{ date('d/m/Y - H:i', strtotime($punch->created_at)) }}</td>
        							<td>{{ date('d/m/Y', strtotime($punch->created_at)) }}</td>
        							<td>{{ date('H:i', strtotime($punch->created_at)) }}</td>
        						@else
        							<td></td>
        							<td></td>
        							<td></td>
        						@endif
    								
    							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->



			<div class="modal fade" id="punchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<form id="updatePunchForm" id="punch_in_out" >
					@csrf
    				<div class="modal-dialog" role="document">
    					<div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifica Timbratura</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div id="punchItems" class="modal-body">
    						<input id="updatePunchFormId" name="updatePunchFormId" type="hidden" class="form-control">
                            <div class="form-group">
                            	<label>Date masks:</label>
                            	<div class="input-group">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input id="datemask" type="text" class="form-control" required>
                                </div>
                                <!-- /.input group -->
    						</div>
        					<div class="form-group">
                            	<label>Time masks:</label>
                            	<div class="input-group">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input id="timemask" type="text" class="form-control" pattern="([01]?[0-9]{1}|2[0-3]{1}):[0-5]{1}[0-9]{1}" required>
                                </div>
                                <!-- /.input group -->
    						</div>
				
       						<div class="form-group" id="userFormGroup">
                            	<label>Utente:</label>
                            	<div class="input-group">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <select class="custom-select form-control" id="userSelect">
                                    	<option disabled selected value="0"> Seleziona un utente </option>
                                    	@foreach($users as $user)
                                      		<option value="{{ $user->id }}">{{ $user->name }}</option>
                                      	@endforeach	
                                    </select>
                                </div>
                                <!-- /.input group -->
    						</div>
    						
    						<div class="form-group" id="punchJustificationFormGroup">
                            	<label>Giustificativo:</label>
                            	<div class="input-group">
                                	<div class="input-group-prepend">
                                    	<span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <select class="custom-select" id="punchJustificationSelect" required>
											<option disabled selected value="0"> Seleziona una voce </option>
										@foreach($punch_justifications as $punch_justification)
                                      		<option value="{{ $punch_justification->id }}">{{ $punch_justification->name }}</option>
                                      	@endforeach	
                                    </select>
                                </div>
                                <!-- /.input group -->
    						</div>
    
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="updatePunchDeleteButton">Elimina</button>
                            <button type="submit" class="btn btn-primary" id="updatePunchSubmitButton">Salva</button>
                          </div>
                        </div>
                      </div>
            	</form>
			</div>
		
		</div>
	</div>
</div>
<script>

  
  
  
</script>
@endsection
