<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);

use App\MembershipPlan;
use App\MembershipUser;
class Membership extends MY_Controller {
	function __construct() {
		parent::__construct();
		___construct(1);
		$this->load->model('Product_model');
		$this->load->model('membership_model');
		$this->Product_model->ping($this->session->userdata('administrator')['id']);
	}

	public function user_plan_modal(){
		$data = [];
		$this->checkLogin('admin');
		$user_id = $this->input->get("user_id");

		$data['MembershipSetting'] =$this->Product_model->getSettings('membership');
	


		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$post = $this->input->post(null,true);
			$json = array();

			$json = [];
			$this->form_validation->set_rules('user_id', 'User', 'required|trim');
			$this->form_validation->set_rules('new_planid', 'Plan', 'required|trim');
			$this->form_validation->set_rules('status_id', 'Status', 'required|trim');
			$this->form_validation->set_rules('comment', 'Comment', 'required|trim');
		

			if ($this->form_validation->run() == FALSE) {
				$json['errors'] = $this->form_validation->error_array();
			}

			if (!isset($json['errors'])) {
				$user = App\User::find($post['user_id']);
				$plan = MembershipPlan::find($post['new_planid']);

				$membership = $plan->buy($user,$post['status_id'], $post['comment'],'Free by Admin',0);
				$json['reload']=1;
				$this->session_message("Success: {$plan->name} assign to {$user->firstname} {$user->lastname}");
			}

			$this->json($json);die;
		}

		$user = App\User::find($user_id);
	    if((int)$user->plan_id == 0){ }
	    else if($user->plan_id == -1){
	    	$data['is_lifetime_plan'] = 1;
	    } else if ($user) {
	      $plan = $user->plan();
	      if($plan){
	       	$data['plan']  = $plan;
	      }
	    }

	    $data['user'] = $user;
	    $data['plan_lists'] = MembershipPlan::get();

