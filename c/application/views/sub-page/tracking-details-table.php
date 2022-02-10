<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('main_helper'); 
	//if(isset($tnumDetails)&&isset($tNumHistory))
		echo "<div class=\"col-md-12 justify-content-center\" style=\"padding:0px;margin:0px;\">
                <div class=\"card m-b-20 card-body\">
					<h3 class=\"card-title font-20 mt-0\">Current Event Details</h3>
					<table class=\"table table-bordered track_tbl\">
						<thead>
							<tr>
								<th>Tracking Number</th>
								<th>Bride's Name</th>
								<th>Groom's Name</th>
								<th>Date Scheduled</th>
							</tr>
						</thead>
							<tbody>
								<tr>
									<td>{$tNumDetails[0]['tracking_num']}</td>
									<td>{$tNumDetails[0]['sched_bname']}</td>
									<td>{$tNumDetails[0]['sched_gname']}</td>
									<td>".date("m/d/Y", strtotime($tNumDetails[0]['sched_date']))."</td>
								</tr>
							</tbody>
					</table>
					<table class=\"table table-bordered track_tbl\">
						<thead>
							<tr>
								<th>Package</th>
								<th>Add-ons</th>
								<th>Balance</th>
							</tr>
						</thead>
							<tbody>
								<tr>
									<td>".getPackage($tNumDetails[0]['sched_package'])."</td>
									<td>".getAddOns($tNumDetails[0]['sched_addons'])."</td>
									<td>".($tNumDetails[0]['sched_amount']<=$tNumDetails[0]['sched_payed'] ? "Fully Paid":money($tNumDetails[0]['sched_amount']-$tNumDetails[0]['sched_payed']))."</td>
								</tr>
							</tbody>
					</table>
					
					<h3 class=\"card-title font-20 mt-0\">Event Changes History</h3>
					<table class=\"table table-bordered track_tbl\">
						<thead>
							<tr>
								<th></th>
								<th>Action</th>
								<th>Status</th>
								<th>Updated by</th>
								<th>Date/Time</th>
							</tr>
						
						</thead>
							<tbody>";
								$this->load->view('sub-page/tracking-history-table', array('tnumDetails' => $tNumHistory));
							echo "</tbody>
					</table>
                 </div>
            </div>";
	
?>
