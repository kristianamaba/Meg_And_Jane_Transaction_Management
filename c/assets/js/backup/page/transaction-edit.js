			$("#sDate").datepicker({
				format: 'yyyy-mm-dd',
				orientation: "bottom auto",
				autoclose: true,
				datesDisabled: datesForDisable,
				
				
            });
			
			function onSubmit(){
				
					
					swal({
					  title: "Are you sure?",
					  text: "The event will be updated!",
					  icon: "warning",
					  buttons: [
						'No, cancel it!',
						'Yes, I am sure!'
					  ],
					  dangerMode: true,
					}).then(function(isConfirm) {
					  if (isConfirm) {
						  
						  
						  $.ajax({
							 url:baseURL+'index.php/Main_controller/updateEvent',
							 method: 'post',
							 data: $("#cEventForm").serialize(),
							 success: function(response){
								 if(response=='1'){
									 sAlert('Successfully Updated Event!','transactions-table');
								 }
								 else
									fAlert('Something Went Wrong! Check the details carefully!\n'+response);
							 },
							 error: function(XMLHttpRequest, textStatus, errorThrown) { 
								fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
							}   
						  });
						  
					  }
					})
					
					
			}