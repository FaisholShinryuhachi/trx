<form action="" method="POST" role="form" class="reg_form" novalidate="" autocomple="off">
	
	<script type="text/javascript">
		var tel_input = false;
		var grecaptcha = undefined;
	</script>
	<?php 
		$db =& get_instance(); 
		$products = $db->Product_model; 
	    $googlerecaptcha =$db->Product_model->getSettings('googlerecaptcha');	


		$fields = array();
		$email = isset($user) ? $user['email'] : '';
		$fields['email'] = '<div class="form-group">
			<input type="email" name="email" placeholder="'. __('user.email') .'" class="form-control" value="'. $email .'">  
		</div>';

		if (isset($allow_vendor_option)) {
			$is_vendor = isset($user) ? (int)$user['is_vendor'] : 0;
			$fields['is_vendor'] = '<div class="form-group">
				<label>Vendor Status</label>
				<select name="is_vendor"  class="form-control">
					<option selected disabled>Vendor Status</option>  
					<option '. ($is_vendor ==1 ? 'selected' : '') .' value="1">Enable</option>
					<option '. ($is_vendor ==0 ? 'selected' : '') .' value="0">Disable</option>
				</select>
			</div>';
		}

		$firstname = isset($user) ? $user['firstname'] : '';
		$fields['firstname'] = '<div class="form-group">
			<input type="text" name="firstname" id="firstname" class="form-control" placeholder="'. __('user.first_name') .'" value="'. $firstname .'" >
		</div>';
		$lastname = isset($user) ? $user['lastname'] : '';
		$fields['lastname'] = '<div class="form-group">
			<input type="text" name="lastname" id="lastname" class="form-control" placeholder="'. __('user.last_name') .'" value="'. $lastname .'">
		</div>';
		$username = isset($user) ? $user['username'] : '';
		$fields['username'] = '<div class="form-group">
			<input type="text" name="username" id="username" class="form-control" placeholder="'. __('user.username') .'" value="'. $username .'">
		</div>';
		//if(!isset($edit_view)){
			$fields['password'] = '<div class="form-group">
				<input type="password" name="password" id="password" placeholder="'. __('user.password') .'" class="form-control">
			</div>';
			$fields['confirm_password'] = '<div class="form-group">
				<input type= "password"  name= "cpassword" id= "cpassword" placeholder="'. __('user.repeat_password') .'" class="form-control">
			</div>';
		//}

		$customValue = json_decode(isset($user['value']) ? $user['value'] : '[]', 1);
		
	?>
	
	<?php foreach ($data as $key => $value) { 
		  
		$required    = (isset($value['required']) && $value['required'] == 'true') ? 'required="required"' : '';
		$label       = (isset($value['label']) && $value['label'] ) ? $value['label'] : '';
		$placeholder = (isset($value['placeholder']) && $value['placeholder'] ) ? $value['placeholder'] : '';
		$className   = (isset($value['className']) && $value['className'] ) ? $value['className'] : '';
		$name        = 'custom_'.((isset($value['name']) && $value['name'] ) ? $value['name'] : '');
		$ivalue      = (isset($value['value']) && $value['value'] ) ? $value['value'] : (isset($customValue[$name]) ? $customValue[$name] : '');
		$maxlength   = (isset($value['maxlength']) && $value['maxlength'] ) ? $value['maxlength'] : '';
		$min         = (isset($value['min']) && $value['min'] ) ? $value['min'] : '';
		$max         = (isset($value['max']) && $value['max'] ) ? $value['max'] : '';
		$mobile_validation         = (isset($value['mobile_validation']) && $value['mobile_validation'] ) ? $value['mobile_validation'] : '';
		$_customValue = $ivalue;

		switch ($value['type']) {
			case 'header': 
				echo  $fields[strtolower($label)]; 
				if($label == 'Email' && isset($allow_vendor_option)){
					echo  $fields['is_vendor']; 
				}
			break;
			case 'text':
				if($mobile_validation == 'true'){ ?>
					<link rel="stylesheet" href="<?= base_url('assets/plugins/tel/css/intlTelInput.css') ?>?v=<?= av() ?>">
					<script src="<?= base_url('assets/plugins/tel/js/intlTelInput.js') ?>"></script>
					<input type="hidden" name='<?= $name ?>' id="phonenumber-input" value="<?= $ivalue ?>" class="<?= $className ?>" placeholder="<?= $placeholder ?>" <?= $required ?> maxlength = '<?= $maxlength ?>' >
					<div class="form-group">
						<div>
							<input id="phone" class="form-control" type="text" value="<?= $ivalue ?>">
						</div>
					</div>
					<script type="text/javascript">
						var tel_input = intlTelInput(document.querySelector("#phone"), {
						  initialCountry: "auto",
						  utilsScript: "<?= base_url('/assets/plugins/tel/js/utils.js?1562189064761') ?>",
						  separateDialCode:true,
						  geoIpLookup: function(success, failure) {
						    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
						      var countryCode = (resp && resp.country) ? resp.country : "";
						      success(countryCode);
						    });
						  },
						});
					</script>
				<?php } else { ?>
					<div class="form-group">
						<input type="text" name='<?= $name ?>' id="<?= $name ?>" value="<?= $ivalue ?>" class="<?= $className ?>" placeholder="<?= $placeholder ?>" <?= $required ?> maxlength = '<?= $maxlength ?>' >
					</div>
				<?php }
				break;
			case 'number': ?>
				<div class="form-group">
					<input type="number" name="<?= $name ?>" id="<?= $name ?>" class="<?= $className ?>" value="<?= $ivalue ?>" min="<?= $min ?>" max="<?= $max ?>"  <?= $required ?> placeholder="<?= $label ?>">
				</div>
			<?php
			break;
			case 'textarea': ?>
			<div class="form-group">
				<textarea name="<?= $name ?>" id="<?= $name ?>" class="<?= $className ?>" rows="3" <?= $required ?> maxlength = '<?= $maxlength ?>' placeholder="<?= $label ?>"><?= $ivalue ?></textarea>
			</div>
			<?php
			break;
			case 'date': ?>
			 <div class="form-group">
	            <label class="control-label" for="input-date-available"><?= $label ?></label>
			        <div class="input-group date" data-provide="datepicker">
					    <input type="text" class="form-control <?= $className ?>" name="<?= $name ?>" value="<?= $ivalue ?>" placeholder="<?= $placeholder ?>" <?= $required ?>>
					    <div class="input-group-addon">
					        <span class="glyphicon glyphicon-th"></span>
					    </div>
					</div>
	          </div>
			<?php
			break;
			case 'checkbox-group':
			if(isset($value['values'])){
				echo '<div class="form-group"><label>'.$label.'</label>';
				foreach ($value['values'] as $k => $v) {
					$label = (isset($v['label']) && $v['label'] ) ? $v['label'] : '';
					$ivalue = (isset($v['value']) && $v['value'] ) ? $v['value'] : '';
					$selected = (isset($value['selected']) && $value['selected'] ) ? "checked='checked'" : ($ivalue == $ivalue);
				 ?>
			
				<div class="checkbox">
					<label>
						<input type="checkbox" name="<?= $name ?>" value="<?= $ivalue ?>" <?= $selected ?> class="<?= $className ?>">
						<?= $label ?>
					</label>
				</div>
			<?php } ?>
			</div>
			<?php } 
			break;
			case 'radio-group':
			if(isset($value['values'])){
				echo '<div class="form-group"><label>'.$label.'</label>';
				foreach ($value['values'] as $k => $v) {
				$label = (isset($v['label']) && $v['label'] ) ? $v['label'] : '';
				$ivalue = (isset($v['value']) && $v['value'] ) ? $v['value'] : '';
				$selected = (isset($v['selected']) && $v['selected'] ) ? "selected='selected'" : '';
			 ?>
				<div class="radio">
					<label>
						<input type="radio" name="<?= $name ?>" value="<?= $ivalue ?>" <?= $selected ?> class="<?= $className ?>">
						<?= $label ?>
					</label>
				</div>
			<?php } ?>
			</div>
			<?php } 
			break;
			case 'select':
			if(isset($value['values'])){ ?>
				<div class="form-group">
					<label for="<?= $name ?>"><?= $label ?></label>
				 	<select name="<?= $name ?>" id="<?= $name ?>" class="form-control <?= $class ?>">
				 		<?php 
				 
				 			foreach ($value['values'] as $k => $v) {
							$label = (isset($v['label']) && $v['label'] ) ? $v['label'] : '';
							$ivalue = (isset($v['value']) && $v['value'] ) ? $v['value'] : '';
							$selected = '';
							if(isset($edit_view) && $_customValue == $ivalue) {
								$selected = "selected='selected'";
							} else if( !isset($edit_view) && isset($v['selected']) && $v['selected']){
								$selected = "selected='selected'";
							}
				 		?>
				 		<option value="<?= $ivalue ?>" <?= $selected ?>><?= $label ?></option>
						<?php } ?>
				 	</select>
				</div>
			<?php } 
			break;
			default:
				
				break;
		} ?>
	<?php } ?>
	<?php if(isset($edit_view_refer)){ ?>
		<div class="form-group">
			<label class="control-label">Under Affiliate</label>
			<select class="form-control" name="refid">
				<option value="0"> -- None -- </option>
				<?php foreach ($refer_users as $key => $value) { ?>
					<option <?= (isset($user) && $user['refid'] == $value['id']) ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['username'] ?></option>
				<?php } ?>
			</select>
		</div>
	<?php } ?>
	
	<?php if(isset($edit_view)){ ?>
		<div class="form-group">
			<label class="control-label">Country</label>
			<select class="form-control" name="country_id">
				<option value="0"> -- None -- </option>
				<?php foreach ($countries as $key => $value) { ?>
					<option <?= (isset($user) && $user['ucountry'] == $value['id']) ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
				<?php } ?>
			</select>
		</div>
	<?php } ?>
	<?php if(!isset($edit_view)){ ?>

		<?php if (isset($googlerecaptcha['affiliate_register']) && $googlerecaptcha['affiliate_register']) { ?>
			<div class="captch mb-3 form-group">
				<script src='https://www.google.com/recaptcha/api.js'></script>
				<div class="g-recaptcha" data-sitekey="<?= $googlerecaptcha['sitekey'] ?>"></div>
				<input type="hidden" name="captch_response" id="captch_response">
			</div>
		<?php } ?>
		
		<div class="check_box text-left">
			<p>
				<input type="checkbox" id="checkbox" name="terms" value="1" class="" checked>

				<?php if(isset($template_index)) { ?>
					<span for="checkbox"><a href="<?= $tnc_link ? $tnc_link : base_url('term-condition') ?>" target="_blank" style="margin-top:0px;"><?= __('user.affiliate_policy') ?></a></span>
					<?php
				} else {
					?>
					<label for="checkbox"><a href="<?= $tnc_link ? $tnc_link : base_url('term-condition') ?>" target="_blank" style="margin-top:0px;"><?= __('user.affiliate_policy') ?></a></label>
					<?php
				}?>

			</p>
		</div>

		<input class="<?= $allow_back_to_login ? "btn btn-primary" : ""; ?> btn-registration btn-submit" type="submit" value="<?= __('user.submit') ?>">
	<?php } ?>
</form>
<div style="display:none;"><a href="https://affiliatepro.org">affiliate pro</a></div>
