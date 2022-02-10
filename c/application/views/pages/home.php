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

        <!-- C3 charts css -->
        <link href="assets/plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />

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
                                <div class="col-md-6 col-xl-3">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-purple mr-0 float-right"><i class="mdi mdi-basket"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-purple"><?php echo $statCount['s1']+$statCount['s2']+$statCount['s3']+$statCount['s4']; ?></span>
                                            Total Transactions
                                        </div>
                                    </div>
                                </div>
								
                                <div class="col-md-6 col-xl-3">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-blue-grey mr-0 float-right"><i class="mdi mdi-black-mesa"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-blue-grey"><?php echo $statCount['s1']; ?></span>
                                            Pending Schedules
                                        </div>
                                    </div>
                                </div>
								
                                <div class="col-md-6 col-xl-3">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-brown mr-0 float-right"><i class="mdi mdi-buffer"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-brown"><?php echo $statCount['s2']; ?></span>
                                            On-Going Transaction
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="mini-stat clearfix bg-white">
                                        <span class="mini-stat-icon bg-teal mr-0 float-right"><i class="mdi mdi-account"></i></span>
                                        <div class="mini-stat-info">
                                            <span class="counter text-teal"><?php echo $accountActCount['count(*)']; ?></span>
                                            Total Active Accounts
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-xl-9">

                                    <div class="row">
                                        <div class="col-md-9 pr-md-0">
                                            <div class="card m-b-20" style="height: 486px;">
                                                <div class="card-body">
                                                    <h4 class="mt-0 header-title">Productivity Statistics</h4> <br> <br> <br> <br>

                                                  

                                                    <div id="combine-chart" class="m-t-20"></div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 pl-md-0">
                                            <div class=" card m-b-20" style="height: 486px;">
                                                <div class="card-body">
                                                    <div class="m-b-20">
                                                        <p>Weekly Earnings</p>
                                                        <h5><?php echo money($salesDetails['w5']+$salesDetails['w4']+$salesDetails['w3']+$salesDetails['w2']+$salesDetails['w1']); ?></h5>
                                                        <span class="peity-line" data-width="100%" data-peity='{ "fill": ["rgba(103,168,228,0.3)"],"stroke": ["rgba(103,168,228,0.8)"]}' data-height="60"><?php echo "{$salesDetails['w5']},{$salesDetails['w4']},{$salesDetails['w3']},{$salesDetails['w2']},{$salesDetails['w1']}"; ?></span>
                                                    </div>
                                                    <div class="m-b-20">
                                                        <p>Monthly Earnings</p>
                                                        <h5><?php echo money($salesDetails['m12']+$salesDetails['m11']+$salesDetails['m10']+$salesDetails['m9']+$salesDetails['m8']+$salesDetails['m7']+$salesDetails['m6']+$salesDetails['m5']+$salesDetails['m4']+$salesDetails['m3']+$salesDetails['m2']+$salesDetails['m1']); ?></h5>
                                                        <span class="peity-line" data-width="100%" data-peity='{ "fill": ["rgba(74,193,142,0.3)"],"stroke": ["rgba(74,193,142,0.8)"]}' data-height="60"><?php echo "{$salesDetails['m12']},{$salesDetails['m11']},{$salesDetails['m10']},{$salesDetails['m9']},{$salesDetails['m8']},{$salesDetails['m7']},{$salesDetails['m6']},{$salesDetails['m5']},{$salesDetails['m4']},{$salesDetails['m3']},{$salesDetails['m2']},{$salesDetails['m1']}"; ?></span>
                                                    </div>
                                                    <div class="m-b-20">
                                                        <p>Yearly Earnings</p>
                                                        <h5><?php echo money($salesDetails['y5']+$salesDetails['y4']+$salesDetails['y3']+$salesDetails['y2']+$salesDetails['y1']);?></h5>
                                                        <span class="peity-line" data-width="100%" data-peity='{ "fill": ["rgba(232, 65, 38,0.3)"],"stroke": ["rgba(232, 65, 38,0.8)"]}' data-height="60"><?php echo "{$salesDetails['y5']},{$salesDetails['y4']},{$salesDetails['y3']},{$salesDetails['y2']},{$salesDetails['y1']}"; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-3">
                                    <div class="card m-b-20">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Event Analytics</h4>

                                            <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                                                <li class="list-inline-item">
                                                    <h5 class="mb-0"><?php echo $statCount['s1']; ?></h5>
                                                    <p class="text-muted font-14">Pending</p>
                                                </li>
                                                <li class="list-inline-item">
                                                    <h5 class="mb-0"><?php echo $statCount['s2']; ?></h5>
                                                    <p class="text-muted font-14">Editing</p>
                                                </li>
												
                                            </ul>

                                            <div id="donut-chart"></div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end row -->


                            

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

        <!-- Peity chart JS -->
        <script src="assets/plugins/peity-chart/jquery.peity.min.js"></script>

        <!--C3 Chart-->
        <script src="assets/plugins/d3/d3.min.js"></script>
        <script src="assets/plugins/c3/c3.min.js"></script>

        <!-- KNOB JS -->
        <script src="assets/plugins/jquery-knob/excanvas.js"></script>
        <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
		<script src="assets/js/app.check.js"></script>
		<script src="assets/js/page/home.js"></script>
		<script src="assets/js/app.custom.js"></script>
		
		<script>
		var baseURL="<?php echo base_url();?>";
		</script>
		
		<script>
			!function($) {
				"use strict";

				var Dashboard = function() {};

				Dashboard.prototype.init = function () {

					// Peity line
					$('.peity-line').each(function() {
						$(this).peity("line", $(this).data());
					});

					//Knob chart
					$(".knob").knob();

					//C3 combined chart
					c3.generate({
						bindto: '#combine-chart',
						data: {
							columns: [
						['Pending', <?php echo "{$statMDetails['s1_6']},{$statMDetails['s1_5']},{$statMDetails['s1_4']},{$statMDetails['s1_3']},{$statMDetails['s1_2']},{$statMDetails['s1_1']}";?>],
								['Editing', <?php echo "{$statMDetails['s2_6']},{$statMDetails['s2_5']},{$statMDetails['s2_4']},{$statMDetails['s2_3']},{$statMDetails['s2_2']},{$statMDetails['s2_1']}";?>],
								['Completed', <?php echo "{$statMDetails['s3_6']},{$statMDetails['s3_5']},{$statMDetails['s3_4']},{$statMDetails['s3_3']},{$statMDetails['s3_2']},{$statMDetails['s3_1']}";?>],
								['Cancelled', <?php echo "{$statMDetails['s4_6']},{$statMDetails['s4_5']},{$statMDetails['s4_4']},{$statMDetails['s4_3']},{$statMDetails['s4_2']},{$statMDetails['s4_1']}";?>]
							],
							types: {
								Pending: 'bar',
								Editing: 'bar',
								Completed: 'bar',
								Cancelled: 'bar'
							},
							colors: { 
								Pending: "#ffdb58",
								Editing: "#a2c4c9",
								Completed: "#32CD32",
								Cancelled: "#e2580b"
							}
						},
						axis: {
							x: {
								type: 'categorized'
							}
						}
					});

					//C3 Donut Chart
					c3.generate({
						bindto: '#donut-chart',
						data: {
							columns: [
								['Pending', <?php echo $statCount['s1']; ?>],
								['Editing', <?php echo $statCount['s2']; ?>],
								['Completed', <?php echo $statCount['s3']; ?>],
								['Cancelled', <?php echo $statCount['s4']; ?>]
							],
							type : 'donut'
						},
						donut: {
							title: "Event Analytics",
							width: 30,
							label: {
								show:false
							}
						},
						color: {
							pattern: ["#ffdb58","#a2c4c9","#32CD32","#e2580b"]
						}
					});

				},
					$.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard

			}(window.jQuery),

			//initializing
				function($) {
					"use strict";
					$.Dashboard.init()
				}(window.jQuery);
		</script>

    </body>
</html>