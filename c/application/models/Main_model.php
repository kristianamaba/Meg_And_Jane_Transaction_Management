<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {
  
	public function __construct(){
	parent::__construct();

	// Load base_url 
	$this->load->helper('url');
	}

  function numOnly($t){
	  return preg_replace('/\D/', '', $t);
  }
  
  function cleanS($t){
	  return str_replace(array(';','\\'), '',$t);
  }
  
  function onDeleteAllSession(){
	  $this->db->query("SET sql_mode = '' ");
	  if($this->checkLoginSession()){
		
			$id = $this->getIDfromSession()[0]['ac_id'];
			$this->db->set('session_stat', '0');
			$this->db->set('session', '0');
			$WhereArray = array('dev_details !=' => $this->cleanS($_SERVER['HTTP_USER_AGENT']),'session_stat' => '1','ac_id' => $id);
			$this->db->where($WhereArray); 
			$this->db->update('session_tbl');
	  }
  }
  
  
  
  function onDeleteSession($postData=array()){
	  $this->db->query("SET sql_mode = '' ");
	  if(!empty($postData['sid'])){
		  
		
		$sid = $this->cleanS($postData['sid']) - 37892;
		
		$sDetails = $this->getSessionDevDetailsFromID($sid);
		
		if(count($sDetails)>=1){
			$sDetails = $sDetails[0]['dev_details'];
			$id = $this->getIDfromSession()[0]['ac_id'];
			$this->db->set('session_stat', '0');
			
			$WhereArray = array('dev_details' => $sDetails,'session_stat' => '1');
			$this->db->where($WhereArray); 
			$this->db->update('session_tbl');
		}
		
	  }
  }
  
  function getSessionDevDetailsFromID($sid){
	  $response = array();
		$this->db->select("dev_details");
			
		$this->db->where('session_id',$sid);
		$this->db->from('session_tbl');
		$records = $this->db->get();
		$response = $records->result_array();
				
		return $response;
			
  }
  
  function viewLoginHistory(){
	  $this->db->query("SET sql_mode = '' ");
	  $id = $this->getIDfromSession()[0]['ac_id'];
			$response = array();
			$this->db->select("dev_details AS s2, dev_ip  AS s3, date  AS s4");
			
			$this->db->where('ac_id',$id);
			$this->db->from('session_tbl');
			$this->db->order_by('date','DESC');
			$records = $this->db->get();
			$response = $records->result_array();
				
			return $response;
			
		
	  }
  
  function getAccountSessionTableDetails(){
	  
		$id = $this->getIDfromSession()[0]['ac_id'];



		$this->db->query("SET sql_mode = '' ");
		
		$response = array();
		$this->db->select("session_id AS s1, dev_details AS s2, dev_ip  AS s3, date  AS s4");
		
		$this->db->where('session_id IN (SELECT MAX(session_id) FROM session_tbl WHERE ac_id = \''.$id.'\' AND session_stat = \'1\' GROUP BY dev_details) ');
		$this->db->from('session_tbl');
		$this->db->group_by("dev_details");
		$this->db->order_by('date','DESC');
		$records = $this->db->get();
		$response = $records->result_array();
			
		return $response;
  }
  
  function getNotif(){
		$this->db->query("SET sql_mode = '' ");
		$id = $this->getIDfromSession()[0]['ac_id'];
		$response = array();
		$this->db->select("count(*)");
		
		$WhereArray = array('ac_id' => $id,'inbox_notif' => null);
		$this->db->where($WhereArray); 
		$this->db->from('inbox_tbl');
		$records = $this->db->get();
		$response = $records->result_array();
			
		return $response[0]['count(*)'];
  }
  
  function setSentNotif(){
		$this->db->query("SET sql_mode = '' ");
		$id = $this->getIDfromSession()[0]['ac_id'];
		$this->db->set('inbox_notif', '1');
		$WhereArray = array('ac_id' => $id,'inbox_notif' => null);
		$this->db->where($WhereArray); 
		$this->db->update('inbox_tbl');
  }
	
	function getAccountRank(){
		$this->db->query("SET sql_mode = '' ");
		$id = $this->getIDfromSession()[0]['ac_id'];
		
		$response = array();
		$this->db->select("ac_type");
		
		$WhereArray = array('ac_id' => $id);
		$this->db->where($WhereArray); 
		$this->db->from('ac_tbl');
		$records = $this->db->get();
			
		$response = $records->result_array();
			
		return $response[0]['ac_type'];
	}
  
	function viewInbox($postData=array()){
	  $this->db->query("SET sql_mode = '' ");
		if(!empty($postData['mesid'])){
			$inbox_id = $this->numOnly($postData['mesid']) - 12897;

			$this->db->set('inbox_stat', '0');
			$this->db->where('inbox_id', $inbox_id );
			$this->db->update('inbox_tbl');
		}
		return 'Something Went Wrong';
	  }
  
	function getUserInbox(){
		$this->db->query("SET sql_mode = '' ");
		$id = $this->getIDfromSession()[0]['ac_id'];
		$response = array();
		$this->db->select("inbox_id,inbox_message,inbox_date,inbox_stat");
		
		$WhereArray = array('ac_id' => $id);
		$this->db->where($WhereArray); 
		$this->db->from('inbox_tbl');
		$this->db->order_by('inbox_date','desc');
		$records = $this->db->get();
			
		$response = $records->result_array();
			
		return $response;
	}
  
	function getAccountMessageCount(){
		$this->db->query("SET sql_mode = '' ");
		$id = $this->getIDfromSession()[0]['ac_id'];
		$response = array();
		$this->db->select("count(*)");
		
		$WhereArray = array('ac_id' => $id,'inbox_stat' => '1');
		$this->db->where($WhereArray); 
		$this->db->from('inbox_tbl');
		$records = $this->db->get();
			
		$response = $records->result_array();
			
		return $response[0]['count(*)'];
	}
  
	function getActiveAccountCount(){
		$this->db->query("SET sql_mode = '' ");
		$response = array();
		$this->db->select("count(*)");
		$this->db->where('ac_stat','1');
		$this->db->from('ac_tbl');
		$records = $this->db->get();
			
		$response = $records->result_array();
			
		return $response[0];
	}

	function getStatCount(){
		$this->db->query("SET sql_mode = '' ");
		$response = array();
		$this->db->select("SUM(IF(sched_stat = 1, 1, 0)) AS s1, 
							SUM(IF(sched_stat = 2, 1, 0)) AS s2,
							SUM(IF(sched_stat = 3, 1, 0)) AS s3, 
							SUM(IF(sched_stat = 4, 1, 0)) AS s4 ");
		$this->db->from('sched_tbl');
		$records = $this->db->get();
			
		$response = $records->result_array();
			
		return $response[0];
	}
  
  function getMontlyStat(){
	  $cDate = date('Y-m-d');
	  $date = new DateTime($cDate);
	  $week = $date->format("W");
	  $month = $date->format("m");
	  $year = $date->format("Y");
	  
	$this->db->query("SET sql_mode = '' ");
	$response = array();
	$this->db->select("SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=1, 1, 0)) AS s1_1,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=2, 1, 0)) AS s2_1,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=3, 1, 0)) AS s3_1,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month--: 12+$month--)." AND trans_stat=4, 1, 0)) AS s4_1,
						
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=1, 1, 0)) AS s1_2,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=2, 1, 0)) AS s2_2,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=3, 1, 0)) AS s3_2,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month--: 12+$month--)." AND trans_stat=4, 1, 0)) AS s4_2,
						
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=1, 1, 0)) AS s1_3,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=2, 1, 0)) AS s2_3,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=3, 1, 0)) AS s3_3,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month--: 12+$month--)." AND trans_stat=4, 1, 0)) AS s4_3,
						
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=1, 1, 0)) AS s1_4,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=2, 1, 0)) AS s2_4,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=3, 1, 0)) AS s3_4,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month--: 12+$month--)." AND trans_stat=4, 1, 0)) AS s4_4,
						
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=1, 1, 0)) AS s1_5,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=2, 1, 0)) AS s2_5,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=3, 1, 0)) AS s3_5,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month--: 12+$month--)." AND trans_stat=4, 1, 0)) AS s4_5,
						
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=1, 1, 0)) AS s1_6,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=2, 1, 0)) AS s2_6,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month: 12+$month)." AND trans_stat=3, 1, 0)) AS s3_6,
						SUM(IF(YEAR(trans_edit_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(trans_edit_date) = ".($month>0 ? $month--: 12+$month--)." AND trans_stat=4, 1, 0)) AS s4_6
	
	");
	$this->db->from('trans_tbl');
	$records = $this->db->get();
		
	$response = $records->result_array();
		
	return $response[0];
  }
  
  function getWeeklyMontlyYearlySales(){
	  $cDate = date('Y-m-d');
	  $date = new DateTime($cDate);
	  $week = $date->format("W");
	  $month = $date->format("m");
	  $year = $date->format("Y");
	  
	$this->db->query("SET sql_mode = '' ");
	$response = array();
	$this->db->select("SUM(IF(YEAR(sched_date) = ".($week<=0 ? $year-1:$year)." AND WEEK(sched_date) = ".($week>0 ? $week--: 53+$week--).", sched_payed, 0)) AS w1,
						SUM(IF(YEAR(sched_date) = ".($week<=0 ? $year-1:$year)." AND WEEK(sched_date) = ".($week>0 ? $week--: 53+$week--).", sched_payed, 0)) AS w2,
						SUM(IF(YEAR(sched_date) = ".($week<=0 ? $year-1:$year)." AND WEEK(sched_date) = ".($week>0 ? $week--: 53+$week--).", sched_payed, 0)) AS w3,
						SUM(IF(YEAR(sched_date) = ".($week<=0 ? $year-1:$year)." AND WEEK(sched_date) = ".($week>0 ? $week--: 53+$week--).", sched_payed, 0)) AS w4,
						SUM(IF(YEAR(sched_date) = ".($week<=0 ? $year-1:$year)." AND WEEK(sched_date) = ".($week>0 ? $week--: 53+$week--).", sched_payed, 0)) AS w5,

						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m1,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m2,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m3,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m4,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m5,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m6,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m7,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m8,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m9,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m10,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m11,
						SUM(IF(YEAR(sched_date) = ".($month<=0 ? $year-1:$year)." AND MONTH(sched_date) = ".($month>0 ? $month--: 12+$month--).", sched_payed, 0)) AS m12,

						SUM(IF(YEAR(sched_date) = ".$year--.", sched_payed, 0)) AS y1,
						SUM(IF(YEAR(sched_date) = ".$year--.", sched_payed, 0)) AS y2,
						SUM(IF(YEAR(sched_date) = ".$year--.", sched_payed, 0)) AS y3,
						SUM(IF(YEAR(sched_date) = ".$year--.", sched_payed, 0)) AS y4,
						SUM(IF(YEAR(sched_date) = ".$year--.", sched_payed, 0)) AS y5");
	$this->db->from('sched_tbl');
	$records = $this->db->get();
		
	$response = $records->result_array();
		
	return $response[0];
  }
  
  
  function getHistoryByTNum($tnum = null){
	if(!empty($tnum)){
		$tNumDetails = $this->getDetailsFromTNum($this->cleanS($tnum));
		
		if(count($tNumDetails)>=1){
			$this->db->query("SET sql_mode = '' ");
			$response = array();
			$AllTransactLogs = $this->getAllTransactLogsBySchedID($tNumDetails[0]['sched_id']);
			for($i = 0; $i < count($AllTransactLogs); $i++){
				$curT = $this->getTransactDetails($AllTransactLogs[$i]['trans_id']);
				$phase = $curT['trans_stat'];
				$package = $curT['trans_package'];
				$sDate = $curT['trans_date'];
				$addOns =$curT['trans_addons'];
				$toBePaid = $curT['trans_amount'];
				$CurPay = $curT['trans_payed'];
				$editDate = $curT['trans_edit_date'];
				
				if($AllTransactLogs[$i]['prev_trans_id']!=null){
					$prevT = $this->getTransactDetails($AllTransactLogs[$i]['prev_trans_id']);
					if($phase == $prevT['trans_stat']) $phase = "N/C";
					if($package == $prevT['trans_package']) $package = "N/C";
					if($sDate == $prevT['trans_date']) $sDate = "N/C";
					if($addOns == $prevT['trans_addons']) $addOns = "N/C";
					if($toBePaid == $prevT['trans_amount']) $toBePaid = "N/C";
					if($CurPay == '0') $CurPay = "N/C";
				}
				array_push($response,array($this->getTNumFromSchedID($AllTransactLogs[$i]['sched_id']),$this->getNameFromACID($AllTransactLogs[$i]['ac_id']),($AllTransactLogs[$i]['type']==1 ? "Created":"Updated"),$phase,$package,$sDate,$addOns,$toBePaid,$CurPay,$editDate   )    );
			
			}
			return $response;
		}
		return "Invalid Tracking Number";
	  }
	return "No Tracking Number Entered";
  }
  
  
    function getAllTransactLogsBySchedID($sched_id){

	$this->db->query("SET sql_mode = '' ");
	$response = array();
	
    $this->db->select('sched_id,t1.ac_id,t2.ac_name,trans_id,prev_trans_id,type');
	$this->db->where('sched_id',$sched_id);
	$this->db->from('trans_logs_tbl as t1');
	$this->db->join('ac_tbl as t2', 't2.ac_id = t1.ac_id');
	$this->db->order_by('trans_logs_id',"DESC");
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response;
  }
  
  function forgetPass($postData=array()){
	  $this->db->query("SET sql_mode = '' ");
    if(!empty($postData['varData'])){
		$target_ac_id = $this->numOnly($postData['varData']) - 37892;
		
		if($this->checkIDExist($target_ac_id)==1){
			$targetDetails = $this->getNameAndTypeAndStatFromACID($target_ac_id);
			
			$genPass = $this->generate_string('10');
			
			$salt = $this->generate_string(64);
			
			$this->db->set('ac_pass', hash('sha256', $genPass . $salt));
			$this->db->set('ac_pass_salt', $salt);
			$this->db->where('ac_id', $target_ac_id );
			$this->db->update('ac_tbl');
			
			$this->addToACLogs("Sent a forget password for the account of '{$targetDetails['ac_name']}'");
			
			//Send Account Details to Email
			if($this->checkSpam($targetDetails['ac_email']))
				$this->sendMail("Meg and Jane Studio AUTO EMAILING SERVICE",$targetDetails['ac_name'],$targetDetails['ac_email'],"<table> <tbody> <tr> <td >Hi {$targetDetails['ac_name']},</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >The admin requested a change for your password, the following is your newly generated password. </a></td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Password: {$genPass}</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Thanks,</td> </tr> <tr> <td >The Meg & Jane studio account admin.</td> </tr> </tbody> </table>");
				
			return '1';
		}
		else
			return 'Account Does Not Exist';
    }
	return 'Something Went Wrong';
  }
  
  function changeACStat($postData=array()){
	  $this->db->query("SET sql_mode = '' ");
    if(!empty($postData['varData'])){
		$target_ac_id = $this->numOnly($postData['varData']) - 37892;
		
		if($this->checkIDExist($target_ac_id)==1){
			$targetDetails = $this->getNameAndTypeAndStatFromACID($target_ac_id);
			$this->db->set('ac_stat',($targetDetails['ac_stat']=="1" ? "0":"1"));
			$this->db->where('ac_id', $target_ac_id );
			$this->db->update('ac_tbl');
			
			$this->addToACLogs(($targetDetails['ac_stat']=="1" ? "Disabled":"Enabled")." the account of '{$targetDetails['ac_name']}'");
			return '1';
		}
		else
			return 'Account Does Not Exist';
    }
	return 'Something Went Wrong';
  }
  
  function changeACEmail($postData=array()){
	  $this->db->query("SET sql_mode = '' ");
    if(!empty($postData['varData'])&&!empty($postData['email'])){
		$target_ac_id = $this->numOnly($postData['varData']) - 37892;
		
		$email = $this->cleanS($postData['email']);
		if($this->checkIDExist($target_ac_id)==1){
			if($this->checkEmailExist($email,'')=='0'){
				$targetDetails = $this->getNameAndTypeAndStatFromACID($target_ac_id);
				$this->db->set('ac_email',$email);
				$this->db->where('ac_id', $target_ac_id );
				$this->db->update('ac_tbl');
				
				$this->addToACLogs("Changed the account email of '{$targetDetails['ac_name']}'");
				return '1';
			}
			else
				return "Email is Unavailable";
		}
		else
			return 'Account Does Not Exist';
    }
	return 'Something Went Wrong';
  }
  
  function changeACType($postData=array()){
	  $this->db->query("SET sql_mode = '' ");
    if(!empty($postData['varData'])){
		$target_ac_id = $this->numOnly($postData['varData']) - 37892;
		
		if($this->checkIDExist($target_ac_id)==1){
			$targetDetails = $this->getNameAndTypeAndStatFromACID($target_ac_id);
			$this->db->set('ac_type',($targetDetails['ac_type']=="1" ? "2":"1"));
			$this->db->where('ac_id', $target_ac_id );
			$this->db->update('ac_tbl');
			
			$this->addToACLogs(($targetDetails['ac_type']=="1" ? "Demoted":"Promoted")." the account of '{$targetDetails['ac_name']}'");
			return '1';
		}
		else
			return 'Account Does Not Exist';
    }
	return 'Something Went Wrong';
  }
  
  function getNameAndTypeAndStatFromACID($ac_id){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('ac_name,ac_type,ac_stat,ac_email');
    $WhereArray = array('ac_id' => $ac_id);
	$this->db->where($WhereArray); 
	$this->db->from('ac_tbl');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response[0];
  }
  
  function checkIDExist($id){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('count(*)');
    $WhereArray = array('ac_id' => $id);
	$this->db->where($WhereArray); 
	$this->db->from('ac_tbl');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response[0]['count(*)'];
  }
  
  function createAccount($postData=array()){
	  $this->db->query("SET sql_mode = '' ");
    if(!empty($postData['email'])&&!empty($postData['name'])&&!empty($postData['type']) ){
		if($this->checkEmailExist($postData['email'],'')=='0'){
			$genPass = $this->generate_string('10');
			
			$email = $this->cleanS($postData['email']);
			$name = $this->cleanS($postData['name']);
			
			
			$salt = $this->generate_string(64);
			$data = array(
				'ac_type' => $this->cleanS($postData['type']),
				'ac_name' => $name,
				'ac_email' => $email,
				'ac_pass' => hash('sha256', $genPass . $salt) ,
				'ac_pass_salt' => $salt,
				'ac_stat' => '1',
				'ac_2step' => '1',
				'ac_fattempt' => '0',
				'pin' => rand(999999, 111111)
				);
				
			$this->db->insert('ac_tbl', $data);
			//Account Logs
			$this->addToACLogs("Created an account named '{$name}'");
			
			//Send Account Details to Email
			if($this->checkSpam($email))
				$this->sendMail("Meg and Jane Studio AUTO EMAILING SERVICE",$name,$email,"<table> <tbody> <tr> <td >Hi {$name},</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >The following is your account details for the Meg & Jane studio Transaction System. </a></td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Name: {$name}<br>Email: {$email}<br>Password: {$genPass}</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Thanks,</td> </tr> <tr> <td >The Meg & Jane studio account admin.</td> </tr> </tbody> </table>");
				
			return '1';
		}
		else{
			return 'Email Already Exist';
		}
	}
	return 'Something Went Wrong';
  }
  
  
  function addToACLogs($desc= null){
	  $this->db->query("SET sql_mode = '' ");
	  $cDate = date('Y-m-d H:i:s');
	  $id = $this->getIDfromSession()[0]['ac_id'];
	  $data = array(
			'ac_id' => $id,
			'ac_logs_desc' => $desc,
			'ac_logs_date' => $cDate
		);
	  $this->db->insert('ac_logs_tbl', $data);
  }
  
  function checkEmailExist($email= null,$curEmail= null){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('count(*)');
    $WhereArray = array('ac_email' => $email);
	$this->db->where($WhereArray); 
	$this->db->from('ac_tbl');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return ($curEmail==$email? '0': $response[0]['count(*)']);
  }
  
  function getAllTransactLogs(){
	  $this->db->query("SET sql_mode = '' ");
	$this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('sched_id,t1.ac_id,t2.ac_name,trans_id,prev_trans_id,type');
	
	$this->db->from('trans_logs_tbl as t1');
	$this->db->join('ac_tbl as t2', 't2.ac_id = t1.ac_id');
	$this->db->order_by('trans_logs_id','desc');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response;
  }
  
  
  function getTNumFromSchedID($sched_id= null){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('tracking_num');
    $WhereArray = array('sched_id' => $sched_id);
	$this->db->where($WhereArray); 
	$this->db->from('sched_tbl');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response[0]['tracking_num'];
  }
  
  function getNameFromACID($ac_id= null){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('ac_name');
    $WhereArray = array('ac_id' => $ac_id);
	$this->db->where($WhereArray); 
	$this->db->from('ac_tbl');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response[0]['ac_name'];
  }
  
  function cleanseAllTransactLogs(){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $AllTransactLogs = $this->getAllTransactLogs();
	for($i = 0; $i < count($AllTransactLogs); $i++){
		$curT = $this->getTransactDetails($AllTransactLogs[$i]['trans_id']);
		$phase = $curT['trans_stat'];
		$package = $curT['trans_package'];
		$sDate = $curT['trans_date'];
		$addOns =$curT['trans_addons'];
		$toBePaid = $curT['trans_amount'];
		$CurPay = $curT['trans_payed'];
		$editDate = $curT['trans_edit_date'];
		
		if($AllTransactLogs[$i]['prev_trans_id']!=null){
			$prevT = $this->getTransactDetails($AllTransactLogs[$i]['prev_trans_id']);
			if($phase == $prevT['trans_stat']) $phase = "N/C";
			if($package == $prevT['trans_package']) $package = "N/C";
			if($sDate == $prevT['trans_date']) $sDate = "N/C";
			if($addOns == $prevT['trans_addons']) $addOns = "N/C";
			if($toBePaid == $prevT['trans_amount']) $toBePaid = "N/C";
			if($CurPay == '0') $CurPay = "N/C";
		}
		array_push($response,array($this->getTNumFromSchedID($AllTransactLogs[$i]['sched_id']),$this->getNameFromACID($AllTransactLogs[$i]['ac_id']),($AllTransactLogs[$i]['type']==1 ? "Created":"Updated"),$phase,$package,$sDate,$addOns,$toBePaid,$CurPay,$editDate   )    );
	
	}
	
    return $response;
  }
  
  function getTransactDetails($trans_id= null){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('trans_package,trans_addons,trans_date,trans_amount,trans_payed,trans_stat,trans_edit_date');
	$WhereArray = array('trans_id' => $trans_id);
	$this->db->where($WhereArray); 
	$this->db->from('trans_tbl');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response[0];
  }
  
  
  function getAllAccountLogs(){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('t2.ac_name,ac_logs_desc,ac_logs_date');
	
	$this->db->from('ac_logs_tbl as t1');
	$this->db->join('ac_tbl as t2', 't2.ac_id = t1.ac_id');
	$this->db->order_by('ac_logs_id',"desc");
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response;
  }
  
  function getAllAccounts(){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('ac_id,ac_name,ac_email,ac_type,ac_stat');
    $records = $this->db->get('ac_tbl');
	
    $response = $records->result_array();
	
    return $response;
  }
  
  function updateAccountSettings($postData=array()){
	  $this->db->query("SET sql_mode = '' ");
    if(!empty($postData['email'])&&isset($postData['pass']) ){
		if($this->checkEmailExist($postData['email'],$this->getAccountDetailsFromSession()[0]['ac_email'])=='0'&&$this->checkSpam($postData['email'])){
		  $ac_id = $this->getIDfromSession()[0]['ac_id'];
		  
		  
		  
		  if(!empty($postData['pass'])){
			  $salt = $this->generate_string(64);
			  $this->db->set('ac_pass', hash('sha256', $this->cleanS($postData['pass']) . $salt)   );
			  $this->db->set('ac_pass_salt', $salt);
		  }
			
		  $this->db->set('ac_2step', (!empty($postData['2factor']) ? "1":"0"));
		  $this->db->set('ac_email', $this->cleanS($postData['email']));
		  
		  $this->db->where('ac_id', $ac_id);
		  $this->db->update('ac_tbl');
		  return '1';
		}
		else
			return 'Email Already Exist/Invalid Email';
    }
	return 'Something Went Wrong';
  }

  function getAccountDetailsFromSession(){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
	$id = $this->getIDfromSession();
    $this->db->select('ac_name,ac_email,ac_2step');
	$WhereArray = array('ac_id' => $id[0]['ac_id']);
	$this->db->where($WhereArray); 
    $records = $this->db->get('ac_tbl');
	
    $response = $records->result_array();
	
    return $response;
  }
  
  function getScheduledDates(){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('sched_date');
	$WhereArray = array('sched_stat !=' => '4');
	$this->db->where($WhereArray); 
    $records = $this->db->get('sched_tbl');
	
    $response = $records->result_array();
	
    return $response;
  }
  
  function getScheduledDatesWithNames(){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('sched_date,sched_gname,sched_bname,tracking_num,sched_stat');
    $records = $this->db->get('sched_tbl');
	
    $response = $records->result_array();
	
    return $response;
  }
  
  function getDetailsFromTNum($tNum= null){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('*');
	$WhereArray = array('tracking_num' => $this->cleanS($tNum));
	$this->db->where($WhereArray); 
    $records = $this->db->get('sched_tbl');
	
    $response = $records->result_array();
	
    return $response;
  }
  
  function getCol($cNum = null){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
    $this->db->select('tracking_num,sched_gname,sched_bname,sched_package,sched_addons,sched_date,sched_amount,sched_payed,sched_edit_date,t2.ac_name,sched_notes');
	$WhereArray = array('sched_stat' => $cNum);
	$this->db->where($WhereArray); 
	$this->db->from('sched_tbl as t1');
	$this->db->join('ac_tbl as t2', 't2.ac_id = t1.ac_id_lastedit');
	$this->db->order_by('sched_date','DESC');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response;
  }
  
  function getIDfromSession(){
	  $this->db->query("SET sql_mode = '' ");
	$sessionCode = $this->session->userdata('MEGANDJANE_loginSession');
	$response = array();
    if(!empty($sessionCode) ){
      $this->db->select('ac_id');
	  $WhereArray = array('session' => $this->cleanS($sessionCode));
	  $this->db->where($WhereArray); 
      $records = $this->db->get('session_tbl');
      $response = $records->result_array();
 
    }
	
    return $response;
  }
  
  
  function checkLoginSession(){
	  $returnData = $this->checkSession();
		if(count($returnData)<='0')
			return false;
		else if(count($returnData)>='1')
			return true;
  }
  
  function checkSession(){
	  $this->db->query("SET sql_mode = '' ");
	$sessionCode = $this->session->userdata('MEGANDJANE_loginSession');
	$response = array();
    if(isset($sessionCode) ){
      // Select ID and PIN stat
      $this->db->select('t1.ac_id');
	  $WhereArray = array('session' => $this->cleanS($sessionCode),'session_stat' => '1', 't2.ac_stat' => '1', 'session !=' => '0');
	  $this->db->where($WhereArray); 
	  $this->db->from('session_tbl as t1');
	  $this->db->join('ac_tbl as t2', 't2.ac_id = t1.ac_id');
      $records = $this->db->get();
      $response = $records->result_array();
 
    }
	
    return $response;
  }
  
  function getIDfromTnum(){
	  $this->db->query("SET sql_mode = '' ");
	$sessionTNum = $this->session->userdata('MEGANDJANE_edit_tnum');
	$response = array();
    if(!empty($sessionTNum) ){
      // Select ID and PIN stat
      $this->db->select('sched_id');
	  $WhereArray = array('tracking_num' => $this->cleanS($sessionTNum));
	  $this->db->where($WhereArray); 
      $records = $this->db->get('sched_tbl');
      $response = $records->result_array();
 
    }
	
    return $response[0]['sched_id'];
  }
  
  
  
  function getLastTrans($sched_id= null){
	  $this->db->query("SET sql_mode = '' ");
	  $this->db->select('trans_id');
	  $this->db->where('sched_id', $sched_id);
	  $this->db->order_by('trans_id',"desc");
	  $this->db->limit(1);
	  $records = $this->db->get('trans_tbl');
      $response = $records->result_array();
	  
	  return $response[0]['trans_id'];
  }
  
  
  
    function updateEventOnDB($postData=array()){
		$errorList = "";
	  if(empty($postData['gName']))
		$errorList .= "Empty Groom's Name\\\n";
	  if(empty($postData['bName']))
		$errorList .= "Empty Bride's Name\\\n";
	  if(empty($postData['sDate']))
		$errorList .= "Empty Date \\\n";
	  if(empty($postData['package']))
		$errorList .= "No Package Selected \\\n";
	  if(empty($postData['aToPay']))
		$errorList .= "No Payment? \\\n";
		
		$this->db->query("SET sql_mode = '' ");
	  if(!empty($postData['gName'])&&!empty($postData['bName'])&&!empty($postData['sDate'])&&!empty($postData['package'])&&!empty($postData['aToPay'])&&isset($postData['aPayed'])&&isset($postData['cpaid'])&&!empty($postData['phase'])){
		  if($this->numOnly($postData['package'])<=3&& $this->numOnly($postData['package'])>=1){
			  
			  
			  //Get Variable Values
			  $gName = $this->cleanS($postData['gName']);
			  $bName = $this->cleanS($postData['bName']);
			  $package = $this->numOnly($postData['package']);
			  $sDate = $this->cleanS($postData['sDate']);
			  $aToPay = $this->numOnly($postData['aToPay']);
			  $apaid1 = $postData['cpaid'];
			  $paid2 = "0".$this->numOnly($postData['aPayed']);
			  $aPayed = ($aToPay >$apaid1+$paid2 ? $apaid1+$paid2 : $aToPay);
			  $paidAdd = ($aToPay >$apaid1+$paid2 ? $paid2: $apaid1-$aToPay);
			  $cDate = date('Y-m-d H:i:s');
			  $phase = $this->cleanS($postData['phase']);
			  $sched_id = $this->getIDfromTnum();
			  $ac_id_lastedit = $this->getIDfromSession()[0]['ac_id'];
			  $notes = $this->cleanS($postData['Notes']);
			  $cEmail = (empty($this->cleanS($postData['eUpdate'])) ? null:$this->cleanS($postData['eUpdate']));
				$addOns = array();
				if(isset($postData['ao1'])) array_push($addOns,'1');
				if(isset($postData['ao2'])) array_push($addOns,'2');
				if(isset($postData['ao3'])) array_push($addOns,'3');
				if(isset($postData['ao4'])) array_push($addOns,'4');
				if(isset($postData['ao5'])) array_push($addOns,'5');

				if(strtotime($sDate) <= strtotime(date('Y-m-d') . "-2 year"))
					return "Invalid Date";
				
				//Update Variables into the sched table
				$this->db->set('sched_gname', $gName);
				$this->db->set('sched_bname', $bName);
				$this->db->set('sched_package', $package);
				$this->db->set('sched_addons', json_encode($addOns));
				$this->db->set('sched_date', $sDate);
				$this->db->set('sched_amount',  $aToPay);
				$this->db->set('sched_payed', $aPayed);
				$this->db->set('sched_stat', $phase);
				$this->db->set('sched_edit_date', $cDate);
				$this->db->set('cus_email', $cEmail);
				$this->db->set('ac_id_lastedit', $ac_id_lastedit);
				$this->db->set('sched_notes', $notes);
				$this->db->where('sched_id', $sched_id);
				$this->db->update('sched_tbl');
				
				$prev_trans = $this->getLastTrans($sched_id);
				
				$this->db->query("SET sql_mode = '' ");
				//Insert in transaction table for history
				$data = array(
					'sched_id' => $sched_id,
					'ac_id_lastedit' => $ac_id_lastedit,
					'trans_package' => $package,
					'trans_addons' => json_encode($addOns),
					'trans_date' => $sDate,
					'trans_amount' =>  $aToPay,
					'trans_payed' => $paidAdd,
					'trans_stat' => $phase,
					'trans_edit_date' => $cDate
				);
				$this->db->insert('trans_tbl', $data);
				
				
				$c_trans_id = $this->db->insert_id();
				
				//Insert in Transaction Logs
				$this->db->query("SET sql_mode = '' ");
				$data = array(
					'sched_id' => $sched_id,
					'ac_id' => $ac_id_lastedit,
					'trans_id' => $c_trans_id,
					'prev_trans_id' => $prev_trans,
					'type' => '2'
				);
				$this->db->insert('trans_logs_tbl', $data);
				if(!empty($cEmail)&&$this->checkSpam($cEmail))
					$this->sendMail("Meg and Jane Studio AUTO EMAILING SERVICE",$gName." & ".$bName,$cEmail,"<table> <tbody> <tr> <td >Hi {$gName} & {$bName},</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Your Event details had been updated please check the link below for more information. </a></td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >".base_url()."check-tracking?tnum=".$this->session->userdata('MEGANDJANE_edit_tnum')."</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Thanks,</td> </tr> <tr> <td >The Meg & Jane studio account admin.</td> </tr> </tbody> </table>");
				
				
		  }
	  }
	return ($this->db->affected_rows() != 1) ? $errorList : true;
  }
  
  function createEventOnDB($postData=array()){
	  $errorList = "";
	  if(empty($postData['gName']))
		$errorList .= "Empty Groom's Name\\\n ";
	  if(empty($postData['bName']))
		$errorList .= "Empty Bride's Name\\\n ";
	  if(empty($postData['sDate']))
		$errorList .= "Empty Date \\\n ";
	  if(empty($postData['package']))
		$errorList .= "No Package Selected \\\n ";
	  if(empty($postData['aToPay']))
		$errorList .= "No Payment? \\\n";
	  $this->db->query("SET sql_mode = '' ");
	  if(!empty($postData['gName'])&&!empty($postData['bName'])&&!empty($postData['sDate'])&&!empty($postData['package'])&&!empty($postData['aToPay'])&&isset($postData['aPayed'])){
		  if($this->numOnly($postData['package'])<=3&& $this->numOnly($postData['package'])>=1){
			  
			  
			  //Get Variable Values
			  $gName = $this->cleanS($postData['gName']);
			  $bName = $this->cleanS($postData['bName']);
			  $package = $this->numOnly($postData['package']);
			  $sDate = $this->cleanS($postData['sDate']);
			  $aToPay = $this->numOnly($postData['aToPay']);
			  $aPayed =  "0".$this->numOnly($postData['aPayed']);
			  $final_paid = ($aToPay >$aPayed ? $aPayed : $aToPay);
			  $cDate = date('Y-m-d H:i:s');
			  $ac_id_lastedit = $this->getIDfromSession()[0]['ac_id'];
			  $cEmail = (empty($this->cleanS($postData['eUpdate'])) ? null:$this->cleanS($postData['eUpdate']));
			  $notes = $this->cleanS($postData['Notes']);
				$addOns = array();
				if(isset($postData['ao1'])) array_push($addOns,'1');
				if(isset($postData['ao2'])) array_push($addOns,'2');
				if(isset($postData['ao3'])) array_push($addOns,'3');
				if(isset($postData['ao4'])) array_push($addOns,'4');
				if(isset($postData['ao5'])) array_push($addOns,'5');
				
				if(strtotime($sDate) <= strtotime(date('Y-m-d')))
					return "Invalid Date";
				
				//Insert Variables into the sched table
				$data = array(
					'sched_gname' => $gName ,
					'sched_bname' => $bName,
					'sched_package' => $package,
					'sched_addons' => json_encode($addOns),
					'sched_date' => $sDate,
					'sched_amount' =>  $aToPay,
					'sched_payed' => $final_paid,
					'sched_stat' => '1',
					'sched_edit_date' => $cDate,
					'cus_email' => $cEmail,
					'sched_notes' => $notes,
					'ac_id_lastedit' => $ac_id_lastedit
					
				);
				$this->db->insert('sched_tbl', $data);
				
				
				
				$trans_id = $this->db->insert_id();
				
				//Add the tracking number per schedule
				$tnum = 'MAJS'.($trans_id + 1028132);
				$this->db->query("SET sql_mode = '' ");
				$this->db->set('tracking_num', $tnum);
				$this->db->where('sched_id', $trans_id);
				$this->db->update('sched_tbl');
				
				
				//Insert in transaction table for history
				$this->db->query("SET sql_mode = '' ");
				$data = array(
					'sched_id' => $trans_id,
					'ac_id_lastedit' => $ac_id_lastedit,
					'trans_package' => $package,
					'trans_addons' => json_encode($addOns),
					'trans_date' => $sDate,
					'trans_amount' =>  $aToPay,
					'trans_payed' => $final_paid,
					'trans_stat' => '1',
					'trans_edit_date' => $cDate
				);
				$this->db->insert('trans_tbl', $data);
				
				$c_trans_id = $this->db->insert_id();
				
				//Insert in Transaction Logs
				$this->db->query("SET sql_mode = '' ");
				$data = array(
					'sched_id' => $trans_id,
					'ac_id' => $ac_id_lastedit,
					'trans_id' => $c_trans_id,
					'prev_trans_id' => null,
					'type' => '1'
				);
				$this->db->insert('trans_logs_tbl', $data);
				
				if(!empty($cEmail)&&$this->checkSpam($cEmail))
					$this->sendMail("Meg and Jane Studio AUTO EMAILING SERVICE",$gName." & ".$bName,$cEmail,"<table> <tbody> <tr> <td >Hi {$gName} & {$bName},</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Your Event schedule have been created please check the link below for more information. </a></td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >".base_url()."check-tracking?tnum=".$tnum."</td> </tr> <tr> <td >&nbsp;</td> </tr> <tr> <td >Thanks,</td> </tr> <tr> <td >The Meg & Jane studio account admin.</td> </tr> </tbody> </table>");
				
		  }
	  }
	return ($this->db->affected_rows() != 1) ? $errorList : true;
  }
  
  function checkPIN($PIN){

    // get data 
    $data = $this->getAccountDetailsFromPIN($PIN);
	if(count($data)<='0'){
		echo "Incorrect PIN";
	}
	else if(count($data)>='1'){
		
		$this->changeFailedAttemptReset($data[0]['ac_id']);
		$this->loginAccountSession($data[0]['ac_id']);
		
		echo "1";
	}
  }
  
  function checkAccount($email,$pass){

    // get data 
    $data = $this->getAccountDetailsFromEmailandPass2($email,$pass);
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
				$this->changeUserPin($data[0]['ac_id'],$randPin);
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
  
  function loginAccountSession($id){
	  $user_agent = $_SERVER['HTTP_USER_AGENT'];
	  $ip = $_SERVER['REMOTE_ADDR'];
	  $loginSession = $this->generate_string(200);
	  $this->addAccountSession($id,$loginSession,$user_agent,$ip);
	  $this->session->set_userdata('MEGANDJANE_loginSession', $loginSession);
  }
  
  function getAccountDetailsFromEmailandPass2($email,$pass){
	$this->db->query("SET sql_mode = '' ");
    $response = array();
	$email = $this->cleanS($email);
	$emailInfo = $this->checkIfEmailExistGetSaltAndAttempts($email);
    if(!empty($email)&&!empty($pass)&&count($emailInfo)>=1){
		
		  $salt = $emailInfo[0]['ac_pass_salt'];
		  // Select ID and PIN stat
		  $this->db->select('ac_id,ac_2step,ac_stat,ac_name,ac_email,pin');
		  $WhereArray = array('ac_email' => $email, 'ac_pass' => hash('sha256', $this->cleanS($pass) . $salt)    );
		  $this->db->where($WhereArray); 
		  $records = $this->db->get('ac_tbl');
		  $response = $records->result_array();
		
		if(count($response)<1){
			$this->addToAccountFailedAttempts($email);
			
			if($emailInfo[0]['ac_fattempt']>='4'){
				$this->sendMessageAccound($emailInfo[0]['a'], "The System has detected a suspicious activity with your account, the 2 Factor Authentication is then automatically activated. <br><br>If its not you, please change your password.");
				$this->activate2FactorAuthentication($email);
				$response['failed_attempts'] = "";
			}
		}
    }
    return $response;
  }
  
  
  function getAccountDetailsFromEmailandPass($postData=array()){
	$this->db->query("SET sql_mode = '' ");
    $response = array();
	$email = $this->cleanS($postData['email']);
	$emailInfo = $this->checkIfEmailExistGetSaltAndAttempts($email);
    if(!empty($email)&&!empty($postData['pass'])&&count($emailInfo)>=1){
		
		  $salt = $emailInfo[0]['ac_pass_salt'];
		  // Select ID and PIN stat
		  $this->db->select('ac_id,ac_2step,ac_stat,ac_name,ac_email,pin');
		  $WhereArray = array('ac_email' => $email, 'ac_pass' => hash('sha256', $this->cleanS($postData['pass']) . $salt)    );
		  $this->db->where($WhereArray); 
		  $records = $this->db->get('ac_tbl');
		  $response = $records->result_array();
		
		if(count($response)<1){
			$this->addToAccountFailedAttempts($email);
			
			if($emailInfo[0]['ac_fattempt']>='4'){
				$this->sendMessageAccound($emailInfo[0]['a'], "The System has detected a suspicious activity with your account, the 2 Factor Authentication is then automatically activated. <br><br>If its not you, please change your password.");
				$this->activate2FactorAuthentication($email);
				$response['failed_attempts'] = "";
			}
		}
    }
    return $response;
  }
  
  function changeFailedAttemptReset($id= null){
	$this->db->query("SET sql_mode = '' ");
	  $this->db->set('ac_fattempt', '0');
	  $this->db->where('ac_id', $id);
	  $this->db->update('ac_tbl');
  }
	
	function sendMessageAccound($id, $text){
		$this->db->query("SET sql_mode = '' ");
		$cDate = date('Y-m-d H:i:s');
		$data = array(
			'ac_id' => $id,
			'inbox_message' => $text,
			'inbox_date' => $cDate,
			'inbox_stat' => '1'
		);

		$this->db->insert('inbox_tbl', $data);
	}
  
	function activate2FactorAuthentication($email = null){
		$this->db->query("SET sql_mode = '' ");
		  $this->db->set('ac_2step', '1');
		  $this->db->where('ac_email', $email);
		  $this->db->update('ac_tbl');
	  }
  
  function addToAccountFailedAttempts($email = null){
	$this->db->query("SET sql_mode = '' ");
	  $this->db->set('ac_fattempt', 'ac_fattempt+1',FALSE);
	  $this->db->where('ac_email', $email);
	  $this->db->update('ac_tbl');
  }
  
  
  
  
  function checkIfEmailExistGetSaltAndAttempts($email){
	  $this->db->query("SET sql_mode = '' ");
    $response = array();
    if(!empty($email)){
      // Select Password Salt
      $this->db->select('ac_id AS a,ac_pass_salt,ac_fattempt');
	  $WhereArray = array('ac_email' => $this->cleanS($email));
	  $this->db->where($WhereArray); 
      $records = $this->db->get('ac_tbl');
      $response = $records->result_array();
    }
	
    return $response;
  }
  
  function getAccountDetailsFromPIN($PIN){
	$this->db->query("SET sql_mode = '' ");
    $response = array();
    if(!empty($PIN)){
      // Select ID and PIN stat
      $this->db->select('ac_id,ac_name');
	  $WhereArray = array('ac_name' => $this->cleanS($this->session->userdata('MEGANDJANE_accountname')), 'pin' => $this->cleanS($PIN));
	  $this->db->where($WhereArray); 
      $records = $this->db->get('ac_tbl');
      $response = $records->result_array();
 
    }
	
    return $response;
  }
  
  function addAccountSession($id= null,$sessionCode= null,$user_agent= null,$ip= null){
	$this->db->query("SET sql_mode = '' ");
	if(!empty($id)&&!empty($sessionCode)&&!empty($user_agent)&&!empty($ip) ){
		$data = array(
			'ac_id' => $this->cleanS($id),
			'dev_details' => $this->cleanS($user_agent),
			'dev_ip' => $this->cleanS($ip),
			'session' => $this->cleanS($sessionCode),
			'date' => date('Y-m-d H:i:s'),
			'session_stat' => '1'
		);

		$this->db->insert('session_tbl', $data);
	}
  }
  
  function changeUserPin($id= null,$newPIN=null){
	$this->db->query("SET sql_mode = '' ");
	  
	  $this->db->set('pin', $newPIN);
	  $this->db->where('ac_id', $id);
	  $this->db->update('ac_tbl');
  }
  
  function sendMail($fromName= null,$toName= null,$toEmail= null,$content= null){
	  
		if(!empty($fromName)&&!empty($toName)&&!empty($toEmail)&&!empty($content)){
			
			
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
  
  function generate_string($strength = null) {
	$this->db->query("SET sql_mode = '' ");
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$permitted_chars_length = strlen($permitted_chars);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $permitted_chars[mt_rand(0, $permitted_chars_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}
	
	function checkSpam($email)
    {
        $this->load->library('genuinemail');
        $check = $this->genuinemail->check($email);
        if($check===TRUE) return true;
        return false;

    }
  
  
  
  
  

}
?>