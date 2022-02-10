<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controller extends CI_Controller {
	public function __construct(){
	parent::__construct();

	// Load Model
	$this->load->model('Main_model');

	// Load base_url 
	$this->load->helper('url');
	}
	
	public function onDeleteAllSession(){
		$this->Main_model->onDeleteAllSession();
	}
	
	
	
	
	public function onDeleteSession(){
		$postData = $this->input->post();
		$this->Main_model->onDeleteSession($postData);
	}
	
	public function checkLoginSession(){
			
		if(!$this->Main_model->checkLoginSession())
			echo '0';
		else 
			echo '1';
	}
	
	public function onViewLoginHistory(){
		$loginHistory = $this->Main_model->viewLoginHistory();
		$data['ac_login_history'] = $loginHistory;
		$this->load->view('sub-page/user-login-history', $data);
	}
	
	public function onViewIP(){
		$postData = $this->input->post();
		$details = json_decode(file_get_contents("http://ipinfo.io/".str_replace(' ', '', $postData['ip'])."/json"),true);
		$data['details'] = $details;
		$this->load->view('sub-page/user-session-list', $data);
		
	}
	
	public function viewInbox(){
		$postData = $this->input->post();
		$this->Main_model->viewInbox($postData);
	}
	
	public function viewAllDetailsByTrackingNum(){
	// POST data
	$postData = $this->input->post();
	
	$tNumDetails = $this->Main_model->getDetailsFromTNum($postData['tnum']);
		if(count($tNumDetails)>=1){
			$tNumHistory = $this->Main_model->getHistoryByTNum($postData['tnum']);
			$data['tNumDetails'] = $tNumDetails;
			$data['tNumHistory'] = $tNumHistory;
			$this->load->view('sub-page/tracking-details-table', $data);
		}
		else{
			echo "Invalid Tracking Number";
		}
	
	}
	
	public function viewHistoryByTNum(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model->getHistoryByTNum($postData['tnum']);
	if(is_array($data)){
		$this->load->view('sub-page/tracking-history-table', array('tnumDetails' => $data));
	}else{
		echo $data;
	}
	
	}
	
	public function forgetPass(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model->forgetPass($postData);
	echo $data;
	}
	 
	public function changeACStat(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model->changeACStat($postData);
	echo $data;
	}
	
	public function changeACEmail(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model->changeACEmail($postData);
	echo $data;
	}
	 
	public function changeACType(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model->changeACType($postData);
	echo $data;
	}
	  
	public function createAccount(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model->createAccount($postData);
	echo $data;
	} 
	
	
	  
	public function changeProfileSettings(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model->updateAccountSettings($postData);
	echo $data;
	}
	  
	  
	  
	public function createEvent(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model->createEventOnDB($postData);
	echo str_replace("\\","",$data);
	}
	
	public function updateEvent(){
	// POST data
	$postData = $this->input->post();

	// get data 
	$data = $this->Main_model-> updateEventOnDB($postData);
	echo str_replace("\\","",$data);
	}
	
	
	

	public function tnumToSession(){
		// POST data
		$postData = $this->input->post();
		
		//to Session
		$this->session->set_userdata('MEGANDJANE_edit_tnum', $postData['tnum']);

		echo '1';
	}
	  


	public function checkSession(){
		$data = $this->Main_model->getIDfromSession($this->session->userdata('MEGANDJANE_loginSession'));
		if(count($data)<='0')
			return false;
		else if(count($data)>='1')
			return true;
	}
  
	public function checkAccount(){
    // POST data
    $postData = $this->input->post();

    // get data 
    $data = $this->Main_model->getAccountDetailsFromEmailandPass($postData);
	if(count($data)<='0'){
		echo "Incorrect Email or Password";
	}
	else if(count($data)>='1'){
		if(isset($data['failed_attempts']))
			echo "Incorrect Password!\nThe System has detected a suspicious activity with your account.\nThe 2 Factor Authentication is then automatically activated.";
		else if($data[0]['ac_stat']=='0')
			echo "Account Deactivated, please contact admin";
		else if($data[0]['ac_stat']=='1'){
			
			if($data[0]['ac_2step']=='1'){
				$randPin = rand(999999, 111111);
				$this->Main_model->changeUserPin($data[0]['ac_id'],$randPin);
				$this->sendMail("Meg and Jane Studio AUTO EMAILING SERVICE",$data[0]['ac_name'],$data[0]['ac_email'],"<table> <tbody> <tr> <td >Hi {$data[0]['ac_name']},</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Please use the following security code for the Meg & Jane studio account {$data[0]['ac_email']}</a>.</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Security code: {$randPin}</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Thanks,</td> </tr> <tr> <td >The Meg & Jane studio account admin.</td> </tr> </tbody> </table>");
				$this->session->set_userdata('MEGANDJANE_accountname', $data[0]['ac_name']);
				echo "1";
				
			}
			else if($data[0]['ac_2step']=='0'){
				$this->session->set_userdata('MEGANDJANE_accountname', $data[0]['ac_name']);
				$this->loginAccountSession($data[0]['ac_id']);
				echo "0";
			}
				
		}
	}
  }
  
	public function checkPIN(){
    // POST data
    $postData = $this->input->post();

    // get data 
    $data = $this->Main_model->getAccountDetailsFromPIN($postData['pin']);
	if(count($data)<='0'){
		echo "Incorrect PIN";
	}
	else if(count($data)>='1'){
		
		$this->Main_model->changeFailedAttemptReset($data[0]['ac_id']);
		$this->loginAccountSession($data[0]['ac_id']);
		
		echo "1";
	}
  }
  
	function loginAccountSession($id){
	  $user_agent = $_SERVER['HTTP_USER_AGENT'];
	  $ip = $_SERVER['REMOTE_ADDR'];
	  $loginSession = $this->generate_string(200);
	  $this->Main_model->addAccountSession($id,$loginSession,$user_agent,$ip);
	  $this->session->set_userdata('MEGANDJANE_loginSession', $loginSession);
  }
  
	function get_client_ip(){
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		} else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_FORWARDED'])) {
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		} else if (isset($_SERVER['REMOTE_ADDR'])) {
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		} else {
			$ipaddress = 'UNKNOWN';
		}

		return $ipaddress;
	}
  
	function generate_string($strength) {
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$permitted_chars_length = strlen($permitted_chars);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $permitted_chars_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
  
	function sendMail($fromName,$toName,$toEmail,$content){
	  
		if(isset($fromName)&&isset($toName)&&isset($toEmail)&&isset($content)){
			
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);
			$params = array(
				"fromName"=>$fromName,
				"toName"=>$toName,
				"toEmail"=>$toEmail,
				"content"=>$content);
			curl_setopt($ch,CURLOPT_URL,base_url().'index.php/Main_controller/sendEmailPost');
			curl_setopt($ch,CURLOPT_POST,true);
			curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($params));
			curl_setopt($ch, CURLOPT_USERAGENT, 'api');
			curl_setopt($ch, CURLOPT_TIMEOUT, 1); 
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
			curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 10); 
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
			curl_exec($ch);   
			curl_close($ch);
		}
  	}
	
	function sendEmailPost(){
		// Load PHPMailer library
		$this->load->library('phpmailer_lib');

		// // PHPMailer object
		// $mail = $this->phpmailer_lib->load();
		// $mail->isSMTP(); 
		// $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
		// $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
		// $mail->Port = 587; // TLS only
		// $mail->SMTPSecure = 'tls'; // ssl is deprecated
		// $mail->SMTPAuth = true;
		// $mail->Username = 'mailingautomated@gmail.com'; // email
		// $mail->Password = 'j]52=RHTc@.*a+Sge_s+'; // password
		// $mail->setFrom('mailingautomated@gmail.com', "kurt amaba"); // From email and name
		// $mail->addAddress("kristianamaba.kka@gmail.com", "Kurt"); // to email and name
		// $mail->Subject = 'Do Not Reply - Automated Email ' . $this->generate_string(10);
		// $mail->msgHTML("samplke content"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
		// $mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
		// // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
		// $mail->SMTPOptions = array(
		// 					'ssl' => array(
		// 						'verify_peer' => false,
		// 						'verify_peer_name' => false,
		// 						'allow_self_signed' => true
		// 					)
		// 				);
		// $mail->send();
		/*
		if(!$mail->send()){
			echo "Mailer Error: " . $mail->ErrorInfo;
		}else{
			echo "Message sent!";
		}
		*/

		// POST data
		$postData = $this->input->post();
		if(isset($postData['fromName'])&&isset($postData['toName'])&&isset($postData['toEmail'])&&isset($postData['content'])){
			$Subject = 'Do Not Reply - Automated Email ';
			if(isset($postData['subject']))
				$Subject = $postData['subject'];
			
			// Load PHPMailer library
			$this->load->library('phpmailer_lib');

			// PHPMailer object
			$mail = $this->phpmailer_lib->load();
			$mail->isSMTP(); 
			$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
			$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
			$mail->Port = 587; // TLS only
			$mail->SMTPSecure = 'tls'; // ssl is deprecated
			$mail->SMTPAuth = true;
			$mail->Username = 'mailingautomated@gmail.com'; // email
			$mail->Password = 'j]52=RHTc@.*a+Sge_s+'; // password
			$mail->setFrom('mailingautomated@gmail.com', $postData['fromName']); // From email and name
			$mail->addAddress($postData['toEmail'], $postData['toName']); // to email and name
			$mail->Subject = $Subject . $this->generate_string(10);
			$mail->msgHTML($postData['content']); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
			$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
			// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
			$mail->SMTPOptions = array(
								'ssl' => array(
									'verify_peer' => false,
									'verify_peer_name' => false,
									'allow_self_signed' => true
								)
							);
			$mail->send();
			/*
			if(!$mail->send()){
				echo "Mailer Error: " . $mail->ErrorInfo;
			}else{
				echo "Message sent!";
			}
			*/
		}
	}
	
	

}

?>