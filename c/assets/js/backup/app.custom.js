					
					function sAlert(message,loca){
						swal({
							icon: "success",
							title: "Success!",
							text: message,
							showConfirmButton: false,
							timer: 3000
						}).then(function() {
							if(loca!="")
								window.location.href=loca;
							});
					}
					
					function fAlert(message){
						swal({
							icon: 'error',
							title: 'Oops...',
							text: message,
							showConfirmButton: false,
							timer: 3000
						});
					}