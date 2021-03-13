<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Updatecontrol extends MY_Controller {
	public function index(){
		$data['update_version_outside'] = true;
		if(!$this->session->administrator){
			$this->load->model('Product_model');
			$data['setting'] = $this->Product_model->getSettings('site');
			$this->load->view('auth/admin/index', $data);
		} else {
			$this->load->view('admincontrol/includes/header', $data);
			$this->load->view('admincontrol/setting/install_new_version');
			$this->load->view('admincontrol/includes/footer', $data);
		}
	}

}