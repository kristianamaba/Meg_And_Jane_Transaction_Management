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
                                        
										<h4 class="mt-0 header-title">Personal Account Inbox</h4>
                                        <p class="text-muted m-b-30 font-14">Please note that the user is incapable of sending a message, but is able to recieve notifications from the system.</p>
                                        <div class="card m-t-20">
                                            <ul class="message-list">
												<li>
                                                    <a href="">
                                                        <div class="col-mail col-mail-1" style="padding-left:15px">
                                                            <p class="title">From</p>
                                                        </div>
                                                        <div class="col-mail col-mail-2">
                                                            <div class="subject">Message
                                                            </div>
                                                            <div class="date">Date</div>
                                                        </div>
                                                    </a>
                                                </li>
												
                                                   
                                                    
                                                
												
												<?php 
												
												if (count($userInbox) == 0)
													echo "<li><p class=\"text-muted text-center m-b-30 font-14\">No System Message Currently</p></li>";
												else
													for ($i = 0; $i < count($userInbox); $i++){
														echo "<li ".($userInbox[$i]['inbox_stat']=="1"? "class=\"unread\"":"")." id=\"l$i\" data-toggle=\"modal\" data-target=\".bs-example-modal-lg\" onclick=\"viewMessage('l$i','m$i','d$i','".($userInbox[$i]['inbox_id']+12897)."');\">
																<div class=\"col-mail col-mail-1\" style=\"padding-left:15px\">
																	<p class=\"title\">System Message</p><a href=\"#\" class=\"text-muted\" data-toggle=\"tooltip\" data-placement=\"top\"  data-original-title=\"Read\"><span class=\"star-toggle fa fa-book\"></span></a>
																</div>
																<div class=\"col-mail col-mail-2\">
																	<div class=\"subject\">".strip_tags($userInbox[$i]['inbox_message'])."
																	<input type=\"hidden\" id=\"m$i\" value=\"{$userInbox[$i]['inbox_message']}\">
																	</div>
																	<div class=\"date\" id=\"d$i\">".date("M d", strtotime($userInbox[$i]['inbox_date']))."</div>
																</div>
															</li>";
													}
												
												
												
												
												?>
												
												
												
												
												
												
                                            </ul>
											
											
                                        </div> 

                                        

                                </div>

                            </div><!-- End row -->

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
                        <h5 class="modal-title mt-0" id="FromAndDate"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
						<p id="message"></p>
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

        <!-- App js -->
        <script src="assets/js/app.js"></script>
		<script src="assets/js/app.check.js"></script>
		<script src="assets/js/app.custom.js"></script>
		<script src="assets/js/page/<?php echo $page;?>.js"></script>
		
		
		<script type='text/javascript'>
			var baseURL="<?php echo base_url();?>";
			
		</script>

    </body>
</html>