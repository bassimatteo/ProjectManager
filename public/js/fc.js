// Worked Hours
$(document).ready(function() {
	
	$(function() {
		var now = new Date();
		var prevMonthLastDate = new Date(now.getFullYear(), now.getMonth(), 0);
		var prevMonthFirstDate = new Date(now.getFullYear() - (now.getMonth() > 0 ? 0 : 1), (now.getMonth() - 1 + 12) % 12, 1);
		var start = moment(prevMonthFirstDate);
		var end = moment(prevMonthLastDate);

		function cb(start, end) {
			$('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
		}
		
		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				//'Today': [moment(), moment()],
				//'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				//'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				//'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'Mese corrente': [moment().startOf('month'), moment().endOf('month')],
				'Mese precedente': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			locale: {
				format: 'DD/MMM/YYYY',
				separator: " - ",
				applyLabel: "Applica",
				cancelLabel: "Cancella",
				fromLabel: "Da",
				toLabel: "A",
				customRangeLabel: "Personalizza",
				daysOfWeek: [ "Do", "Lu", "Ma", "Me", "Gi", "Ve", "Sa" ],
				monthNames: [ "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", 
					"Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre" ],
				firstDay: 1
			}
	    }, cb);
	    cb(start, end);
	});
 
	$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
		var start = picker.startDate;
		var end = picker.endDate;
		
		$.fn.dataTable.ext.search.push( function(settings, data, dataIndex) {
			var min = start;
			var max = end;
			var startDate = new Date(data[1]);
      
			if (min == null && max == null) {
				return true;
			}
			if (min == null && startDate <= max) {
				return true;
			}
			if (max == null && startDate >= min) {
				return true;
			}
			if (startDate <= max && startDate >= min) {
				return true;
			}
			return false;
		});
		timesheetTable.draw();
		$.fn.dataTable.ext.search.pop();
	});

  var timesheetTable = $('#timesheetTable').DataTable({
	dom: 'Bfrtip',
	buttons: [ 'copy' , 'excel', 'print' ],
    lengthChange: false,
    pageLength: 31,
    footerCallback: function ( row, data, start, end, display ) {
    	var api = this.api();

        api.columns('.sum', { page: 'current' }).every(function () {
            var sum = api
                .cells( null, this.index(), { page: 'current'} )
                .render('display')
                .reduce(function (a, b) {
                	if(jQuery.type(a) === "string" && a.includes(":")){
                		a = (+a.split(':')[0]) * 60 * 60 + (+a.split(':')[1]) * 60 + (+a.split(':')[2]); 
                	}
                	if(jQuery.type(b) === "string" && b.includes(":")){
                		b = (+b.split(':')[0]) * 60 * 60 + (+b.split(':')[1]) * 60 + (+b.split(':')[2]); 
                	}
                	var x = parseFloat(a) || 0;
                	var y = parseFloat(b) || 0;
                	return x + y;
                	
                }, 0);
            //Convertire i secondi in hh:mm:ss
            if(this.index() != 4){
            	sum = SecondsTohhmmss(sum);
            }
            $(this.footer()).html(sum);
        });
    }
  });
});


