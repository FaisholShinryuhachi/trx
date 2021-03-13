<?php



class razorpay {

	public $title = 'Razorpay';

	public $icon = 'assets/images/payments/razorpay_logo.png';

	public $website = 'https://www.razorpay.com';





	function __construct($api){ $this->api = $api; }



	public function getConfirm($data) {

		$web_site_title = 'My Store';

		$web_site_logo_link = 'https://assets.piedpiper.com/logo.png';



		$setting_data = $data['setting_data'];

		if((int)$setting_data['environment'] == 1) {

			$razorpay_auth['key_id'] = $setting_data['live_key_id'];

			$razorpay_key_id =  $setting_data['live_key_id'];

			$razorpay_auth['key_secret'] = $setting_data['live_key_secret'];

			$test_mode = false;

		} else {

			$razorpay_auth['key_id'] = $setting_data['test_key_id'];

			$razorpay_key_id = $setting_data['test_key_id'];

			$razorpay_auth['key_secret'] = $setting_data['test_key_secret'];

			$test_mode = true;

		}

		$order_info   = $data['order_info'];

		$products     = $data['products'];

		$description    = $order_info['firstname']." " .$order_info['lastname'];

		$transaction_id = time().'-'.$data['order_id'];

		$return_url     = site_url('store/thankyou/'. $data['order_id']);

		$cancel_url     = site_url('store/checkout');

		$status_url     = site_url('store/callbackfunctions/razorpay/callback/'.$data['order_id']);

		$language       = 'en';

		$pay_from_email = $order_info['email'];

		$firstname      = $order_info['firstname'];

		$lastname       = $order_info['lastname'];

		$phone_number   = $order_info['phone'];

		$amount         = $order_info['total'];

		$currency       = $order_info['currency_code'];

		$address        = $order_info['address'];

		$address2       = '';

		$products = '';

		foreach ($products as $product) {

			$products .= $product['quantity'] . ' x ' . $product['product_name'] . ', ';

		}



		$detail1_text = $products;

		$order_id = $data['order_id'];

		// first send data to Razorpay and get order id

		$payment_data['order_id'] = $order_id;

		$payment_data['amount'] = $amount;

		$payment_data['currency'] = $currency;

		

        // loading library

        	require_once(APPPATH . 'core/Razorpay/Razorpay.php');

        	$api_data = new  Razorpay\Api\Api($razorpay_auth['key_id'], $razorpay_auth['key_secret']);

        

            try {

                $api_responce  =   $api_data->order->create([

                          'receipt'         => $payment_data['order_id'],

                          'amount'          => 100 * $payment_data['amount'], 

                          'currency'        => $payment_data['currency'],

                          'payment_capture' =>  '0',

                        ]);

            }

            catch (Exception $e) { 

                $api_responce['error'] = $e->getMessage();    

            }        

        

		if (isset($api_responce['id']) && !empty($api_responce['id']) ) {

			$razorpay_id = $api_responce['id'];

		}else{

		    $error =  $api_responce['error'];

		}

		$view = APPPATH.'payments/views/razorpay.php';

		require $view;

	}

	public function callback($order_id) {

		$post_data = $this->api->input->post();

		$razorpay_payment_id = $post_data['razorpay_payment_id'];

		

		$razorpay_order_id = $post_data['razorpay_order_id'];

		$order_info   = $this->api->Order_model->getOrder((int)$order_id, 'store');

		$setting_data = $this->api->Product_model->getSettings('storepayment_razorpay');

	

		if ($order_info){

			if(isset($razorpay_payment_id) && $razorpay_payment_id != "") {
				$message = 'Payment ID: '.$razorpay_payment_id;
				
				$this->api->confirm_order_api($order_id,$setting_data['order_success_status'],$razorpay_payment_id, $message);

				redirect($this->api->cart->getStoreUrl('thankyou/'. $order_id ));die;

			} else {
				$message = 'Your payment has been failed!';

				$this->api->confirm_order_api($order_id,$setting_data['order_failed_status'],$razorpay_payment_id, $message);

				redirect($this->api->cart->getStoreUrl('thankyou/'. $order_id ));die;

			}

		}

	}



	public function getMethod($data){

		return array(

			'html' => '<h3>Razorpay</h3>',

		);

	}

}