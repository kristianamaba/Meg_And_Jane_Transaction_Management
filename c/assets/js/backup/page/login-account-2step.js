			function onSubmit(){
				$.ajax({
					 url:baseURL+'index.php/Main_controller/checkPIN',
					 method: 'post',
					 data: $("#2stepForm").serialize(),
					 success: function(response){
						 if(response=='1')
							 window.location.href='home';
						 else
							 fAlert(response);
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
					}   
				  });
			}