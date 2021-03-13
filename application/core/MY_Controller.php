<?php
class MY_Controller extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->db->query("SET SQL_MODE = ''");
		 
		$this->load->model("Product_model");
		$site_setting = $this->Product_model->getSettings('site');
		$method = $this->uri->segment('1');
		$escape_urls = ['store','admin','admincontrol','auth','integration','firstsetting', 'membership'];
		if ($site_setting['maintenance_mode'] && !in_array($method, $escape_urls)) {
			echo $this->load->view('common/maintenance', [], true);
			die;
		}

		if (isset($site_setting['time_zone']) && $site_setting['time_zone'] != '') {
			date_default_timezone_set($site_setting['time_zone']);
		} else{
			date_default_timezone_set('Asia/Kolkata');
		}

		$table = $this->db->table_exists('ci_sessions');
        if($table) { 
			$this->load->dbforge();
			$this->dbforge->drop_table('ci_sessions');
		}
		
		$timeout = $site_setting['time_zone'];
	}

	public function build_paginate($query,$base,$page = 1, $limit=15){
		$this->load->library('pagination');
		$this->pagination->cur_page = $page;

		$total = $query->total();
		$found = count($query);

		$config['base_url'] = base_url($base);
		$config['per_page'] = $limit;
		$config['total_rows'] = $total;
		$config['use_page_numbers'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$_GET['page'] = $page;
		$config['page_query_string'] = 'page';
		$this->pagination->initialize($config);

		if($total == 0) {
			$result = "";
		} else {
			$result = '<div><div style="color:#333">Showing<span style="color:#3E7CB3"> '. max((($page-1)*$limit),0) .'-'. ((($page-1)*$limit)+$found) .' </span>of <span style="color:#3E7CB3">'.$total.'</span> Results</div></div>';
		}
		
		return  [$this->pagination->create_links(),$result];
	}

	public function checkLogin($type = 'admin'){
		if($type == 'admin'){
			$type = 'administrator';
		}

		$userdetails = $this->session->userdata($type);
		if(!$userdetails){
			if($type == 'administrator'){
				redirect('/admin');
			}
			else {
				redirect('/');
			}
		}

		return $userdetails;
	}

	public function post_data(){
		return $this->input->post(NULL,true);
	}

	public function session_message($message, $type = 'success'){
		$this->session->set_flashdata($type, $message);
	}

	public function json($json = array()){
		header('Content-Type: application/json');
		echo json_encode($json);
	}

	public function view($data, $file, $control = 'admincontrol'){
		$this->load->view($control.'/includes/header', $data);
		$this->load->view($control.'/includes/sidebar', $data);
		$this->load->view($control.'/includes/topnav', $data);
		$this->load->view($control.'/'. $file, $data);
		$this->load->view($control.'/includes/footer', $data);
	}
}
