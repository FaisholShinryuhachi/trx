<?php

use App\MembershipPlan;
use App\User;

class paypal {
	public $title = 'Paypal';
	public $icon = 'application/membership_payment/logo/paypal.png';
	public $website = '';

	function __construct($api){
		$this->api = $api;
	}

	public function onInstall() {

	}

	public function onUnInstall() {
	}

	public function doPayment($plan_id)
	{
		$ci =& get_instance();
		$plan = MembershipPlan::find($plan_id);
		$user = User::auth('user');
		$setting      = $this->api->Product_model->getSettings('membershippayment_paypal');
		$setting_site = $this->api->Product_model->getSettings('site');

		$config = array(
            'Sandbox'      => $setting['payment_mode'] == 'sandbox' ? TRUE : FALSE,
            'APIUsername'  => $setting['api_username'],
            'APIPassword'  => $setting['api_password'],
            'APISignature' => $setting['api_signature'],
            'APISubject'   => '',
            'APIVersion'   => '98.0' ,
        );

        $this->api->load->library('paypal/Paypal_pro', $config);

        $SECFields = array(
			'returnurl' => site_url('membership_callback/paypal/notify/' . $plan_id), 
			'cancelurl' => site_url('membership_callback/paypal/paypal_cancel/' . $plan_id), 
			'brandname' => $setting_site['name'],
			'hdrimg'    => ''
        );

        $Payments = array();
        $PaymentOrderItems = array(
			'name'    => $plan->name,
			'desc'    => $plan->description,
			'amt'     => c_format(($plan->special ? $plan->special : $plan->price),false),
			'number'  => $plan->id,
			'qty'     => 1,
			'taxamt'  => 0,
			'itemurl' => '', 
        );
       
        $Payment = array(
			'order_items'  => $PaymentOrderItems,
			'amt'          => c_format(($plan->special ? $plan->special : $plan->price),false),
			'itemamt'      => c_format(($plan->special ? $plan->special : $plan->price),false),
			'currencycode' => $_SESSION['userCurrency'],
        );

        array_push($Payments, $Payment);
        $PayPalRequestData = array(
			'SECFields' => $SECFields,
			'Payments'  => $Payments,
        );

        $PayPalResult = $this->api->paypal_pro->SetExpressCheckout($PayPalRequestData);
        
        if (isset($PayPalResult['ACK']) && $this->api->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
        	$this->api->session->set_flashdata('error', $PayPalResult['ERRORS'][0]['L_LONGMESSAGE']);
		 	redirect($PayPalResult['REDIRECTURL']);
        } else {
            $error = isset($PayPalResult['ERRORS'][0]['L_LONGMESSAGE']) ? $PayPalResult['ERRORS'][0]['L_LONGMESSAGE'] : 'Something went wrong, Please try again.';
            $this->api->session->set_flashdata('error', $error);
            redirect('membership/buy_membership/'.$plan_id.'/paypal');
        }
	}

	public function paypal_cancel($plan_id){
		redirect('membership/buy_membership/'.$plan_id.'/paypal');
	}

	public function notify($plan_id){
		$this->api->load->model("Product_model");
		$plan_info = MembershipPlan::find($plan_id);
		$user = User::auth('user');
		$setting = $this->api->Product_model->getSettings('membershippayment_paypal');

		$config = array(
            'Sandbox'      => $setting['payment_mode'] == 'sandbox' ? TRUE : FALSE,
            'APIUsername'  => $setting['api_username'],
            'APIPassword'  => $setting['api_password'],
            'APISignature' => $setting['api_signature'],
            'APISubject'   => '',
            'APIVersion'   => '98.0' ,
        );

        $this->api->load->library('paypal/Paypal_pro', $config);
		$token    = $this->api->input->get('token');
		$payer_id = $this->api->input->get('PayerID');

		$PayPalResult = $this->api->paypal_pro->GetExpressCheckoutDetails($token);

        if ($PayPalResult['ACK'] == 'Success') {
            $transaction_amount = c_format(($plan_info->special ? $plan_info->special : $plan_info->price),false);

            $DECPFields = array(
				'token'   => $token,
				'payerid' => $payer_id,
            );

            $Payments = array();
            $Payment = array(
				'amt'            => $transaction_amount,
				'currencycode'   => $_SESSION['userCurrency'],
            );
            array_push($Payments, $Payment);
            $PayPalRequestData = array(
                'DECPFields' => $DECPFields,
                'Payments' => $Payments,
            );
            $PayPalResult = $this->api->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);
            
            if ($this->api->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            	$transaction_id = $PayPalResult['PAYMENTINFO_0_TRANSACTIONID'];
            	$payment_status = $PayPalResult['PAYMENTINFO_0_PAYMENTSTATUS'];

            	switch($payment_status) {
					case 'Canceled_Reversal' : $order_status_id = $setting['canceled_status_id']; break;
					case 'Completed'         : $order_status_id = $setting['success_status_id']; break;
					case 'Denied'            : $order_status_id = $setting['denied_status_id']; break;
					case 'Expired'           : $order_status_id = $setting['denied_status_id']; break;
					case 'Failed'            : $order_status_id = $setting['canceled_status_id']; break;
					case 'Pending'           : $order_status_id = $setting['pending_status_id']; break;
					case 'Processed'         : $order_status_id = $setting['processing_status_id']; break;
					case 'Refunded'          : $order_status_id = $setting['canceled_status_id']; break;
					case 'Reversed'          : $order_status_id = $setting['canceled_status_id']; break;
					case 'Voided'            : $order_status_id = $setting['denied_status_id']; break;
				}
				$comment = "Tran ID {$transaction_id} Paypal Status {$payment_status}";
				$payment_details = array(
					'transaction_id' => $transaction_id,
					'payment_status' => $payment_status,
				);
				$membership = $plan_info->buy($user, $order_status_id, $comment, 'Paypal', 1, $payment_details);
				$this->api->session->set_flashdata('success', 'Thank You for Your Purchase, Your Order is now Completed.');
		 		redirect('usercontrol/membership_purchase_details/'. $membership->id);
            } 
        } else {
			$membership = $plan_info->buy($user, 0, $PayPalResult['ERRORS'][0]['L_LONGMESSAGE'], 'Paypal');
			$this->api->session->set_flashdata('error', $PayPalResult['ERRORS'][0]['L_LONGMESSAGE']);
			redirect('usercontrol/membership_purchase_details/'. $membership->id);
        }
	}
}