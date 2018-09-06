
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
		stateSave: true
	});

	$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
  	$('#timemask').inputmask("99:99");
		
  	
  
  	//punch Modal
	$('#punchModal').modal({
		keyboard: true,
		backdrop: "static",
		show: false,
		}).on('show.bs.modal', function(e){ //subscribe to show method
	        
			var getIdFromRow = $(event.target).closest('tr').data('id'); //get the id from tr
	        $.get( "/ajax/punchinouts/".getIdFromRow, function() {
	        	alert( "success" );
	       	})
	        .done(function() {
	        	alert( "second success" );
	        })
	        .fail(function() {
	            alert( "error" );
	        })
	        .always(function() {
	            alert( "finished" );
	        });
	   
	        console.log(e);
	        //make your ajax call populate items or what even you need
	        //$(this).find('#punchItems').html($('<b> Order Id selected: ' + getIdFromRow  + '</b>'))
	    });

    // End Modal
});



  