		$this->load->view('admincontrol/membership/user_plan_modal',$data);
	}

	public function plan_edit($plan_id = 0){
		$data = [];
		$this->checkLogin('admin');
		$data['CurrencySymbol'] = $this->currency->getSymbol();
		$data['plan'] = MembershipPlan::findOrNew((int)$plan_id);
		$this->view($data,'membership/plan_edit');
	}

	public function plan_create($plan_id = 0){
		$data = [];
		$this->checkLogin('admin');
		$data['CurrencySymbol'] = $this->currency->getSymbol();
		$this->view($data,'membership/plan_create');
	}

	public function odrer_plan_delete($plan_id = 0){
		$data = [];
		$this->checkLogin('admin');
		$plan = MembershipUser::find((int)$plan_id);
		if($plan && $plan->is_active == 0){
			App\MembershipHistory::where('buy_id', $plan_id)->delete();
			$plan->delete();
			$this->session_message("Success: Membership Order Deleted Successfully");
		}

		redirect('membership/membership_orders');
	}

	public function odrer_plan_delete_multiple(){
		$data = [];
		$this->checkLogin('admin');
		$post = $this->input->post(null,true);

		if (isset($post['delete'])) {
			foreach ($post['delete'] as $key => $plan_id) {
				$plan = MembershipUser::find((int)$plan_id);
				if($plan && $plan->is_active == 0){
					App\MembershipHistory::where('buy_id', $plan_id)->delete();
					$plan->delete();
				}
			}
		}
	

		$this->session_message("Success: Membership Order Deleted Successfully");
		redirect('membership/membership_orders');
	}

	public function plan_delete($plan_id = 0){
		$data = [];
		$this->checkLogin('admin');

		$plan = MembershipPlan::findOrNew((int)$plan_id);

		$activeUser = MembershipUser::where('is_active',1)->where("plan_id",$plan->id)->count();
		if($activeUser > 0){
			$this->session_message("Warning: This plan cannot be deleted as it is currently assigned to {$activeUser} users!",'error');
		} else{
			$plan->delete();
			$this->session_message("Plan deleted successfully..");
		}

		redirect('membership/plans');
	}

	public function plans($page=1){
		$data = [];
		$this->checkLogin('admin');
		$page = max((int)$page,1);

		\Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
	        return $page;
	    });
	

		$limit = 10;
		$query = MembershipPlan::paginate($limit);
		$data['links'] = $this->build_paginate($query, 'membership/plans',$page, $limit);

		$data['plans'] = $query;

		$this->view($data,'membership/plans');
	}

	public function settings($plan_id = 0){
		$this->checkLogin('admin');

		$post = $this->input->post(null,true);
		if(!empty($post)){
			$json = array();

			if(!isset($json['errors'])){
				if(count($_FILES) > 0){
					$path = 'assets/images/site';
					$this->load->helper('string');
					$config['upload_path'] = $path;
					$config['allowed_types'] = '*';
					$config['file_name']  = random_string('alnum', 32);
					$this->load->library('upload', $config);
					 
					foreach ($_FILES as $fieldname => $input) {
						$this->upload->initialize($config);
						list($key,$subkey) = explode("_", $fieldname);
						$extension = pathinfo($_FILES[$fieldname]["name"], PATHINFO_EXTENSION);

						if($input['error'] == 0){
							if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif'){
								if (!$this->upload->do_upload($fieldname)) {
								

								}
								else {
									$upload_details = $this->upload->data();
									$post[$key][$subkey] = $upload_details['file_name'];
								}
							} else{
								$json['errors']["{$key}_{$subkey}"] = 'Only Image File are allowed';
							}
						}
					}
				}

				$commonSetting = ['membership'];
				foreach ($post as $key => $value) {
					if (in_array($key, $commonSetting)) {
						$this->Setting_model->save($key, $value);
					}
				}

				if(!isset($json['errors'])){

					$json['success'] =  __('admin.setting_saved_successfully');
				}
			}
	

			$this->json($json);die;
		}

		$data['membership'] = $this->Product_model->getSettings('membership');
		$data['plans'] = MembershipPlan::get();

		$this->view($data,'membership/settings');
	}

	public function submit_plan_form($plan_id = 0){
		$data = $this->post_data();
		$this->checkLogin('admin');
		$json = [];

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('type', 'Type', 'required|trim');
		$this->form_validation->set_rules('status', 'Plan Status', 'required|trim');
		//$this->form_validation->set_rules('bonus', 'Bonus', 'required|trim');
		$this->form_validation->set_rules('billing_period', 'Billing Period', 'required|trim');
		if (isset($data['type']) && $data['type'] =='paid') {
			$this->form_validation->set_rules('price', 'Price', 'required|trim');
			$this->form_validation->set_rules('have_trail', 'Free Trail', 'required|trim');
		}
		if (isset($data['billing_period']) && $data['billing_period'] =='custom') {
			$this->form_validation->set_rules('custom_period', 'Custom Period', 'required|trim|greater_than[0]');
		}
		if (isset($data['have_trail']) && $data['have_trail'] =='1') {
			$this->form_validation->set_rules('free_trail', 'Free Trail Day', 'required|trim');
		}
	

		if ($this->form_validation->run() == FALSE) {
			$json['errors'] = $this->form_validation->error_array();
		}


		if (!isset($json['errors'])) {
			$plan = MembershipPlan::findOrNew((int)$data['id']);
			$plan->name = $data['name'];
			$plan->type = $data['type'];
			$plan->billing_period = $data['billing_period'];
			$plan->description = $data['description'];
		
			$plan->label_text = $data['label_text'];
		
			$plan->label_background = $data['label_background'];
		
			$plan->label_color = $data['label_color'];
			$plan->price = (float)$data['price'];
		
			$plan->special = (float)$data['special'];
			$plan->bonus = (float)$data['bonus'];
			$plan->custom_period = (int)$data['custom_period'];
			$plan->status = (int)$data['status'];
			$plan->have_trail = (int)$data['have_trail'];
			$plan->free_trail = (int)$data['free_trail'];

			if($plan->billing_period == 'daily'){
				$plan->total_day = 1;
			}
			else if($plan->billing_period == 'weekly'){
				$plan->total_day = 7;
			}
			else if($plan->billing_period == 'monthly'){
				$plan->total_day = 30;
			}
			else if($plan->billing_period == 'yearly'){
				$plan->total_day = 365;
			}
			else if($plan->billing_period == 'custom'){
				$plan->total_day = $plan->custom_period;
			}
			$plan->sort_order = (int)$data['sort_order'];

			if($plan->created_at == ''){
				$plan->created_at = date("Y-m-d H:i:s");
			}
			$plan->updated_at = date("Y-m-d H:i:s");
		


			$plan->save();
			$this->session_message("Plan saved successfully..");

			if ((int)$this->input->get('close') == 1) {
				$json['location'] = base_url('membership/plans');
			} else {
				$json['location'] = base_url('membership/plan_edit/'. $plan->id);
			}
		}

		$this->json($json);
	}

	public function submit_plan_update($plan_id = 0){
		$data = $this->post_data();
		$this->checkLogin('admin');
		$json = [];

		$this->form_validation->set_rules('expire_at', 'Expire date', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$json['errors'] = $this->form_validation->error_array();
		}


		if (!isset($json['errors'])) {
			$plan = MembershipUser::find((int)$plan_id);
			$plan->expire_at = date("Y-m-d", strtotime($data['expire_at']));
			$plan->save();
			$this->session_message("Plan updated successfully..");

			if ((int)$this->input->get('close') == 1) {
				$json['location'] = base_url('membership/plans');
			} else {
				$json['location'] = base_url('membership/membership_purchase_edit/'. $plan->id);
			}
		}

		$this->json($json);
	}

	public function membership_payment_gateways_doc(){
		set_default_currency();
		$data = [];

		$this->view($data,'membership/doc');
	}

	public function membership_payment_gateways(){
    	set_default_currency();
		$this->checkLogin('admin');
	

		$data['payment_methods'] = MembershipPlan::getPaymentMethods();
		$this->view($data,'membership/index');
	}

	public function membership_payment_gateways_status_change($code){
		set_default_currency();
		$this->checkLogin('admin');
		MembershipPlan::changeInstallUninstall($code);

		redirect(base_url('membership/membership_payment_gateways'));
	}

	public function membership_payment_gateways_edit($code){
		set_default_currency();
		$this->checkLogin('admin');

		$data['details'] = MembershipPlan::getDetails($code);
		if(!$data['details']){ redirect('membership/membership_payment_gateways', 'refresh'); }

		list($html,$setting) = MembershipPlan::getEditPage($code);
		$data['html'] = $html;
		$data = array_merge($data, $setting);

		$this->view($data,'membership/membership_payment_settings');
	}

	public function membership_payment_gateways_setting_save($code){
		$post = $this->input->post(null,true);
		$this->Setting_model->save('membershippayment_'.$code, $post);

		$json['redirect'] = base_url('membership/membership_payment_gateways');
		$this->session->set_flashdata('success', 'Settings Saved Successfully');
		echo json_encode($json);
	}

	public function buy_membership($plan_id, $code){
		if($this->Product_model->isMembershipAccess()){
			$user = $this->checkLogin('user');
			$pmethod = MembershipPlan::getDetails($code);
			$plan = MembershipPlan::find($plan_id);

			$pmethod['plan'] = $plan;
			if ($pmethod && $plan) {
				$data = ['notcheckmember'=>1];
				$data['pmethod'] = $pmethod;
				$data['confirm'] = MembershipPlan::getConfirm($code,$pmethod);
				$data['plan'] = $plan;

				$this->view($data,'membership/buy_plan','usercontrol');
			} else {
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function delete_plugin($code){
		$filename = APPPATH."/membership_payment/controllers/{$code}.php";
		if(is_file($filename)){
			$files= [
				APPPATH."membership_payment/admin_settings/{$code}.php",
				APPPATH."membership_payment/confirm_view/{$code}.php",
				APPPATH."membership_payment/controllers/{$code}.php",
				APPPATH."membership_payment/user_settings/{$code}.php",
				APPPATH."membership_payment/logo/{$code}.png",
			];

			foreach ($files as $key => $file) {
				if (is_file($file)) {
					unlink($file);
				}
			}
		}

		$this->session->set_flashdata('success', 'Module deleted successfully');
		$this->load->model('Setting_model');
		$this->Setting_model->clear('membershippayment_'.$code);
		redirect('membership/membership_payment_gateways');
	}

	public function installPayementGateway(){
		$tmp_path = APPPATH.'cache/tmp/';
		$foldername = 'payout';
		$upload_path = APPPATH.'cache/tmp/'.$foldername."/";

		if(!is_dir($tmp_path)){
			if (!mkdir($tmp_path, 0777)) {
				$json['warning'] = "Can't create folder";
				$this->json($json);die;
			}
		}

		if(!$_FILES['plugin'] || !isset($_FILES['plugin']['name']) || !isset($_FILES['plugin']['tmp_name'])){
			$json['warning'] = "Choose zip file to install";
			$this->json($json);die;
		}
		 
		if (strtolower(substr(strrchr($_FILES['plugin']['name'], '.'), 1)) != 'zip') {
			$json['warning'] = "Allow only zip file..";
			$this->json($json);die;
		}

		$zip = new ZipArchive();
		if ($zip->open($_FILES["plugin"]["tmp_name"])) {
			$zip->extractTo($upload_path);
			$zip->close();
		} else {
			$json['warning'] = "Can't extract zip file";
			$this->json($json);die;
		}

		if (is_dir($upload_path . 'upload/')) {
			$files = array();
			$path = $upload_path . 'upload/*';
			foreach ((array)glob($path) as $file) {
				if (is_dir($file)) {
					$files[] = $file;
				}
			}

			$allowed = array(
				'admin_settings',
				'confirm_view',
				'controllers',
				'logo',
				'user_settings',
			);

			$safe = true;
			$destination = '';
			foreach ($files as $file) {
				$destination = str_replace('\\', '/', substr($file, strlen($upload_path . 'upload/')));
				if(!in_array($destination, $allowed)){
					$safe = false;
					break;
				}
			}

			if (!$safe) {
				$json['warning'] = 'This folder is not allowed '. $destination;
				$this->json($json);die;
			}


			$files = array();
			$path = array($upload_path . 'upload/*');
			while (count($path) != 0) {
				$next = array_shift($path);
				foreach ((array)glob($next) as $file) {
					if (is_dir($file)) {
						$path[] = $file . '/*';
					}
					$files[] = $file;
				}
			}

			foreach ($files as $key => $file) {
				$destination = str_replace('\\', '/', substr($file, strlen($upload_path . 'upload/')));
				$path = APPPATH . 'membership_payment/'. $destination;

				if (is_dir($file) && !is_dir($path)) {
					mkdir($path, 0777);
				}

				if (is_file($file)) {
					rename($file, $path);
				}
			}

			deleteDir($upload_path);
			$json['location'] = 1;
			$this->session->set_flashdata('success', 'Module installed successfully');
		} else {
			$json['warning'] = "Not dir ". $upload_path . 'upload/';
		}
	

		$this->json($json);die;
	}

	public function call_payment_function($code,  $fun, $plan_id, $argument = '', $argument2 = ''){
		if(is_file(APPPATH."/membership_payment/controllers/". $code .".php")){
			require APPPATH."/membership_payment/controllers/". $code .".php";
			$obj = new $code($this);
			$obj->$fun($plan_id, $argument ,$argument2);
		}
	}

	public function membership_purchase_edit($plan_id){
		$this->checkLogin('admin');
		$query = App\MembershipUser::find($plan_id);

		if($query){
			if (isset($_GET['addhistory'])) {
				$json = [];
				$data = $this->post_data();
				$this->form_validation->set_rules('status_id', 'Status', 'required|trim');
				$this->form_validation->set_rules('comment', 'Comment', 'required|trim');

				if ($this->form_validation->run() == FALSE) {
					$json['errors'] = $this->form_validation->error_array();
				}

				if (!isset($json['errors'])) {
					
					$planPurchasedBefore = $this->membership_model->is_plan_activated_before($query->id);				

					$history = new App\MembershipHistory();
					$history->buy_id = $query->id;
					$history->status_id = $data['status_id'];
					$history->comment = $data['comment'];
					$history->created_at = date("Y-m-d H:i:s");
					$history->save();

					if($planPurchasedBefore == 0 && $data['status_id'] == 1) {
						$query->expire_at = ($query->billing_period == 'lifetime_free') ? null : date("Y-m-d H:i:s",strtotime('+ '. $query->total_day .' days'));
						$query->started_at = date("Y-m-d H:i:s");
					}

					$query->status_id = $history->status_id;
					$query->save();

					$this->load->model('Mail_model');
					$this->Mail_model->send_subscription_status_change($plan_id, $history->comment);

					$json['reload'] = 1;
					$this->session_message('History added successfully');
				}
			

				$this->json($json);die;
			}

			$data['history'] = $query->status_history();
			$data['plan'] = $query;
			$this->view($data,"membership/purchase_edit");
		} else {
			show_404();
		}
	}

	public function membership_orders($page = 1){
		$user = $this->checkLogin('admin');
		$filter = $this->input->get(null,true);

		$page = max((int)$page,1);
		\Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
	        return $page;
	    });

		$limit = 10;
		$query = App\MembershipUser::with(["plan","user"])->orderBy("id","DESC");

		if (isset($filter['user_id']) && $filter['user_id'] != '') {
			$query->where('user_id', (int)$filter['user_id']);
			$data['user_id'] = (int)$filter['user_id'];
		}

		if (isset($filter['status_id']) && $filter['status_id'] != '') {
			$query->where('status_id', (int)$filter['status_id']);
		}

		if (isset($filter['date'])) {
			if (strpos($filter['date'], ' - ') !== false) {
				list($start_date, $end_date) = explode(" - ", $filter['date']);

				$start_date = date("Y-m-d", strtotime($start_date));
				$end_date = date("Y-m-d", strtotime($end_date));

				$query->whereRaw('DATE(created_at) >= "'. $start_date .'"');
				$query->whereRaw('DATE(created_at) <= "'. $end_date .'"');
			}
		}

		$query = $query->paginate($limit);
		$data['users'] = $this->db->query("SELECT id,CONCAT(firstname,' ',lastname) as name FROM users WHERE type='user'")->result_array();

		$data['links'] = $this->build_paginate($query, 'membership/membership_orders',$page, $limit);
		$data['plans'] = $query;

		$year_ago = date('Y-01-01');
		$month_ago = date('Y-m-d', strtotime('-1 month'));
		$week_ago = date('Y-m-d', strtotime('-7 days'));
	
		$data['dashboard_totals'] = $this->db->query("SELECT 
			(SELECT SUM(total) as total FROM membership_user WHERE created_at >= '".$year_ago."' AND status_id = 1) as year_ago_total_order_amount,
			(SELECT COUNT(id) as total FROM membership_user WHERE created_at >= '".$year_ago."' AND status_id = 1) as year_ago_total_orders,
			(SELECT SUM(total) as total FROM membership_user WHERE created_at >= '".$month_ago."' AND status_id = 1) as month_ago_total_order_amount,
			(SELECT COUNT(id) as total FROM membership_user WHERE created_at >= '".$month_ago."' AND status_id = 1) as month_ago_total_orders,
			(SELECT SUM(total) as total FROM membership_user WHERE created_at >= '".$week_ago."' AND status_id = 1) as week_ago_total_order_amount,
			(SELECT COUNT(id) as total FROM membership_user WHERE created_at >= '".$week_ago."' AND status_id = 1) as week_ago_total_orders,
			(SELECT SUM(total) as total FROM membership_user WHERE status_id = 1) as all_time_total_order_amount,
			(SELECT COUNT(id) as total FROM membership_user) as all_time_total_orders,
			(SELECT SUM(bonus_commission) as total FROM membership_user WHERE created_at >= '".$year_ago."' AND status_id = 1) as year_ago_total_bonus_commission,
			(SELECT SUM(bonus_commission) as total FROM membership_user WHERE created_at >= '".$month_ago."' AND status_id = 1) as month_ago_total_bonus_commission,
			(SELECT SUM(bonus_commission) as total FROM membership_user WHERE created_at >= '".$week_ago."' AND status_id = 1) as week_ago_total_bonus_commission,
			(SELECT SUM(bonus_commission) as total FROM membership_user WHERE status_id = 1) as all_time_total_bonus_commission
			FROM membership_user")->row();
		
		$this->view($data,"membership/membership_orders");
	}
}