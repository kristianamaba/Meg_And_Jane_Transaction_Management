<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(count($details)>2)
			echo "<table class=\"table\">
				  <thead>
					<tr>
					  <th scope=\"col\" >Name</th>
					  <th scope=\"col\">Details</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td>IP</td>
					  <td>{$details['ip']}</td>
					</tr>
					<tr>
					  <td>City</td>
					  <td>{$details['city']}</td>
					</tr>
					<tr>
					  <td>Region</td>
					  <td>{$details['region']}</td>
					</tr>
					<tr>
					  <td>Country</td>
					  <td>{$details['country']}</td>
					</tr>
					<tr>
					  <td>Location</td>
					  <td><a href=\"http://www.google.com/maps/search/{$details['loc']}\" target=\"_blank\">{$details['loc']}</a></td>
					</tr>
					<tr>
					  <td>Telco</td>
					  <td>{$details['org']}</td>
					</tr>
					<tr>
					  <td>Postal</td>
					  <td>{$details['postal']}</td>
					</tr>
					<tr>
					  <td>Timezone</td>
					  <td>{$details['timezone']}</td>
					</tr>
				  </tbody>
				</table>";
		else
			echo "0";
?>