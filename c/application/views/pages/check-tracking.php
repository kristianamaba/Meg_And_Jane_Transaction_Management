<!doctype html>
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
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
		<link href="assets/css/tracking.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left" <?php echo (isset($_GET['tnum']) ? "onload='onSubmit();'":""); ?>>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>


        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">


			<div class="col-md-12">
                <div class="card m-b-20 card-body">
					<form class="form-horizontal " id="trackingForm">
						<h3 class="card-title font-20 mt-0">Tracking Number Checker</h3>
						<p class="card-text">Here, you can view all the details and updates about your event.</p>
						<div class="form-group">
							<input type="text" class="form-control" name="tnum" value='<?php echo (isset($_GET['tnum']) ? $_GET['tnum']:""); ?>' placeholder="Enter your Tracking Number">
						</div>	
					</form>
					<a href="#" class="btn btn-primary waves-effect waves-light" onclick="onSubmit()">Submit Input</a>
					
					
					
                 </div>
            </div>
			
			
			
			
            <div class="m-t-40 text-center">
                <p class="text-white">© 2020 B4-AM. Made with <i class="mdi mdi-heart text-danger"></i> by B4-AM</p>
            </div>

        </div>
		<div class="container h-100" id="tnumDetailsTable">
			
		</div>
		<div id="tnumDetailsTable" />
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
		<script src="assets/js/page/check-tracking.js"></script>
		<script src="assets/js/app.custom.js"></script>
		
		<script type='text/javascript'>
			var baseURL="<?php echo base_url();?>";
			
		</script>

    </body>
</html>