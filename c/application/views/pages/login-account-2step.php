<!doctype html>
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	if($loginSession) 
		header('Location: home');
	else if(empty($this->session->userdata('MEGANDJANE_accountname')))
		header('Location: login-account');
	
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
                        <h4 class="font-18 m-b-5 text-center">2 step authentication</h4>
                        <p class="text-muted text-center">Hello <?php echo $this->session->userdata('MEGANDJANE_accountname'); ?>, enter the pin sent to your email in order to login.</p>

							<form class="form-horizontal m-t-30" id="2stepForm">

                            <div class="user-thumb text-center m-b-30">
                                <img src="assets/images/users/avatar.jpg" class="rounded-circle img-thumbnail" alt="thumbnail">
                                <h6><?php echo $this->session->userdata('MEGANDJANE_accountname'); ?></h6>
                            </div>

                            <div class="form-group">
                                <label for="userpin">PIN</label>
                                <input type="text" class="form-control" name="pin" placeholder="Enter PIN">
                            </div>
							</form>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" onclick="onSubmit()">Submit PIN</button>
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

        <!-- App js -->
        <script src="assets/js/app.js"></script>
		<script src="assets/js/page/login-account-2step.js"></script>
		<script src="assets/js/app.custom.js"></script>
		
		<script type='text/javascript'>
			var baseURL="<?php echo base_url();?>";
		</script>

    </body>
</html>