<?php

class xendit {
	public $title = 'Xendit';
	public $icon = 'assets/images/payments/xendit_logo.png';
	public $website = 'https://www.Xendit.com';


	function __construct($api){ $this->api = $api; }

	public function getConfirm($data) {
		
		$web_site_title = 'My Store';
		$web_site_logo_link = 'https://assets.piedpiper.com/logo.png';

		$setting_data = $data['setting_data'];
		if((int)$setting_data['environment'] == 1) {
			$secret_api_key =  $setting_data['live_secret_key'];
			$test_mode = false;
		} else {
			$secret_api_key =  $setting_data['test_secret_key'];
			$test_mode = true;
		}
		$order_info   = $data['order_info'];
		$products     = $data['products'];
		$description    = $order_info['firstname']." " .$order_info['lastname'];
		$transaction_id = time().'-'.$data['order_id'];
		$return_url     = site_url('store/thankyou/'. $data['order_id']);
		$cancel_url     = site_url('store/checkout');
		$status_url     = site_url('store/callbackfunctions/xendit/callback/'.$data['order_id']);
		$language       = 'en';
		$pay_from_email = $order_info['email'];
		$firstname      = $order_info['firstname'];
		$lastname       = $order_info['lastname'];
		$phone_number   = $order_info['phone'];
		$amount         = $order_info['total'];
		$cur_data = $this->api->db->where('code','IDR')->get('currency')->row();
		$amount = $amount * $cur_data->value;
		
		$currency       = $order_info['currency_code'];
		$address        = $order_info['address'];
		$address2       = '';
		$products = '';
		foreach ($products as $product) {
			$products .= $product['quantity'] . ' x ' . $product['product_name'] . ', ';
		}
        $this->api->load->library('session');
		$detail1_text = $products;
		$order_id = ''.$data['order_id'].'';
		// first send data to xendit and get order id
	
		$options['success_redirect_url'] = $status_url;
		$options['failure_redirect_url'] = $cancel_url;
		// load xendit library
		require_once(APPPATH . 'core/xendit/XenditPHPClient.php');
		$options['secret_api_key'] = $secret_api_key;
       	$xenditPHPClient = new XenditClient\XenditPHPClient($options);
       	try {
            $api_responce =  $xenditPHPClient->createInvoice($order_id, $amount, $pay_from_email, $description,$options);
        }
        catch (Exception $e) { 
            $api_responce['error'] = $e->getMessage();    
        }
        
		if (isset($api_responce['id']) && !empty($api_responce['id']) ) {
			$xendit_id = $api_responce['id'];
			$_SESSION['xendit_id'] = $xendit_id;
			$action    = $api_responce['invoice_url'];
		}else{
			$api_responce['error'] = $e->getMessage();
		}
		$view = APPPATH.'payments/views/xendit.php';
		require $view;
	}
	public function callback($order_id) {
		$order_info   = $this->api->Order_model->getOrder((int)$order_id, 'store');
		$setting_data = $this->api->Product_model->getSettings('storepayment_xendit');
		if((int)$setting_data['environment'] == 1) {
			$secret_api_key =  $setting_data['live_secret_key'];
			$test_mode = false;
		} else {
			$secret_api_key =  $setting_data['test_secret_key'];
			$test_mode = true;
		}
		$xendit_id = $_SESSION['xendit_id'];
		// load xendit library
		require_once(APPPATH . 'core/xendit/XenditPHPClient.php');
		$options['secret_api_key'] = $secret_api_key;
       	$xenditPHPClient = new XenditClient\XenditPHPClient($options);
       	try {
            $api_responce =   $xenditPHPClient->getInvoice($xendit_id);
        }
        catch (Exception $e) { 
            $api_responce['error'] = $e->getMessage();    
        }
		if (isset($api_responce['id']) && !empty($api_responce['id']) ) {
			$xendit_id = $api_responce['id'];
			$payment_status    = $api_responce['status'];
		}else{
			$payment_status    = '';
			$api_responce['error'] = $e->getMessage();
		}
		// end api 
		if ($order_info){
			if(isset($xendit_id) && $payment_status != "") {
			    $message = 'Payment ID: '.$xendit_id;
				$this->api->confirm_order_api($order_id,$setting_data['order_success_status'],$xendit_id,$message);
				redirect($this->api->cart->getStoreUrl('thankyou/'. $order_id ));die;
			} else {
			    $message = $api_responce['error'];
				$this->api->confirm_order_api($order_id,$setting_data['order_failed_status'],'', $message);
				redirect($this->api->cart->getStoreUrl('thankyou/'. $order_id ));die;
			}
		}
	}

	public function getMethod($data){
		return array(
			'html' => '<h3>Xendit</h3>',
		);
	}
}