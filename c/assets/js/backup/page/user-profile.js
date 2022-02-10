
			function onSubmit(){
					$.ajax({
						 url:baseURL+'index.php/Main_controller/changeProfileSettings',
						 method: 'post',
						 data: $("#uProfileForm").serialize(),
						 success: function(response){
							 if(response=='1'){
								 sAlert('Successfully Changed User Settings!','user-profile');
							 }
							 else
								fAlert(response);
						 },
						 error: function(XMLHttpRequest, textStatus, errorThrown) { 
							fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
						}   
					  });
				
			}
			
			function onViewIP(ip){
					$.ajax({
						 url:baseURL+'index.php/Main_controller/onViewIP',
						 method: 'post',
						 data: {'ip':ip},
						 success: function(response){
							 if(response=='0'){
								 fAlert('Invalid IP');
							 }
							 else{
								 $("#ip_details_body").html(response);
								 $('#myModal').modal('show');
							 }
						 },
						 error: function(XMLHttpRequest, textStatus, errorThrown) { 
							fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
						}   
					  });
				
			}
			
			
			
			function onViewLoginHistory(){
					$.ajax({
						 url:baseURL+'index.php/Main_controller/onViewLoginHistory',
						 method: 'post',
						 success: function(response){
							$("#login-history").html(response);
						 },
						 error: function(XMLHttpRequest, textStatus, errorThrown) { 
							fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
						}   
					  });
				
			}
			
			function onDeleteSession(sid){
					$.ajax({
						 url:baseURL+'index.php/Main_controller/onDeleteSession',
						 method: 'post',
						 data: {'sid':sid},
						 success: function(response){
							 sAlert("Successfully Deleted Session",'user-profile');
						 },
						 error: function(XMLHttpRequest, textStatus, errorThrown) { 
							fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
						}   
					  });
				
			}
			
			function deleteAllAccountSession(){
					swal({
					  title: "Are you sure?",
					  text: "All other logged in devices will be logged out!",
					  icon: "warning",
					  buttons: [
						'No, cancel it!',
						'Yes, I am sure!'
					  ],
					  dangerMode: true,
					}).then(function(isConfirm) {
					  if (isConfirm) {
						  
							$.ajax({
								 url:baseURL+'index.php/Main_controller/onDeleteAllSession',
								 method: 'post',
								 success: function(response){
									 sAlert("Successfully Deleted All Session",'user-profile');
								 },
								 error: function(XMLHttpRequest, textStatus, errorThrown) { 
									fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
								}   
							  });
							  
					  }
					})
					
					
					
				
			}
			
		