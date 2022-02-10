<!doctype html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('main_helper');
$this->load->helper('device_helper');
$cDate = date('Y-m-d H:i:s');
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


		<!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		
		
        <!-- Plugins css -->
        <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- Basic Css files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<style>
			.responsive-text {
			  font-size: 10px;  
			  font-size: min(1.6vw, 15px);
			}
			
		</style>

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
											<h4 class="mt-0 header-title">Personal Account Management</h4>
                                            <p class="text-muted m-b-30 font-14">Please note that the user name is not changable after creation.</p>

                                            <form id="uProfileForm">
												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Name</label>
													<div class="col-sm-8">
														<input class="form-control" type="text" value="<?php echo $ac_details[0]['ac_name']; ?>" disabled readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Email</label>
													<div class="col-sm-8">
														<input class="form-control" type="email" value="<?php echo $ac_details[0]['ac_email']; ?>" name="email">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Password</label>
													<div class="col-sm-8">
														<input class="form-control" type="password" value="" name="pass">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-text-input" class="col-sm-4 col-form-label">2 Step Authentication</label>
													<div class="col-sm-8">
														<input type="checkbox" id="switch2Factor" name="2factor" <?php echo $ac_details[0]['ac_2step']==1 ? "checked":""; ?> switch="none" />
														<label for="switch2Factor" data-on-label="On" data-off-label="Off"></label>
													</div>
												</div>
											</form>
											<button type="button" onclick="onSubmit();" class="btn float-right btn-primary waves-effect waves-light">Save</button> 
                                            <button type="button" onclick="window.location.href='home';" class="btn float-right btn-danger waves-effect waves-light">Cancel</button>

                                            
												
												

                                        </div>
                                    </div>

                                    

                                </div> <!-- end col -->
                            </div> <!-- end row -->
							
							
							<div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
										<div class="row">
											<div class="col-sm">
											  <h4 class="mt-0 header-title">Personal Account Session Management</h4>
												<p class="text-muted m-b-30 font-14">Here, the user can delete sessions and view login history.</p>
											</div>
											<div class="col-sm text-center">
											  <button type="button" onclick="onViewLoginHistory();" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn  btn-primary waves-effect waves-light">View Login History</button> 
											  <button type="button" onclick="deleteAllAccountSession();" class="btn  btn-secondary waves-effect waves-light">Delete All Session</button> 
											</div>
										  </div>
											
											
                                            <table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th class="responsive-text" >Device Details</th>
                                                    <th class="responsive-text" >IP_Details</th>
                                                    <th class="responsive-text" >Login_Time</th>
													<th class="responsive-text" >Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
													<?php
														for($i = 0; $i < count($ac_sessions); $i++){
															$devArr = sortDeviceDetails($ac_sessions[$i]['s2']);
															echo "<tr>
																	<td class=\"responsive-text\" >
																		<b class=\"font-600 text-muted\">{$devArr[0]} - ".($devArr[1] == "Google Chrome 4.0"||$devArr[1] == "Unknown ?" ? "Mobile App" : $devArr[1])." - {$devArr[2]}</b>
																	</td>
																	<td class=\"responsive-text\" ><a href='#' onclick=\"onViewIP('{$ac_sessions[$i]['s3']}')\">Click to View</a></td>
																	<td class=\"responsive-text\" >".getDifDate($ac_sessions[$i]['s4'],$cDate)." ago</td>
																	<td class=\"responsive-text\" >
																		".(cleanS($_SERVER['HTTP_USER_AGENT'])!=$ac_sessions[$i]['s2'] ? "
																		<a href=\"#\" class=\"text-muted\" data-toggle=\"tooltip\" onclick=\"onDeleteSession('".(37892+$ac_sessions[$i]['s1'])."');\" data-placement=\"top\" title=\"\" data-original-title=\"Delete Session\"><i class=\"mdi mdi-close font-18\"></i></a>
																		":"<i>Current Account</i>")."
																		
																	</td>
																</tr>";
														}
													?>
                                                    

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- end row -->

                        </div><!-- container-fluid -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <?php $this->load->view('sub-page/footer'); ?>
				
				
				
				
				<!--  Modal content for the above example -->
                                                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Login History</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body" id="login-history" style="overflow-y:scroll; height:700px;">
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
				
				

                                                   

                                                    <!-- sample modal content -->
                                                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0" id="myModalLabel">Internet Protocol Details</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body" id="ip_details_body">
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                

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
		
		<!-- Datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Plugins Init js -->
        <script src="assets/pages/form-advanced.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
		<script src="assets/js/app.check.js"></script>
		<script src="assets/js/app.custom.js"></script>
		<script src="assets/js/page/<?php echo $page;?>.js"></script>
		
		<script>
		var baseURL="<?php echo base_url();?>";
		
				
		</script>

    </body>
</html>