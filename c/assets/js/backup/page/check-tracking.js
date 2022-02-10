			function onSubmit(){
				$.ajax({
					 url:baseURL+'index.php/Main_controller/viewAllDetailsByTrackingNum',
					 method: 'post',
					 data: $("#trackingForm").serialize(),
					 success: function(response){
						 if (response.length > 50){
							$("#tnumDetailsTable").html(response);
							$('html, body').animate({scrollTop:$(document).height()}, 3000);
						 }
						else{
							$("#tnumDetailsTable").html("");
							fAlert(response);
						 }
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
					}   
				  });
			}