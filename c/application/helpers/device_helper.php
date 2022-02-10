<?php  

	

  
	function sortDeviceDetails($t){
		$r1 = isMobile($t);
		$r2 = getBrowser($t);
		$r3 = getUserPlatform($t);
		return array(($r1 ? "Mobile":"Desktop"), $r2['name']." ".$r2['version'],$r3);
	}
	
	function checkCMobileApp($t){
		$t = str_replace(array(';','\\'), '',$t);
		$r2 = getBrowser($t);
		if($r2['name']." ".$r2['version']=="Google Chrome 4.0"){
			return true;
		}else{
			return false;
		}
	}
	
	function getUserPlatform($t){
		$str_ret = "";
		$r = 0;
		for($i = 0; $i < strlen($t)&&$r<2; $i++){
			if($t[$i]=="("||$t[$i]==")")
				$r++;
			
			if($r == 1)
				$str_ret .= $t[$i];
		}
		
		return substr($str_ret, 1);
	}

	function isMobile($uagent) {
		
		$mobile_device = false;
		if (preg_match("/(android|mobile|silk|ipad|iphone|ipod)/i", $uagent)) {
			$mobile_device = true;
		}
		
		return $mobile_device;
	}
	
	function getBrowser($uagent)
	{
		
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";
		$ub= '';

		//First get the platform?
		if (preg_match('/linux/i', $uagent)) {
			$platform = 'Linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $uagent)) {
			$platform = 'Mac';
		}
		elseif (preg_match('/windows|win32/i', $uagent)) {
			$platform = 'Windows';
		}

		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$uagent) && !preg_match('/Opera/i',$uagent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Trident/i',$uagent))
		{ // this condition is for IE11
			$bname = 'Internet Explorer';
			$ub = "rv";
		}
		elseif(preg_match('/Firefox/i',$uagent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$uagent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$uagent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$uagent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$uagent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}
	   
		// finally get the correct version number
		// Added "|:"
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		 ')[/|: ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $uagent, $matches)) {
			// we have no matching number just continue
		}

		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($uagent,"Version") < strripos($uagent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}

		// check if we have a number
		if ($version==null || $version=="") {$version="?";}

		return array(
			'userAgent' => $uagent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);
	}
	
	
?>