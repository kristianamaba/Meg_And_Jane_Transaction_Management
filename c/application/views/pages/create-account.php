<!doctype html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	if($rank!="1")
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

        <?php if(!$mobile)$this->load->view('sub-page/header'); ?>

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper" <?php if($mobile) echo 'style="padding-top:10px"'; ?> >

                        <!-- Begin page -->
        
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    

                    <div class="p-3">
                        <h4 class="font-18 m-b-5 text-center">Create Account</h4>
                        <p class="text-muted text-center">Please note that name is not changable.</p>

                        <form class="form-horizontal m-t-30" id='cAccountForm'>
						
							<div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                            </div>
							
							<div class="form-group row m-t-20">
                                <div class="col-6 text-center">
                                    <input type="radio" id="staff" name="type" value="2" required>
									<label>Staff</label>
                                </div>
								
								<div class="col-6 text-center">
									<input type="radio" id="admin" name="type" value="1" required>
									<label>Admin</label>
                                </div>
                            </div>
							</form>
                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" onclick="onSubmit();" >Register</button>
                                </div>
                            </div>
							
                        
                    </div>

                </div>
            </div>
        </div>

                </div> <!-- content -->

                <?php $this->load->view('sub-page/footer'); ?>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


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
		<script src="assets/js/app.check.js"></script>
		<script src="assets/js/page/<?php echo $page;?>.js"></script>
		<script src="assets/js/app.custom.js"></script>
		
		<script type='text/javascript'>
			var baseURL="<?php echo base_url();?>";
		</script>

    </body>
</html>

        

