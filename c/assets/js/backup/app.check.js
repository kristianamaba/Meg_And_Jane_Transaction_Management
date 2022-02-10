					function fetchdata(){
					 $.ajax({
					 url:baseURL+'index.php/Main_controller/checkLoginSession',
					  method: 'post',
					  success: function(response){
						  if(response==='0'||response=='0')
							  window.location.href='login-account';
					  }
					 });
					}

					$(document).ready(function(){
					 setInterval(fetchdata,5000);
					});
					