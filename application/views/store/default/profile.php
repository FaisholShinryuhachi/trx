<section class="profile-page">
	<div class="container">
		<div class="profile-page-wrapper">
			<div class="profile-sidebar">
				<h3>User Menu</h3>
				<ul>
					<li><a class="active" href="<?= $base_url ?>profile"><?= __('store.profile') ?></a></li>
					<li><a href="<?= $base_url ?>order"><?= __('store.order') ?></a></li>
					<li><a href="<?= $base_url ?>shipping"><?= __('store.shipping') ?></a></li>
					<li><a href="<?= $base_url ?>wishlist">Wishlist</a></li>
					<li><a href="<?= $base_url ?>logout"><?= __('store.logout') ?></a></li>
				</ul>
			</div>

			<div class="profile-main">
				<form action="<?php echo base_url('store/profile') ?>" class="form-horizontal" method="post" id="profile-frm" enctype="multipart/form-data">
					<h2><?= __('store.profile') ?></h2>
					<?php 
					$avatar = ($client['avatar'] != '') ? base_url('assets/images/users/'.$client['avatar']) : base_url('assets/store/default/img/blog1.png') ; 
					?>
					<img id="blah" src="<?= $avatar ?>" class="img-profile-main" alt="Profile">
					<div class="fileUpload btn text-dark text-center w-100">
						<span><i class="far fa-image mr-2"></i><?= __('store.choose_file') ?></span>
						<input id="uploadBtn" name="avatar" class="upload" type="file" style="display:none;">
					</div>		

					<div class="form-checkout-wrapper">
						<div class="checkout-form">
							<div class="form-row">
								<div class="form-group">
									<label><?= __('store.first_name') ?>*</label>
									<input placeholder="Enter your First Name" name="firstname" value="<?php echo $userDetails['firstname']; ?>" class="form-control" type="text">
									<?php if($errors && isset($errors['firstname'])) { ?>
									<div class="text-danger"><?php echo $errors['firstname'] ?></div>
									<?php } ?>
								</div>

								<div class="form-group">
									<label><?= __('store.last_name') ?>*</label>
									<input placeholder="Enter your Last Name" name="lastname" class="form-control" value="<?php echo $userDetails['lastname']; ?>" type="text">
									<?php if($errors && isset($errors['lastname'])) { ?>
									<div class="text-danger"><?php echo $errors['lastname'] ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="form-row">

								<div class="form-group">
									<label><?= __('store.your_email') ?>*</label>
									<input placeholder="Enter your Email Address" name="email" id="email" class="form-control" value="<?php echo $userDetails['email']; ?>" type="email">
									<?php if($errors && isset($errors['email'])) { ?>
									<div class="text-danger"><?php echo $errors['email'] ?></div>
									<?php } ?>
								</div>

								<div class="form-group">
									<label><?= __('store.phone_number') ?>*</label>
									<link rel="stylesheet" href="<?= base_url('assets/plugins/tel/css/intlTelInput.css') ?>?v=<?= av() ?>">
									<script src="<?= base_url('assets/plugins/tel/js/intlTelInput.js') ?>"></script>
									<div class="form-group">
										<input id="PhoneNumber" placeholder="Enter your Mobile Number" type="text" name="PhoneNumber" value="">
									</div>
									<script type="text/javascript">
										var tel_input = intlTelInput(document.querySelector("#PhoneNumber"), {
											initialCountry: "auto",
											utilsScript: "<?= base_url('/assets/plugins/tel/js/utils.js?1562189064761') ?>",
											separateDialCode:true,
											geoIpLookup: function(success, failure) {
											$.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
												var countryCode = (resp && resp.country) ? resp.country : "";
												success(countryCode);
												setTimeout(function(){ $("#PhoneNumber").val('<?php echo $userDetails['PhoneNumber']; ?>') }, 100);
											});
											},
										});
									</script>
									<?php if($errors && isset($errors['PhoneNumber'])) { ?>
										<div class="text-danger"><?php echo $errors['PhoneNumber'] ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group">
									<label><?= __('store.country') ?></label>
									<select name="Country" class="custom-select form-control countries" id="Country" >
										<option value="" selected="selected" ><?= __('store.select_country') ?></option>
										<?php foreach($country as $countries): ?>
										<option <?php if(!empty($userDetails['country']) && $userDetails['country'] == $countries->id) { ?> selected <?php }?> value="<?php echo $countries->id; ?>"><?php echo $countries->name; ?></option>
										<?php endforeach; ?> 
									</select>
								</div>
							</div>


							<div class="form-row">

								<div class="form-group">
									<label><?= __('store.city') ?>*</label>
									<input class="form-control" placeholder="Enter your City" name="City" id="City" value="<?php echo $userDetails['city'];?>" type="text">
									<?php if($errors && isset($errors['City'])) { ?>
									<div class="text-danger"><?php echo $errors['City'] ?></div>
									<?php } ?>
								</div>

								<div class="form-group">
									<label><?= __('store.pincode') ?>*</label>
									<input class="form-control" name="Zip" id="Zip" value="<?php echo $userDetails['zip'];?>" type="text">
									<?php if($errors && isset($errors['Zip'])) { ?>
									<div class="text-danger"><?php echo $errors['Zip'] ?></div>
									<?php } ?>
								</div>

							</div>


							<h2 class="mt-3 mt-md-5">Change Password</h2>

							<div class="form-row">
								<div class="form-group">
									<label>Enter new Password</label>
									<input class="form-control" name="new_password" value="" type="password">
									<?php if($errors && isset($errors['new_password'])) { ?>
										<div class="text-danger"><?php echo $errors['new_password'] ?></div>
									<?php } ?>
								</div>
								<div class="form-group">
									<label>Confirm Password</label>
									<input class="form-control" name="c_password" value="" type="password">
									<?php if($errors && isset($errors['c_password'])) { ?>
										<div class="text-danger"><?php echo $errors['c_password'] ?></div>
									<?php } ?>
								</div>
							</div>

							<button id="update-profile" type="submit" class="btn btn-save-profile"><?= __('store.update_profile') ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>	   
</section>
							

<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
				jQuery('#blah').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).on('click', '.fileUpload span', function(){
		$('#uploadBtn').trigger('click');
	});

	document.getElementById("uploadBtn").onchange = function () {
		readURL(this);
	};

	$('#update-profile').on('click', function(){
		$("#profile-frm").submit();
	});

	$("#profile-frm").submit(function(){
		var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
		is_valid = false;
		var errorInnerHTML = '';
		if ($("#PhoneNumber").val().trim()) {
			if (tel_input.isValidNumber()) {
				is_valid = true;
				$("#phonenumber-input").val("+"+tel_input.selectedCountryData.dialCode + $("#PhoneNumber").val().trim())
			} else {
				var errorCode = tel_input.getValidationError();
				errorInnerHTML = errorMap[errorCode];
			}
		} else {
			errorInnerHTML = 'The Mobile Number field is required.'
		}
		$("#PhoneNumber").parents(".form-group").removeClass("has-error");
		$("#profile-frm .text-danger").remove();

		if(!is_valid){
			$("#PhoneNumber").parents(".form-group").addClass("has-error");
			$(".iti").after("<span class='text-danger'>"+ errorInnerHTML +"</span>");
			return false;
		}
	});
</script>
