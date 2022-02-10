<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller{
	public function __construct(){
		parent::__construct();

		// Load Model
		$this->load->model('Main_model');
		$this->load->model('Autorun_model');

		// Load base_url
		$this->load->helper('url');
		
		$this->load->helper('device_helper');
	}
	
  
	function view($page = 'home')
	{
		/*
			
		else if("https://$_SERVER[HTTP_HOST]"=="https://megandjanetransactions.000webhostapp.com"){
			header("Location: https://www.megandjane-admin.ml/c/");
			
		}
		
		*/
		$data["mobile"] = checkCMobileApp($_SERVER['HTTP_USER_AGENT']);
		
		if($page == 'autorun_meg_jane_studio'){
			$this->Autorun_model->autorun();
		} 
		else if($page == 'notif'){
			if($this->Main_model->checkLoginSession()){
				echo ($this->Main_model->getNotif()!="0" ? $this->Main_model->getNotif() : "");
				$this->Main_model->setSentNotif();
			}
		}
		else if($page == 'androidapp'){
			if(isset($_GET['pass'])&&isset($_GET['email'])){
				
				$this->Main_model->checkAccount($_GET['email'],$_GET['pass']);
			}
			else if(isset($_GET['pin'])){
				
				$this->Main_model->checkPIN($_GET['pin']);
			}
			else if(isset($_GET['login'])){
				if($this->Main_model->checkLoginSession())
					echo "1";
				else
					echo "0";
			}
			else if(isset($_GET['notif'])){
				if($this->Main_model->checkLoginSession()){
					echo ($this->Main_model->getNotif()!="0" ? $this->Main_model->getNotif() : "");
					$this->Main_model->setSentNotif();
				}
			}
			else if(isset($_GET['rank'])){
				if($this->Main_model->checkLoginSession())
					echo $this->Main_model->getAccountRank();
			}
			
		}
		else if( !file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}
		else if($page=="check-tracking")
			$this->load->view('pages/'.$page);
		else{
			
			$data['loginSession'] = $this->Main_model->checkLoginSession();
			$data['page'] = $page;
			
			if($data['loginSession']){
				if($page == "transactions-table"){
					$data['dataAr'] = array($this->Main_model->getCol(1),$this->Main_model->getCol(2),$this->Main_model->getCol(3),$this->Main_model->getCol(4));
				}
				else if($page == "transaction-create"){
					$data['sched_dates'] = $this->Main_model->getScheduledDates();
				}
				else if($page == "calendar"){
					$data['sched_dates_WNAME'] = $this->Main_model->getScheduledDatesWithNames();
				}
				else if($page == "user-profile"){
					$data['ac_sessions'] = $this->Main_model->getAccountSessionTableDetails();
					$data['ac_details'] = $this->Main_model->getAccountDetailsFromSession();
				}
				else if($page == "accounts-management"){
					$data['id_ignore'] = $this->Main_model->getIDfromSession()[0]['ac_id'];
					$data['all_ac_details'] = $this->Main_model->getAllAccounts();
				}
				else if($page == "accounts-logs")
					$data['all_ac_logs'] = $this->Main_model->getAllAccountLogs();
				else if($page == "transaction-logs")
					$data['all_trans_logs'] = $this->Main_model->cleanseAllTransactLogs();
				else if($page == "transaction-edit"){
					$data['sched_details'] = $this->Main_model->getDetailsFromTNum($this->session->userdata('MEGANDJANE_edit_tnum'));
					$data['sched_dates'] = $this->Main_model->getScheduledDates();
				}
				else if($page == "home" || empty($page)){
					$data['salesDetails'] = $this->Main_model->getWeeklyMontlyYearlySales();
					$data['statMDetails'] = $this->Main_model->getMontlyStat();
					$data['statCount'] = $this->Main_model->getStatCount();
					$data['accountActCount'] = $this->Main_model->getActiveAccountCount();
				}
				else if($page == "user-inbox")
					$data['userInbox'] = $this->Main_model->getUserInbox();
				
				$data['rank'] = $this->Main_model->getAccountRank();
				$data['notif'] = $this->Main_model->getAccountMessageCount();
				
				$this->load->view('pages/'.$page, $data);
			}
			else{
				if($page=="login-account"||$page=="login-account-2step")
					$this->load->view('pages/'.$page, $data);
				else
					$this->load->view('pages/login-account', $data);
			}
		}
		
	}
	
}


?>