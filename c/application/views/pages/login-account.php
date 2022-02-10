<!doctype html>
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	if($loginSession) 
		header('Location: home');
	
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Meg & Jane Studio</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="4AM" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Basic Css files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>


        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    

                    <div class="p-3">
                        <h4 class="font-18 m-b-5 text-center">Welcome Back !</h4>
                        <p class="text-muted text-center">Sign in to continue to the Transaction System.</p>

							<form class="form-horizontal m-t-30" id="loginForm">

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" name="pass" placeholder="Enter password">
                            </div>
							
							</form>

                            <div class="form-group row m-t-20">
                                <div class="col-sm-6">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
									Data Privacy Notice
								  </button>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" onclick="onSubmit()" >Log In</button>
                                </div>
								

							  <!-- The Modal -->
							  <div class="modal fade" id="myModal">
								<div class="modal-dialog modal-lg">
								  <div class="modal-content">
								  
									<!-- Modal Header -->
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									</div>
									
									<!-- Modal body -->
									<div class="modal-body">
									  <p align="center"><strong>DATA PRIVACY NOTICE FOR EMPLOYEES/USERS</strong><br />
										  <strong>DATA PRIVACY POLICY STATEMENT</strong></p>
										<p>Meg and Jane Studios recognizes Its  responsibility of protecting personal data it collects from its prospective,  current and former employees and clients as part of its operations.</p>
										<p>In compliance with Republic Act No. 10173,  also known as the Data Privacy Act of 2012, its implementing rules and  regulations, and other issuances of the National Privacy Commission, Meg and  Jane Studios declares that it will collect from you, the data subject, personal  information while using the Information Management System.</p>
										<hr />
										<p>1. The data/s collected and generated  shall be processed by the Meg and Jane Studios to perform the system&rsquo;s  functions.<br />
										  The following data collected are as  follows:<br />
										  ○ Full name (First name, Middle name, Last  name), Nickname<br />
										  ○ Email Address;<br />
										  ○ Device Details (Device Type, Browser,  Operating System);<br />
										  ○ IP Address;<br />
										  ○ Login Time;<br />
										  ○ Address/Location; <br />
										  ○ Company&rsquo;s Scheduled Event Details; </p>
										<p>2.  The data collected and generated shall be processed and retained in compliance  with RA 9470, otherwise known as the National Archives of the Philippines Act  of 2007, its implementing rules and regulations, and relevant general circulars  issued by the National Archives of the Philippines. <br />
										  3.  The data collected and generated shall be processed and accessed by Meg and  Jane Studios&rsquo; admin personnel designated by the company as data controller  and/or data processor. <br />
										  4.  The data collected and generated are protected from accidental or unlawful  destruction, alteration and disclosure, fraudulent misuse through sufficient  and effective organizational, physical and technical security measures. <br />
										  5.  As data subject, you have the right to be given access to your personal data within  the system having the rights to dispute any inaccuracies or errors found. <br />
										6.  Please be informed that the provision of personal data is a requirement upon  creation of account, thus you have the obligation to provide us with the  relevant information, otherwise failure to do so shall invalidate your account,  Furthermore, any false or inaccurate data or information submitted to the company  shall also merit legal, academic or administrative consequences according to  existing laws and policies. </p>
										<div> </div>
										<hr />
										<p>By using the system, you must have  read and understood the above statements that informs you of the purpose for  the collection of personal data and your rights as a data subject. </p>
									</div>
									
									<!-- Modal footer -->
									<div class="modal-footer">
									  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									
								  </div>
								</div>
							  </div>

                            </div>
                        
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="text-white">© 2020 B4-AM. Made with <i class="mdi mdi-heart text-danger"></i> by B4-AM</p>
            </div>

        </div>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <!-- App js  -->
        <script src="assets/js/app.js"></script>
		<script src="assets/js/page/login-account.js"></script>
		<script src="assets/js/app.custom.js"></script>
		
		<script type='text/javascript'>
			var baseURL="<?php echo base_url();?>";
			
		</script>

    </body>
</html>