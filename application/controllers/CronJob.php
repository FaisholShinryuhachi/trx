<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(0);

ini_set('display_errors', 0);





class CronJob extends MY_Controller{

	

	function __construct(){

		parent::__construct();	

		___construct(1);	

	}



	public function transaction(){

		echo date("Y-m-d H:i:s")."<br>";

		$this->load->model('Wallet_model');

		$result = $this->Wallet_model->CronTransaction();



		$cur = date("Y-m-d H:i:s");

		$this->db->query("UPDATE wallet_recursion SET status=0 WHERE status=1 AND endtime <= '{$cur}' AND endtime IS NOT NULL");			

		

		if($result){

			echo "Success";

		}else{

			echo "No Records";

		}



	}

	public function expire_package_notification(){
		echo date("Y-m-d H:i:s")."<br>";
		$this->load->model('Product_model');
		$this->load->model('Mail_model');
		$MembershipSetting =$this->Product_model->getSettings('membership');

		$today = date('Y-m-d');
		$notificationbefore = (int)$MembershipSetting['notificationbefore'];
		$days_after = strtotime("+".$notificationbefore." day");
		$expire_at = date("Y-m-d", $days_after);

		$results = $this->db->query("SELECT * FROM membership_user WHERE is_active = 1 AND expire_mail_sent = 0 AND expire_at = '".$expire_at."'")->result_array();
		foreach ($results as $key => $result) {
			$this->Mail_model->send_subscription_expire_notification($result['id'], $result['plan_id']);
		}

		if($results){
			echo "Success";
		}else{
			echo "No Records";
		}
	}

}