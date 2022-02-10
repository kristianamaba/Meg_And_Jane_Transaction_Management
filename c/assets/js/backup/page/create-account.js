			function onSubmit(){
					$.ajax({
						 url:baseURL+'index.php/Main_controller/createAccount',
						 method: 'post',
						 data: $("#cAccountForm").serialize(),
						 success: function(response){
							 if(response=='1'){
								 sAlert('Successfully Created an Account!','create-account');
							 }
							 else
								fAlert(response);
						 },
						 error: function(XMLHttpRequest, textStatus, errorThrown) { 
							fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
						}   
					  });
			}