<?php
use App\MembershipPlan;
use App\User;

class bank_transfer {
	public $title = 'Bank Transfer';
	public $icon = 'assets/images/withdrawal_payment/bank-transfer.png';
	public $website = '';

	function __construct($api){ $this->api = $api; }

	public function doPayment($plan_id){
		$plan = MembershipPlan::find($plan_id);
		$user = User::auth('user');
		$membership = $plan->buy($user,$status_id=0, $comment = 'Wait till admin respond',$payment_method='Bank Transfer');
		if($membership){
			redirect('usercontrol/membership_purchase_details/'. $membership->id);
		}
	}
}