//PUCH
$(function () {
	// Setup - add a text input to each footer cell
	// $('#punchsDataTable thead tr').clone(true).appendTo( '#punchsDataTable thead' );
	$('#punchsDataTable thead tr:eq(1) th').each( function (i) {
		$( 'input', this ).on( 'keyup change', function () {
			if ( table.column(i).search() !== this.value ) {
				table.column(i).search( this.value ).draw();
			}
		});
	});
		 
	var table = $('#punchsDataTable').DataTable( {
		orderCellsTop: true,
		fixedHeader: true,
		"ordering": false,
		stateSave: true,
		dom: 'Bfrtip',
		buttons: [ 'copy', 'excel', 'print' ]	 
	});

	$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
  	$('#timemask').inputmask("99:99");
		
  	
  
  	//punch Modal
	$('#punchModal').modal({
		keyboard: true,
		backdrop: "static",
		show: false,
		}).on('show.bs.modal', function(e){ //subscribe to show method
			var punchId = 0;
			if(e.relatedTarget.id == "punchModalButton"){
				$('#exampleModalLabel').text("Inserisci timbratura")
				$('#updatePunchForm').attr('action', '/punchinouts/0');
				$('#updatePunchFormId').val(0)
				$("#punchJustificationSelect").val($("#punchJustificationSelect option:first").val());
				$("#userSelect").val($("#userSelect option:first").val());
				$('#userFormGroup').show();
				$('#updatePunchDeleteButton').hide();
				$('#userSelect').required = true;
				
			} else {
				$('#exampleModalLabel').text("Modifica timbratura");
				$('#userFormGroup').hide();
				$('#updatePunchDeleteButton').show();
				$('#userSelect').required = false;
				
				var getIdFromRow = $(event.target).closest('tr').data('id'); //get the id from tr
				$.ajax({
					url: "/api/punchinouts/" + getIdFromRow,
					type: 'GET',
					success: function(response) {
						console.log(response.data);
						d = new Date(response.data.punch_timestamp);
						$('#updatePunchForm').attr('action', '/punchinouts/' + response.data.id);
						$('#updatePunchFormId').val(response.data.id);
						$('#datemask').val(d.toLocaleDateString());
						$('#timemask').val(d.toTimeString());
						$('#punchJustificationSelect').val(response.data.punch_justifications.id);
					},
					error: function(response) {						
						console.log(response);
						if(response.status == 401){
							$('#punchModal').modal('hide');
						}
					}
				});
			}
	    });

	$('#updatePunchForm').on('submit', function (e) {
	    
		/* stop form from submitting normally */
        e.preventDefault();
        
        /* Deve essere selezionato sempre un giustificativo  */
        if( $('#punchJustificationSelect').find(":selected").val() == 0 ) { return; }
        
        /* Se la select utente è visibile (sto creando una timbratura) deve esser selezionato un utente */
        if( $('#userFormGroup').is(":visible") && $('#userSelect').find(":selected").val() == 0) { return; }
        
        $.ajax({
            type: "POST",
            url: '/api/punchinouts/' + $('#updatePunchFormId').val(),
            headers: { 'X-CSRF-TOKEN': $( "input[name='_token']" ).val() },
            data: { id: $('#updatePunchFormId').val(), data: $('#datemask').val(), time: $('#timemask').val(), user_id: $('#userSelect').find(":selected").val(), punch_justifications_id: $('#punchJustificationSelect').find(":selected").val()},
            beforeSend: function(){
				$('#updatePunchSubmitButton').prop("disabled", true);
			},
            success: function( response ) {
            	location.reload(true);
            },
			error: function(response) {
				console.log(response);
				$('#updatePunchSubmitButton').prop("disabled", false);
			}
        });
    });
	
	
	$('#updatePunchDeleteButton').click(function(e) {
		$('#updatePunchFormId').val();
		$.ajax({
            type: "DELETE",
            url: '/api/punchinouts/' + $('#updatePunchFormId').val(),
            headers: { 'X-CSRF-TOKEN': $( "input[name='_token']" ).val() },
            data: { id: $('#updatePunchFormId').val() },
            beforeSend: function(){
				$('#updatePunchSubmitButton').prop("disabled", true);
			},
            success: function( response ) {
            	location.reload(true);
            },
			error: function(response) {
				console.log(response);
				$('#updatePunchSubmitButton').prop("disabled", false);
			}
        });
	});
	
    // End Modal
});


function SecondsTohhmmss(totalSeconds) {
	var hours   = Math.floor(totalSeconds / 3600);
	var minutes = Math.floor((totalSeconds - (hours * 3600)) / 60);
	var seconds = totalSeconds - (hours * 3600) - (minutes * 60);

	// round seconds
	seconds = Math.round(seconds * 100) / 100

	var result = (hours < 10 ? "0" + hours : hours);
	result += ":" + (minutes < 10 ? "0" + minutes : minutes);
	result += ":" + (seconds  < 10 ? "0" + seconds : seconds);
	return result;
}
