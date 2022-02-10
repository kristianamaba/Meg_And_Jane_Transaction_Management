<!doctype html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('main_helper');
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


        <!-- Basic Css files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/css/tracking.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <?php if(!$mobile)$this->load->view('sub-page/header'); ?>

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper" <?php if($mobile) echo 'style="padding-top:10px"'; ?> >

                        <div class="container-fluid">

                           <div class="card m-b-20">
                                        <div class="card-body">

                                            <h4 class="mt-0 header-title">Scheduled Transaction List</h4>
                                            <p class="text-muted m-b-30 font-14">Here are the pending, editing, complete and cancelled list. Click the tabs according to your needs.</p>

                                            <!-- Nav tabs -->
                                            <ul class="nav nav-pills nav-justified" role="tablist">
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">
                                                        <span class="d-none d-md-block">Pending</span><span class="d-block d-md-none"><i class="mdi mdi-briefcase-upload h5"></i></span>
                                                    </a>
                                                </li>
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">
                                                        <span class="d-none d-md-block">Editing</span><span class="d-block d-md-none"><i class="mdi mdi-table-edit h5"></i></span>
                                                    </a>
                                                </li>
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab">
                                                        <span class="d-none d-md-block">Complete</span><span class="d-block d-md-none"><i class="mdi mdi-checkbox-marked-outline h5"></i></span>
                                                    </a>
                                                </li>
                                                <li class="nav-item waves-effect waves-light">
                                                    <a class="nav-link" data-toggle="tab" href="#settings-1" role="tab">
                                                        <span class="d-none d-md-block">Cancelled</span><span class="d-block d-md-none"><i class="mdi mdi-close-box-outline h5"></i></span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                                                    <div class="row">
														<?php
														
														
															for($i=0;$i < count($dataAr[0]); $i++){
																echo "<div class=\"col-md-4 col-lg-4 col-xl-3\">
																		<div class=\"card m-b-20\">
																			<div class=\"card-body\">
																				<h4 class=\"card-title font-20 mt-0\">{$dataAr[0][$i]['sched_gname']} & {$dataAr[0][$i]['sched_bname']}</h4>
																				<h6 class=\"card-subtitle text-muted\">".getPackage($dataAr[0][$i]['sched_package'])."</h6>
																				<p class=\"card-text\">
																					<small class=\"text-muted\">Last updated ".getDifDate($dataAr[0][$i]['sched_edit_date'],$cDate)." ago by {$dataAr[0][$i]['ac_name']}</small>
																				</p>
																			</div>
																			
																			<ul class=\"list-group list-group-flush\">
																				<li class=\"list-group-item\"><small class=\"text-muted\">Tracking Number: {$dataAr[0][$i]['tracking_num']}</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Reservation Date: ".date("F d, Y", strtotime($dataAr[0][$i]['sched_date']))."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Add-ons: ".getAddOns($dataAr[0][$i]['sched_addons'])."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Balance: ".(($dataAr[0][$i]['sched_amount']-$dataAr[0][$i]['sched_payed'])==0 ? "Fully Paid" : money($dataAr[0][$i]['sched_amount']-$dataAr[0][$i]['sched_payed']))."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Notes: ".(!empty($dataAr[0][$i]['sched_notes']) ? $dataAr[0][$i]['sched_notes'] : "None")."</small></li>
																			</ul>
																			<div class=\"card-body\">
																				
																				<a href=\"#\" class=\"card-link\" onclick=\"updateEvent('{$dataAr[0][$i]['tracking_num']}')\">Update Event</a>
																				<a href=\"#\" class=\"card-link\" data-toggle=\"modal\" data-target=\".bs-example-modal-lg\"  onclick=\"viewHistory('{$dataAr[0][$i]['tracking_num']}')\">View History</a>
																			</div>
																		</div>
																	</div>";
															}
															
															if(count($dataAr[0]) == 0)
																echo "<p class=\"font-14 mb-0 \" style=\"float: none; margin: 0 auto; margin-top: 50px;\"> No Event at the moment. </p>";
														?>
													</div>
                                                </div>
                                                <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                                                    <div class="row">
														<?php
														
															for($i=0;$i < count($dataAr[1]); $i++){
																echo "<div class=\"col-md-4 col-lg-4 col-xl-3\">
																		<div class=\"card m-b-20\">
																			<div class=\"card-body\">
																				<h4 class=\"card-title font-20 mt-0\">{$dataAr[1][$i]['sched_gname']} & {$dataAr[1][$i]['sched_bname']}</h4>
																				<h6 class=\"card-subtitle text-muted\">".getPackage($dataAr[1][$i]['sched_package'])."</h6>
																				<p class=\"card-text\">
																					<small class=\"text-muted\">Last updated ".getDifDate($dataAr[1][$i]['sched_edit_date'],$cDate)." ago by {$dataAr[1][$i]['ac_name']}</small>
																				</p>
																			</div>
																			
																			<ul class=\"list-group list-group-flush\">
																				<li class=\"list-group-item\"><small class=\"text-muted\">Tracking Number: {$dataAr[1][$i]['tracking_num']}</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Reservation Date: ".date("F d, Y", strtotime($dataAr[1][$i]['sched_date']))."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Add-ons: ".getAddOns($dataAr[1][$i]['sched_addons'])."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Balance: ".(($dataAr[1][$i]['sched_amount']-$dataAr[1][$i]['sched_payed']) == 0 ? "Fully Paid": money($dataAr[1][$i]['sched_amount']-$dataAr[1][$i]['sched_payed']))."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Notes: ".(!empty($dataAr[1][$i]['sched_notes']) ? $dataAr[1][$i]['sched_notes'] : "None")."</small></li>
																			</ul>
																			<div class=\"card-body\">
																				
																				<a href=\"#\" class=\"card-link\" onclick=\"updateEvent('{$dataAr[1][$i]['tracking_num']}')\">Update Event</a>
																				<a href=\"#\" class=\"card-link\" data-toggle=\"modal\" data-target=\".bs-example-modal-lg\"  onclick=\"viewHistory('{$dataAr[1][$i]['tracking_num']}')\">View History</a>
																			</div>
																		</div>
																	</div>";
															}
															
															if(count($dataAr[1]) == 0)
																echo "<p class=\"font-14 mb-0 \" style=\"float: none; margin: 0 auto; margin-top: 50px;\"> No Event at the moment. </p>";
															
															
														?>
													</div>
                                                </div>
                                                <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                                                    <div class="row">
														<?php
														
															for($i=0;$i < count($dataAr[2]); $i++){
																echo "<div class=\"col-md-4 col-lg-4 col-xl-3\">
																		<div class=\"card m-b-20\">
																			<div class=\"card-body\">
																				<h4 class=\"card-title font-20 mt-0\">{$dataAr[2][$i]['sched_gname']} & {$dataAr[2][$i]['sched_bname']}</h4>
																				<h6 class=\"card-subtitle text-muted\">".getPackage($dataAr[2][$i]['sched_package'])."</h6>
																				<p class=\"card-text\">
																					<small class=\"text-muted\">Last updated ".getDifDate($dataAr[2][$i]['sched_edit_date'],$cDate)." ago by {$dataAr[2][$i]['ac_name']}</small>
																				</p>
																			</div>
																			
																			<ul class=\"list-group list-group-flush\">
																				<li class=\"list-group-item\"><small class=\"text-muted\">Tracking Number: {$dataAr[2][$i]['tracking_num']}</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Reservation Date: ".date("F d, Y", strtotime($dataAr[2][$i]['sched_date']))."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Add-ons: ".getAddOns($dataAr[2][$i]['sched_addons'])."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Total Profit: ".money($dataAr[2][$i]['sched_payed'])."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Notes: ".(!empty($dataAr[2][$i]['sched_notes']) ? $dataAr[2][$i]['sched_notes'] : "None")."</small></li>
																			</ul>
																			<div class=\"card-body\">
																				
																				<a href=\"#\" class=\"card-link\" data-toggle=\"modal\" data-target=\".bs-example-modal-lg\"  onclick=\"viewHistory('{$dataAr[2][$i]['tracking_num']}')\">View History</a>
																			</div>
																		</div>
																	</div>";
															}
															
															if(count($dataAr[2]) == 0)
																echo "<p class=\"font-14 mb-0 \" style=\"float: none; margin: 0 auto; margin-top: 50px;\"> No Event at the moment. </p>";
															
															
														?>
													</div>
                                                </div>
                                                <div class="tab-pane p-3" id="settings-1" role="tabpanel">
                                                    <div class="row">
														<?php
														
															for($i=0;$i < count($dataAr[3]); $i++){
																echo "<div class=\"col-md-4 col-lg-4 col-xl-3\">
																		<div class=\"card m-b-20\">
																			<div class=\"card-body\">
																				<h4 class=\"card-title font-20 mt-0\">{$dataAr[3][$i]['sched_gname']} & {$dataAr[3][$i]['sched_bname']}</h4>
																				<h6 class=\"card-subtitle text-muted\">".getPackage($dataAr[3][$i]['sched_package'])."</h6>
																				<p class=\"card-text\">
																					<small class=\"text-muted\">Last updated ".getDifDate($dataAr[3][$i]['sched_edit_date'],$cDate)." ago by {$dataAr[3][$i]['ac_name']}</small>
																				</p>
																			</div>
																			
																			<ul class=\"list-group list-group-flush\">
																				<li class=\"list-group-item\"><small class=\"text-muted\">Tracking Number: {$dataAr[3][$i]['tracking_num']}</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Reservation Date: ".date("F d, Y", strtotime($dataAr[3][$i]['sched_date']))."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Add-ons: ".getAddOns($dataAr[3][$i]['sched_addons'])."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Total Profit: ".money($dataAr[3][$i]['sched_payed'])."</small></li>
																				<li class=\"list-group-item\"><small class=\"text-muted\">Notes: ".(!empty($dataAr[3][$i]['sched_notes']) ? $dataAr[3][$i]['sched_notes'] : "None")."</small></li>
																			</ul>
																			<div class=\"card-body\">
																				
																				<a href=\"#\" class=\"card-link\" data-toggle=\"modal\" data-target=\".bs-example-modal-lg\" onclick=\"viewHistory('{$dataAr[3][$i]['tracking_num']}')\">View History</a>
																			</div>
																		</div>
																	</div>";
															}
															
															if(count($dataAr[3]) == 0)
																echo "<p class=\"font-14 mb-0 \" style=\"float: none; margin: 0 auto; margin-top: 50px;\"> No Event at the moment. </p>";
															
															
														?>
													</div>
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

		<!--  Modal content for the above example -->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
				<div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Tracking #</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered track_tbl">
							<thead>
								<tr>
									<th></th>
									<th>Action</th>
									<th>Status</th>
									<th>Updated by</th>
									<th>Date/Time</th>
								</tr>
							</thead>
							<tbody id="tnumHistoryContent">
							</tbody>
						</table>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
		
		
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
		<script src="assets/js/app.check.js"></script>
		<script src="assets/js/app.custom.js"></script>
		<script src="assets/js/page/<?php echo $page;?>.js"></script>
		
		<script type='text/javascript'>
			var baseURL="<?php echo base_url();?>";
		</script>


    </body>
</html>