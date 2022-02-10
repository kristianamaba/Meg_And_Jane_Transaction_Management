			function onSubmit(){
				$.ajax({
					 url:baseURL+'index.php/Main_controller/checkAccount',
					 method: 'post',
					 data: $("#loginForm").serialize(),
					 success: function(response){
						 if(response=='1')
							 window.location.href='login-account-2step';
						 else if(response=='0')
							 window.location.href='home';
						 else
							fAlert(response);
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
					}   
				  });
			}