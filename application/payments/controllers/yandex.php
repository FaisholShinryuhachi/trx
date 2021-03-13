<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
class yandex {
	public $title = 'Yandex';
	public $icon = 'assets/images/payments/yandex-logo.png';
	public $website = 'https://yandex.com';

	function __construct($api){ $this->api = $api; }

	public function getConfirm($data) {
		
		$setting_data = $data['setting_data'];
		$order_id = $data['order_id'];
		$view = APPPATH.'payments/views/yandex.php';
		require $view;
	}

	public function confirmation(){
		$post = $this->api->input->post(null,true);
		$source = file_get_contents('php://input');
    	$requestBody = json_decode($source, true);
         file_put_contents('./yandex.txt', json_encode($source) .PHP_EOL , FILE_APPEND | LOCK_EX); 

    	/*require_once(APPPATH . 'core/yandex/autoload.php');

    	use YandexCheckout\Model\Notification\NotificationSucceeded;
	    use YandexCheckout\Model\Notification\NotificationWaitingForCapture;
	    use YandexCheckout\Model\NotificationEventType;

	    try {
	      	$notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
	        ? new NotificationSucceeded($requestBody)
	        : new NotificationWaitingForCapture($requestBody);

	        $payment = $notification->getObject();


	         file_put_contents('./yandex.txt', json_encode($payment) .PHP_EOL , FILE_APPEND | LOCK_EX); 
	    } catch (Exception $e) {
	        // Processing errors
		 file_put_contents('./yandex.txt', 'err'.PHP_EOL , FILE_APPEND | LOCK_EX); 
	    }*/

	}

	public function createPayment(){
		require_once(APPPATH . 'core/yandex/autoload.php');
		$post = $this->api->input->post(null,true);

		$this->api->load->model("Order_model");
		$this->api->load->model("Product_model");
		$order_info = $this->api->Order_model->getOrder($post['order_id'], 'store');
		$setting_data = $this->api->Product_model->getSettings('storepayment_yandex');
		
		if ($order_info) {
			$client = new \YandexCheckout\Client();
			 
	        $client->setAuth($setting_data['shop_id'],$setting_data['secret_key']);

			$currency   = $order_info['currency_code'];
			//$return_url =  base_url("store/callbackfunctions/yandex/confirmation");
			$return_url =  base_url("store/thankyou/". $order_info['id']);
			$response   = $client->createPayment(
		        array(
		            'amount' => array(
		                'value' => $order_info['total'],
		                'currency' => 'RUB',
		            ),
		            'confirmation' => array(
		                'type' => 'redirect',
		                'return_url' => $return_url,
		            ),
		            'description' => 'Order No '. $order_info['id'],
		        ),
		        uniqid('', true)
		    );
		    if (isset($response) && !empty($response)) {
		    	$confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
		    	$this->api->confirm_order_api($order_info['id'],$setting_data['pending_status'],'','Waiting for the payments from yandex');
		    	$json['confirmationUrl'] = $confirmationUrl;
	    	}
		}

		echo json_encode($json);die;
	}

	public function callback(){
		/*require_once(APPPATH . 'core/yandex/yandex-checkout-sdk-php-master/lib/autoload.php');
		$client = new Client();
        $client->setAuth($setting_data['shop_id'],$setting_data['secret_key']);
        $idempotenceKey = uniqid('', true);
		$order_id = $_POST['order_id'];
		$amount   = $_POST['amount'];
		$currency   = $_POST['currency'];
		$return_url = $this->api->cart->getStoreUrl('thankyou/'. $order_id );
		$responce   = $client->createPayment(
	        array(
	            'amount' => array(
	                'value' => $amount,
	                'currency' => $currency,
	            ),
	            'confirmation' => array(
	                'type' => 'redirect',
	                'return_url' => $return_url,
	            ),
	            'capture' => true,
	            'description' => 'Order No '.$order_id,
	        ),
	        $idempotenceKey
	    );

	    if (isset($responce) && !empty($responce)) {
	    	redirect($this->api->cart->getStoreUrl('thankyou/'. $order_id ));die;
    	}*/
	}
	
	public function getMethod($data){
		return array(
			'html' => '<h3>Yandex Checkout</h3>',
			'image' => '',
		);
	}
}