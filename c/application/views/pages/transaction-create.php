<!doctype html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('main_helper');
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

        <!-- Plugins css -->
        <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- Basic Css files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/css/disabledDate.css" rel="stylesheet" type="text/css">
    </head>


    <body class="fixed-left">

        <?php if(!$mobile)$this->load->view('sub-page/header'); ?>

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper" <?php if($mobile) echo 'style="padding-top:10px"'; ?> >

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">
										<form id="cEventForm">
											<h4 class="mt-0 header-title">Create Event</h4><br>
											<p>Please Note that the Bride and Groom's name unchangable on Editing, Complete and Cancelled Phase.</p>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Bride's Name</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="text" name="bName" required>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Groom's Name</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="text" name="gName" required>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Schedule Date</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" name="sDate" id="sDate" placeholder="Select Date" readonly required>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Package</label>
                                                <div class="col-sm-8">
													<select  class="form-control" name="package">
													  <option disabled selected required>Select a Package</option>
													  <option value="1">Serendipity</option>
													  <option value="2">Love</option>
													  <option value="3">Ever After</option>
													</select>
                                                </div>
                                            </div>
											<p>Please Note that the add-ons aren't required and can be left as blank.</p>
											<div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Add-on</label>
                                                <div class="col-sm-8">
													<div class="form-group row">
														<div class="col-sm-4">
															<input type="checkbox" name="ao1"> Photo Album
														</div>
														<div class="col-sm-4">
															<input type="checkbox" name="ao2"> Wedding Portrait
														</div>
														<div class="col-sm-4">
															<input type="checkbox" name="ao3"> Prenup Shoot
														</div>
														<div class="col-sm-4">
															<input type="checkbox" name="ao4"> Prenup Video
														</div>
														<div class="col-sm-4">
															<input type="checkbox" name="ao5"> Out of Town
														</div>
													</div>
                                                    
                                                </div>
                                            </div>
											<p>Please Note that amount should be in number form to be a accepted by the system.</p>
											<div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Amount to Pay</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="number" name="aToPay" required>
                                                </div>
                                            </div>
											
											<div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Amount Payed</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="number" name="aPayed" required>
                                                </div>
                                            </div>
											<p>Please Note that if the customer doesn't want an email update, leave the input as blank.</p>
											
											<div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Email Update</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="text" name="eUpdate">
                                                </div>
                                            </div>
											
											<p>This Note is optional, and can be left as blank.</p>
											<div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Note</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="text" name="Notes">
                                                </div>
                                            </div>
											
                                                <button type="button" class="btn float-right btn-primary waves-effect waves-light" onclick="onSubmit()">SEND</button> 
                                                <button type="reset" class="btn float-right btn-danger waves-effect waves-light">CLEAR</button>
                                            
											</form>
											
                                            
											
                                            
												
												

                                        </div>
                                    </div>

                                    

                                </div> <!-- end col -->
                            </div> <!-- end row -->

                        </div><!-- container-fluid -->

                    </div> <!-- Page content Wrapper -->

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

        <!-- Plugins js -->
        <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/plugins/select2/js/select2.min.js"></script>
        <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js"></script>
        <script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
        <script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

        <!-- Plugins Init js -->
        <script src="assets/pages/form-advanced.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
		<script src="assets/js/app.check.js"></script>
		<script src="assets/js/app.custom.js"></script>
		
		<script type='text/javascript'>
			var baseURL="<?php echo base_url();?>";
			
			var datesForDisable = [<?php echo ArrToArrText($sched_dates,"0");?>];

		</script>
		<script src="assets/js/page/<?php echo $page;?>.js"></script>

    </body>
</html>