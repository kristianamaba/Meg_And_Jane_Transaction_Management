			$(document).ready(function () {
                $('#datatable').DataTable();
            });
			
			function changeEmail(em,ca,ca2,varData){
				if($("#"+em).prop('disabled')){
					$('#'+ca).show();
					$('#'+ca2).show();
					$("#"+em).prop('disabled', false);
				}
				else{
					swal({
					  title: "Are you sure?",
					  text: "The email address of this account will be changed!",
					  icon: "warning",
					  buttons: [
						'No, cancel it!',
						'Yes, I am sure!'
					  ],
					  dangerMode: true,
					}).then(function(isConfirm) {
					  if (isConfirm) {
							$.ajax({
							 url:baseURL+'index.php/Main_controller/changeACEmail',
							 method: 'post',
							 data: {'email':$("#"+em).val(),'varData':varData},
							 success: function(response){
								 if(response=='1'){
									 sAlert("Successfully Changed User Email!","");
									 hideDisableEmail(em,ca,ca2);
								 }
								 else
									 fAlert(response);
							 },
							 error: function(XMLHttpRequest, textStatus, errorThrown) { 
								fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
							}   
						  });
					  }
					})
					
					
					
					
				}
				
			}
			
			function hideDisableEmail(em,ca,ca2){
				$('#'+ca).hide();
				$('#'+ca2).hide();
				$("#"+em).prop('disabled', true);
			}
			
			function cancelEmail(em,ca,ca2,temp){
				hideDisableEmail(em,ca,ca2);
				$("#"+em).val($("#"+temp).val());
			}
			
			
			
			function changeType(varData){
					swal({
					  title: "Are you sure?",
					  text: "The account will be promoted/demoted!",
					  icon: "warning",
					  buttons: [
						'No, cancel it!',
						'Yes, I am sure!'
					  ],
					  dangerMode: true,
					}).then(function(isConfirm) {
					  if (isConfirm) {
						  
						  
						  $.ajax({
							 url:baseURL+'index.php/Main_controller/changeACType',
							 method: 'post',
							 data: {'varData':varData},
							 success: function(response){
								 if(response=='1'){
									 sAlert('Successfully Changed Account Type!','accounts-management');
								 }
								 else
									fAlert(response);
							 },
							 error: function(XMLHttpRequest, textStatus, errorThrown) { 
								fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
							}   
						  });
						  
					  }
					})
					
					
			}
			
			function changeStat(varData){
					
					swal({
					  title: "Are you sure?",
					  text: "The account will be enabled/disabled!",
					  icon: "warning",
					  buttons: [
						'No, cancel it!',
						'Yes, I am sure!'
					  ],
					  dangerMode: true,
					}).then(function(isConfirm) {
					  if (isConfirm) {
						  
						  
						  $.ajax({
							 url:baseURL+'index.php/Main_controller/changeACStat',
							 method: 'post',
							 data: {'varData':varData},
							 success: function(response){
								 if(response=='1'){
									 sAlert('Successfully Changed Account Status!','accounts-management');
								 }
								 else
									fAlert(response);
							 },
							 error: function(XMLHttpRequest, textStatus, errorThrown) { 
								fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
							}   
						  });
						  
					  }
					})
					
					
			}
			
			function forgetPass(varData){
				
				
					swal({
					  title: "Are you sure?",
					  text: "The account password would be changed!",
					  icon: "warning",
					  buttons: [
						'No, cancel it!',
						'Yes, I am sure!'
					  ],
					  dangerMode: true,
					}).then(function(isConfirm) {
					  if (isConfirm) {
						  
						  $.ajax({
							 url:baseURL+'index.php/Main_controller/forgetPass',
							 method: 'post',
							 data: {'varData':varData},
							 success: function(response){
								 if(response=='1'){
									 sAlert('Successfully Changed The Password, let your employee check their email!');
								 }
								 else
									fAlert(response);
							 },
							 error: function(XMLHttpRequest, textStatus, errorThrown) { 
								fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
							}   
						  });
						  
					  }
					})
					
					
					
			}