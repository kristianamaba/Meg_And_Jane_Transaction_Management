
			function updateEvent(tnum){
				$.ajax({
					 url:baseURL+'index.php/Main_controller/tnumToSession',
					 method: 'post',
					 data: {'tnum':tnum},
					 success: function(response){
						 if(response=='1')
							 window.location.href='transaction-edit';
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
					}   
				  });
			}
			
			function viewHistory(tnum){
				$.ajax({
					 url:baseURL+'index.php/Main_controller/viewHistoryByTNum',
					 method: 'post',
					 data: {'tnum':tnum},
					 success: function(response){
						 
						 $("#tnumHistoryContent").html(response);
						 $("#myLargeModalLabel").html("Tracking #"+tnum);
						 
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
					}   
				  });
			}