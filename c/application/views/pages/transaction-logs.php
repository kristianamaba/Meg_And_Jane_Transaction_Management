<!doctype html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	if($rank!="1")
		header('Location: home');
		
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

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                                    <div class="card m-b-20">
                                        <div class="card-body">

                                            <h4 class="mt-0 header-title">Event Changes Logs</h4>
                                            <p class="text-muted m-b-30 font-14">All the creation, and update of any event would be recorded here.
                                            </p>

                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
														<th>Tracking #</th>
                                                        <th>Name</th>
                                                        <th>Action</th>
														<th>Phase</th>
                                                        <th>Package</th>
                                                        <th>Scheduled Date</th>
                                                        <th>Add-ons</th>
                                                        <th>To be Paid</th>
														<th>Current Payment</th>
														<th>Edit Date</th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    
														<?php //
															for($i = 0; $i < count($all_trans_logs); $i++ ){
																if(checkIfChanged(array($all_trans_logs[$i][3],$all_trans_logs[$i][4],$all_trans_logs[$i][5],$all_trans_logs[$i][6],$all_trans_logs[$i][7],$all_trans_logs[$i][8])))
																	echo "<tr>
																			<td>{$all_trans_logs[$i][0]}</td>
																			<td>{$all_trans_logs[$i][1]}</td>
																			<td>{$all_trans_logs[$i][2]}</td>
																			<td>".($all_trans_logs[$i][3] != "N/C" ? getPhase($all_trans_logs[$i][3]) : $all_trans_logs[$i][3])."</td>
																			<td>".($all_trans_logs[$i][4] != "N/C" ? getPackage($all_trans_logs[$i][4]) : $all_trans_logs[$i][4])."</td>
																			<td>{$all_trans_logs[$i][5]}</td>
																			<td>".($all_trans_logs[$i][6] != "N/C" ? getAddOns($all_trans_logs[$i][6]) : $all_trans_logs[$i][6])."</td>
																			<td>{$all_trans_logs[$i][7]}</td>
																			<td>{$all_trans_logs[$i][8]}</td>
																			<td>".date("F d, Y || h A i", strtotime($all_trans_logs[$i][9]))." min</td>
																		</tr>";
															}
														?>
													
                                                    
                                                </tbody>
                                            </table>

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

        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

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