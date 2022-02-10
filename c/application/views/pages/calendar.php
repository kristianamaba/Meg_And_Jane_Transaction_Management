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

        <!--calendar css-->
        <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />

        <!-- Basic Css files -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/css/tracking.css" rel="stylesheet" type="text/css">
		<style>
			span.fc-title {
				color: #333333 !important;
			}
		</style>

    </head>


    <body class="fixed-left" >

        <?php if(!$mobile)$this->load->view('sub-page/header'); ?>

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper"  <?php if($mobile) echo 'style="padding-top:10px"'; ?> >

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id='calendar'></div>

                                            <div style='clear:both'></div>
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
			
			<!--  Modal content for the above example  <h5 class="modal-title mt-0" id="myLargeModalLabel">Tracking #</h5> -->
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="bs-example-modal-lg" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                 <div class="modal-dialog modal-lg">
					
                    <div class="modal-content" style="padding:0px;margin:0px;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
                        <div class="modal-body" id="tnumDetails" style="padding:0px;margin:0px;">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

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

        <!-- Jquery-Ui -->
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/moment/moment.js"></script>
        <script src='assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
        <!-- App js -->
        <script src="assets/js/app.js"></script>
		<script src="assets/js/app.check.js"></script>
		<script src="assets/js/app.custom.js"></script>
		<script src="assets/js/page/<?php echo $page;?>.js"></script>
		
		<script>
			var baseURL="<?php echo base_url();?>";
			
			$(document).ready(function() {
			/* initialize the external events
			 -----------------------------------------------------------------*/

			$('#external-events div.external-event').each(function() {

				// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
				// it doesn't need to have a start or end
				var eventObject = {
					title: $.trim($(this).text()) // use the element's text as the event title
				};

				// store the Event Object in the DOM element so we can get to it later
				$(this).data('eventObject', eventObject);

				// make the event draggable using jQuery UI
				$(this).draggable({
					zIndex: 999,
					revert: true,      // will cause the event to go back to its
					revertDuration: 0  //  original position after the drag
				});

			});


			/* initialize the calendar
			 -----------------------------------------------------------------*/

			var calendar =  $('#calendar').fullCalendar({
				header: {
					left: 'title',
					right: 'prev,next today'
				},
				editable: false,
				firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
				selectable: false,
				defaultView: 'month',
				contentHeight:"auto",
				axisFormat: 'h:mm',
				columnFormat: {
					month: 'ddd',    // Mon
					week: 'ddd d', // Mon 7
					day: 'dddd M/d',  // Monday 9/7
					agendaDay: 'dddd d'
				},
				titleFormat: {
					month: 'MMMM YYYY', // September 2009
					week: "MMMM YYYY", // September 2009
					day: 'MMMM YYYY'                  // Tuesday, Sep 8, 2009
				},
				droppable: false, // this allows things to be dropped onto the calendar !!!
				eventClick: function(calEvent, jsEvent, view) {
					onSubmit(calEvent.description);
				  },
				events: [
					<?php 
					$color = array("#ffdb58","#a2c4c9","#32CD32","#e2580b");
						for($i = 0; $i < count($sched_dates_WNAME); $i++)
							echo '{title:"'.$sched_dates_WNAME[$i]['sched_gname'] .' & '.$sched_dates_WNAME[$i]['sched_bname'].'",
									start: new Date('.date("Y, m-1,d", strtotime($sched_dates_WNAME[$i]['sched_date'])).'),
									description:"'.$sched_dates_WNAME[$i]["tracking_num"].'",
									color  : "'.$color[$sched_dates_WNAME[$i]['sched_stat']-1].'"},';
					?>
				],
				displayEventTime: false,
			});


		});
		</script>

    </body>
</html>