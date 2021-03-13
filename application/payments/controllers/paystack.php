<?php

class paystack {
	public $title = 'paystack';
	public $icon = 'assets/images/payments/paystack.png';
	public $website = 'https://paystack.com/';


	function __construct($api){ $this->api = $api; }

	public function getConfirm($data) {

		$setting_data = $data['setting_data'];
		$order_info = $data['order_info'];
	
		$mobile_no = "";
		if($order_info['phone']){
			$mobile_no = preg_replace('/\D/', '', $order_info['phone']);
		}

		$cust_id = "";
		$email = "";
		if(isset($order_info['email']) && trim($order_info['email']) != ""){
			$cust_id = $email = $order_info['email'];
		} else if($order_info['user_id'] > 0){
			$cust_id = $order_info['user_id'];
		}

		$amount = $order_info['total'];

		$parameters = array(
			"public_key"       => $setting_data['public_key'],
			"CUST_ID"          => $cust_id,
			"TXN_AMOUNT"       => $amount,
			"MOBILE_NO"        => $mobile_no,
			"EMAIL"            => $email,
		);
	
		$action = APPPATH.'payments/controllers/paystack/confirm';

		$view = APPPATH.'payments/views/paystack.php';
		require $view;
	}

	public function confirm($data){
		$order        = $data['order_info'];
		$cart_product = $data['products'];
		$order_id     = $order['id'];
		$setting      = $this->api->Product_model->getSettings('storepayment_paystack');
		$setting_site = $this->api->getSettings('site');
        $order_info = $data['order_info'];
	
		$mobile_no = "";
		if($order_info['phone']){
			$mobile_no = preg_replace('/\D/', '', $order_info['phone']);
		}

		$cust_id = "";
		$email = "";
		if(isset($order_info['email']) && trim($order_info['email']) != ""){
			$cust_id = $email = $order_info['email'];
		} else if($order_info['user_id'] > 0){
			$cust_id = $order_info['user_id'];
		}

		$amount = $order_info['total'];
        $amt = $amount;
        $public_key = $setting['public_key'];
        $email = $email;

        $Paystack_data = array(
			'email'     => $email,
			'api_token' => $setting['public_key'],
            'amt'       => $amount,
            'orderId' => $data['order_info']['id'],
        );

     	return $Paystack_data;    
    }

    public function update()
	{
		$data = $this->api->input->post();
		$message = "Reference: " . $data['reference'];
		$this->api->confirm_order_api($data['orderId'],1, $data['reference'], $message);
        $json = array(
        	'redirect' => base_url('store/thankyou/'. $data['orderId'])
        );

        echo json_encode($json);die;
	}


	public function getMethod($data){
		return array(
			'html' => '<h3>Paystack</h3>',
		);
	}
}