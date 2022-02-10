<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autorun_model extends CI_Model {
  
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
  
  function autorun(){
	  $cDate = date('Y-m-d H:i:s');
	  $list = $this->getEventPendingEditDetails($cDate);
	  for($i = 0; $i < count($list); $i++){
			$this->db->query("SET sql_mode = '' ");
			$data = array(
				'ac_id' => $list[$i]['ac_id'],
				'inbox_message' => "Hi {$list[$i]['ac_name']}!<br><br>
									Event #{$list[$i]['tracking_num']}<br>
									for {$list[$i]['sched_gname']} and {$list[$i]['sched_bname']}<br>
									is scheduled tommorow<br><br>
									From Meg & Jane Studio,<br>Automated System Message.",
				'ac_id' => $list[$i]['ac_id'],
				'inbox_date' => $cDate,
				'inbox_stat' => '1',
				'inbox_notif' => null
			);
			$this->db->insert('inbox_tbl', $data);
			$this->sendMail("Meg and Jane Studio AUTO EMAILING SERVICE",$list[$i]['ac_name'],$list[$i]['ac_email'],"Hi {$list[$i]['ac_name']}!<br><br> Event #{$list[$i]['tracking_num']}<br> for {$list[$i]['sched_gname']} and {$list[$i]['sched_bname']}<br> is scheduled tommorow<br><br> From Meg & Jane Studio,<br>Automated System Message.");
			
	  }
	 $this->expirationSession($cDate);
	  
	  
  }
  
  function expirationSession($cDate){
	  $this->db->query("SET sql_mode = '' ");
	$this->db->set('session', '0');
	$this->db->set('session_stat', '0');
	$WhereArray = array('session !=' => '0', 'date <=', date('Y-m-d', strtotime($cDate. ' - 15 day')));
	$this->db->where($WhereArray);
	$this->db->update('session_tbl');
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
  
  function getEventPendingEditDetails($cDate){
	  $this->db->query("SET sql_mode = '' ");
	$response = array();
	
	
	
	$this->db->select('tracking_num,sched_gname,sched_bname,t2.ac_name,t2.ac_id,t2.ac_email');
	
	$this->db->where('(sched_stat=1 OR sched_stat=2) AND sched_date ="'.date('Y-m-d', strtotime($cDate. ' + 1 day')).'"'   ); 
	$this->db->from('sched_tbl as t1');
	$this->db->join('ac_tbl as t2', 't2.ac_id = t1.ac_id_lastedit');
    $records = $this->db->get();
	
    $response = $records->result_array();
	
    return $response;
  }
  
  
  
  
  
  

}
?>