<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('main_helper');
$this->load->helper('device_helper');
$cDate = date('Y-m-d H:i:s');

	echo "<table id=\"datatable\" class=\"table table-striped dt-responsive nowrap table-vertical\" width=\"100%\" cellspacing=\"0\">
                                                <thead>
                                                <tr>
                                                    <th class=\"responsive-text\" >Device Details</th>
                                                    <th class=\"responsive-text\" >IP_Details</th>
                                                    <th class=\"responsive-text\" >Login_Time</th>
                                                </tr>
                                                </thead>
                                                <tbody>";
														for($i = 0; $i < count($ac_login_history); $i++){
															$devArr = sortDeviceDetails($ac_login_history[$i]['s2']);
															echo "<tr>
																	<td class=\"responsive-text\" >
																		<b class=\"font-600 text-muted\">{$devArr[0]} - ".($devArr[1] == "Google Chrome 4.0" ? "Mobile App" : $devArr[1])." - {$devArr[2]}</b>
																	</td>
																	<td class=\"responsive-text\" ><a href='#' onclick=\"onViewIP('{$ac_login_history[$i]['s3']}')\">Click to View</a></td>
																	<td class=\"responsive-text\" >".getDifDate($ac_login_history[$i]['s4'],$cDate)." ago</td>
																</tr>";
														}
                                                    
echo "</tbody></table>";
                                                
?>