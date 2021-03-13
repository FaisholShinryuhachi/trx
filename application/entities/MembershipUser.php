<?php

namespace App;

class MembershipUser extends \Illuminate\Database\Eloquent\Model

{

	public $table = 'membership_user';

	public $timestamps = false;



	public function isExpire(){

		if ($this->is_lifetime) {

			return false;

		}



		if($this->status_id != 1){

			return 2;

		}



		$curdate= strtotime(date("Y-m-d H:i:s"));

		$mydate= strtotime($this->expire_at);



		return $curdate > $mydate;

	}



	public function plan(){

		return $this->hasOne(MembershipPlan::class, 'id','plan_id');

	}



	public function bonusData(){

		return Wallet::where("type",'welcome_bonus')->where('reference_id',$this->id)->first();

	}



	public function user(){

		return $this->hasOne(User::class, 'id','user_id');

	}



	public function status_history(){

		return MembershipHistory::where("buy_id", $this->id)->get();

	}



	public function getActiveTextAttribute(){

		if ($this->is_active) {

			return "<span class='badge badge-success'>Active</span>";

		} else {

			return "<span class='badge badge-warning'>Inactive</span>";

		}

	}



	public function getExpireTextAttribute()

    {

    	if($this->expire_at != ''){

    		return dateFormat($this->expire_at,'d/m/Y');

    	}



    	if($this->is_lifetime){

        	return 'Never';

    	}



        return '';

    }



	public function getStatusTextAttribute(){
		$remain = $this->remainDay();
		if($remain == 'plan is expired'){
			return '<span class="badge badge-danger">Expire</span>';
		}

		if (isset(MembershipPlan::$status_list[$this->status_id])) {
			return '<span class="badge '. MembershipPlan::$status_color[$this->status_id] .'">'.MembershipPlan::$status_list[$this->status_id].'</span>';
		} else {
			return "Unknown";
		}
	}

	public function strToTimeRemains() {
		$isExpired = $this->isExpire();
		if ((int)$this->is_lifetime == 1 || $isExpired == 2) {
			return 0;
		}
		$started_at = strtotime(date('Y-m-d H:i:s'));
		$expire_at = strtotime($this->expire_at);
		$datediff = $expire_at - $started_at;
		return $datediff;
	}

	public function remainDay(){
		$isExpired = $this->isExpire();

		if ((int)$this->is_lifetime == 1 || $isExpired == 2) {
			return 'Not Available';
		}

		$started_at = strtotime(date('Y-m-d H:i:s'));
		$expire_at = strtotime($this->expire_at);
		$datediff = $expire_at - $started_at;

		if($datediff <= 0) {
			return 'Plan Is Expired';
		}

		$days = floor($datediff / (24*60*60));
		$hours = floor(($datediff - ($days*24*60*60)) / (60*60));
		$minutes = floor(($datediff - ($days*24*60*60)-($hours*60*60)) / 60);

		$reaminsTimeString = "";
		$reaminsTimeString .= ($days > 0) ? $days.' Days ' : "";
		$reaminsTimeString .= ($hours > 0) ? $hours.' Hours ' : "";
		$reaminsTimeString .= ($minutes > 0) ? $minutes.' Minutes Remains' : " 1 Minutes Remains";

		return $reaminsTimeString;
	}

}