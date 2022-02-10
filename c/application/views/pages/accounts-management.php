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

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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

                        <div class="container-fluid">

                            


                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="datatable" class="table table-striped dt-responsive nowrap table-vertical" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
													<th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
													<?php
														for($i = 0; $i < count($all_ac_details); $i++){
															
															echo "<tr>
																	<td>
																		<b class=\"font-600 text-muted\">{$all_ac_details[$i]['ac_name']}</b>
																	</td>
																	<td><input type=\"text\" class=\"form-control\" disabled value=\"{$all_ac_details[$i]['ac_email']}\" id=\"em$i\"><input type=\"hidden\" value=\"{$all_ac_details[$i]['ac_email']}\" id=\"temp$i\"></td>
																	<td>".($all_ac_details[$i]['ac_type']==1 ? "Admin":"Staff")."</td>
																	<td>".($all_ac_details[$i]['ac_stat']==1 ? "Enabled":"Disabled")."</td>
																	<td>
																		".($id_ignore!=$all_ac_details[$i]['ac_id'] ? "
																		<a href=\"#\" class=\"m-r-15 text-muted\" data-toggle=\"tooltip\" onclick=\"changeEmail('em$i','ca$i','ca2$i','".(37892+$all_ac_details[$i]['ac_id'])."');\" data-placement=\"top\" title=\"\" data-original-title=\"Edit Email\"><i class=\"mdi mdi-pencil font-18\"></i></a>
																		<a href=\"#\" class=\"m-r-15 text-muted\" data-toggle=\"tooltip\"  onclick=\"cancelEmail('em$i','ca$i',this.id,'temp$i');\" data-placement=\"top\" title=\"\" data-original-title=\"Cancel\" id='ca2$i' style=\"display: none;\"><i style=\"display: none;\" id='ca$i' class=\"mdi mdi-close font-18\"></i></a>
																		<a href=\"#\" class=\"m-r-15 text-muted\" data-toggle=\"tooltip\" onclick=\"changeType('".(37892+$all_ac_details[$i]['ac_id'])."');\" data-placement=\"top\" title=\"\" data-original-title=\"Promote/Demote\"><i class=\"mdi mdi-camera-front font-18\"></i></a>
																		<a href=\"#\" class=\"m-r-15 text-muted\" data-toggle=\"tooltip\" onclick=\"changeStat('".(37892+$all_ac_details[$i]['ac_id'])."');\" data-placement=\"top\" title=\"\" data-original-title=\"Enable/Disable\"><i class=\"mdi mdi-file-lock font-18\"></i></a>
																		<a href=\"#\" class=\"text-muted\" data-toggle=\"tooltip\" onclick=\"forgetPass('".(37892+$all_ac_details[$i]['ac_id'])."');\" data-placement=\"top\" title=\"\" data-original-title=\"Forget Password\"><i class=\"mdi mdi-file-send font-18\"></i></a>
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
                            </div>

                        </div><!-- container -->

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

        <!-- Datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

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