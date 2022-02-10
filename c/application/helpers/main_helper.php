<?php  

	function money($t){
		return "₱ ". number_format($t,2);
	}
	function cleanS($t){
	  return str_replace(array(';','\\'), '',$t);
  }
	function checkIfChanged($arr){
		for($i = 0; $i < count($arr); $i++)
			if($arr[$i]!="N/C")
				return true;
	return false;
	}
	
	function ArrToArrText($Arr,$t){
		$returnText = " ";
		for($i = 0; $i < count($Arr); $i++)
			if($t != $Arr[$i]['sched_date'])
				$returnText .= "\"". $Arr[$i]['sched_date'] . "\",";
		return substr_replace($returnText ,"",(strlen($returnText)>1 ? -1 : 0));
	}
	
	function getPhase($index){
		$Phase = array("Pending","Editing","Completed","Cancelled");
		return $Phase[$index-1];
	}
	
	function getPackage($index){
		
		$package = array("Serendipity","Love","Ever After");
		return $package[$index-1];
	}
	
	function getAddOns($jsonVar){
		$addOns = array("Photo Album","Wedding Portrait","Prenup Shoot","Prenup Video","Out of Town");
		$returnText = "";
		$jsonVar = json_decode($jsonVar);
		for($i = 0; $i < count($jsonVar); $i++)
			$returnText .= $addOns[$jsonVar[$i]-1]. ", ";
		return substr_replace($returnText ,"",(strlen($returnText)>2 ? -2 : 0));
	}
	
	function getDifDate($date1,$date2){
	  $date1 = strtotime($date1);  
	  $date2 = strtotime($date2);
	  
	  $timeAr = array("year/s","month/s","day/s","hour/s","minute/s","second/s");
	  $indexD;
	  $difTxt = "";
	  // Formulate the Difference between two dates 
	  $diff = abs($date2 - $date1);  
		  
	  
	  // To get the year divide the resultant date into total seconds in a year
	  $years = floor($diff / (365*60*60*24));  $indexD = 0;
	  
	  if($years==0) {   
		  // To get the month, subtract it with years and divide the resultant date into total seconds in a month
		  $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24));   $indexD = 1; 
			 
		  if($months==0){  
			  // To get the day, subtract it with years and months and divide the resultant date into total seconds in a days (60*60*24) 
			  $days = floor(($diff - $years * 365*60*60*24 -$months*30*60*60*24)/ (60*60*24));   $indexD = 2;
				  
			  if($days==0){
				  // To get the hour, subtract it with years, months & seconds and divide the resultant date into total seconds in a hours (60*60) 
				  $hours = floor(($diff - $years * 365*60*60*24   - $months*30*60*60*24 - $days*60*60*24) / (60*60));   $indexD = 3;
					  
				  if($hours==0){  
					  // To get the minutes, subtract it with years, months, seconds and hours and divide the resultant date into total seconds i.e. 60 
					  $minutes = floor(($diff - $years * 365*60*60*24   - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60)/ 60);   $indexD = 4;
						  
					  if($minutes==0){
						  // To get the minutes, subtract it with years, months, seconds, hours and minutes  
						  $seconds = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60 - $minutes*60)); $indexD = 5;
					  }
				  }			  
			  }
		  }	  
		}
	  // Print the result 
	  return max((isset($years) ? $years : 0),(isset($months) ? $months : 0),(isset($days) ? $days : 0),(isset($hours) ? $hours : 0),(isset($minutes) ? $minutes : 0),(isset($seconds) ? $seconds : 0)) . " " . $timeAr[$indexD];
	}
?>