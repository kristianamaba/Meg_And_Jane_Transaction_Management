
			function viewMessage(l,m,d,i){
				var m = jQuery('#'+m).val();
				var d = jQuery('#'+d).html();
				
				 $("#FromAndDate").html("System Message: "+d);
				 $("#message").html(m);
				 
				 if($("#"+l).hasClass("unread")){
					 $("#notifCount").html(Number(document.getElementById('notifCount').innerHTML)-1);
					 $("#"+l).removeClass("unread");
					 onView(i);
				 }
				
			}
			
			function onView(mesid){
				$.ajax({
					 url:baseURL+'index.php/Main_controller/viewInbox',
					 method: 'post',
					 data: {'mesid':mesid},
					 success: function(response){
						if(response != "")
							fAlert(response);
					 },
					 error: function(XMLHttpRequest, textStatus, errorThrown) { 
						fAlert("Status: " + textStatus); fAlert("Error: " + errorThrown); 
					}   
				  });
			}