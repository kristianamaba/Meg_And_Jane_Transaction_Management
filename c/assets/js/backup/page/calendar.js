			function onSubmit(tnum){
				$.ajax({
					 url:baseURL+'index.php/Main_controller/viewAllDetailsByTrackingNum',
					 method: 'post',
					 data: {'tnum':tnum},
					 success: function(response){
						 if (response.length > 50){
							$("#tnumDetails").html(response);
							$('#bs-example-modal-lg').modal('show');
						 }
						else{
							$("#tnumDetails").html("");
							fAlert(response);
						 }
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
					}   
				  });
			}