<?php



class flutterwave {

	public $title = 'Flutterwave';

	public $icon = 'assets/images/payments/flutterwave_logo.png';

	public $website = 'https://www.flutterwave.com';





	function __construct($api){ $this->api = $api; }



	public function getConfirm($data) {

		$web_site_title = 'My Store';

		$web_site_logo_link = 'https://assets.piedpiper.com/logo.png';



		$setting_data = $data['setting_data'];

		if((int)$setting_data['environment'] == 1) {

			$flutterwave_public_key = $setting_data['live_public_key'];

			$test_mode = false;

		} else {

			$flutterwave_public_key = $setting_data['test_public_key'];

			$test_mode = true;

		}

		$order_info   = $data['order_info'];

		$products     = $data['products'];

		$description    = $order_info['firstname']." " .$order_info['lastname'];

		$transaction_id = time().'-'.$data['order_id'];

		$return_url     = site_url('store/thankyou/'. $data['order_id']);

		$cancel_url     = site_url('store/checkout');

		$status_url     = site_url('store/callbackfunctions/flutterwave/callback');

		$language       = 'en';

		$pay_from_email = $order_info['email'];

		$firstname      = $order_info['firstname'];

		$lastname       = $order_info['lastname'];

		$phone_number   = $order_info['phone'];

		$amount         = $order_info['total'];

		$currency       = $order_info['currency_code'];

		$products = '';

		foreach ($products as $product) {

			$products .= $product['quantity'] . ' x ' . $product['product_name'] . ', ';

		}



		$detail1_text = $products;

		$order_id = $data['order_id'];



		$view = APPPATH.'payments/views/flutterwave.php';

		require $view;

	}

 	public function callback() {

		$transaction_id = $_GET['transaction_id'];

		$transaction_status =$_GET['status'];

		$order_id = $_GET['tx_ref'];

		$order_info   = $this->api->Order_model->getOrder((int)$order_id, 'store');

		$setting_data    = $this->api->Product_model->getSettings('storepayment_flutterwave');

	

		if ($order_info){

			if(isset($transaction_status) && $transaction_status == "successful") {

			    $message = 'Payment ID: '.$transaction_id;

				$this->api->confirm_order_api($order_id,$setting_data['order_success_status'],$transaction_id,$message);

				redirect($this->api->cart->getStoreUrl('thankyou/'. $order_id ));die;

			} else {
			    $message = 'Your payment has been failed!';

				$this->api->confirm_order_api($order_id,$setting_data['order_failed_status'],$transaction_id, $message);

				redirect($this->api->cart->getStoreUrl('thankyou/'. $order_id ));die;

			}

		}

	}



	public function getMethod($data){

		return array(

			'html' => '<h3>Flutterwave</h3>',

		);

	}

}