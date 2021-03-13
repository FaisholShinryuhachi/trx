<section class="profile-page">
	<div class="container">
		<div class="profile-page-wrapper">
			<div class="profile-sidebar">
				<h3>User Menu</h3>
				<ul>
					<li><a href="<?= $base_url ?>profile"><?= __('store.profile') ?></a></li>
					<li><a href="<?= $base_url ?>order"><?= __('store.order') ?></a></li>
					<li><a class="active" href="<?= $base_url ?>shipping"><?= __('store.shipping') ?></a></li>
					<li><a href="<?= $base_url ?>wishlist">Wishlist</a></li>
					<li><a href="<?= $base_url ?>logout"><?= __('store.logout') ?></a></li>
				</ul>
			</div>

			<div class="profile-main">
				<form action="<?php echo base_url('store/shipping') ?>" class="form-horizontal" method="post" id="profile-frm" enctype="multipart/form-data">
					<h2><?= __('store.shipping_details') ?></h2>
					<div class="form-checkout-wrapper">
						<div class="checkout-form">

							<div class="form-row">
								<div class="form-group">
									<label class="control-label"><?= __('store.country') ?></label>
									<?php $selected =  isset($shipping) ? $shipping['country_id'] : '' ?>
									<select class="custom-select form-control" name="country">
										<?php foreach ($country as $key => $value) { ?>
											<option <?= $selected == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->name ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label"><?= __('store.state') ?></label>
									<select class="custom-select form-control" name="state"></select>
								</div>
								<div class="form-group">
									<label class="control-label"><?= __('store.city') ?></label>
									<input class="form-control" name="city" type="text" value="<?= isset($shipping) ? $shipping['city'] : '' ?>">
									<?php if($errors && isset($errors['city'])) { ?>
									<div class="text-danger"><?php echo $errors['city'] ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group">
									<label class="control-label"><?= __('store.postal_code') ?></label>
									<input class="form-control" name="zip_code" type="text" value="<?= isset($shipping) ? $shipping['zip_code'] : '' ?>">
									<?php if($errors && isset($errors['zip_code'])) { ?>
									<div class="text-danger"><?php echo $errors['zip_code'] ?></div>
									<?php } ?>
								</div>
								<div class="form-group">
									<label class="control-label"><?= __('store.phone_number') ?></label>
									<input class="form-control" name="phone" type="text" value="<?= isset($shipping) ? $shipping['phone'] : '' ?>">
									<?php if($errors && isset($errors['phone'])) { ?>
									<div class="text-danger"><?php echo $errors['phone'] ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group">
									<label class="control-label"><?= __('store.full_address') ?></label>
									<textarea class="form-control" name="address"><?= isset($shipping) ? $shipping['address'] : '' ?></textarea>
									<?php if($errors && isset($errors['address'])) { ?>
									<div class="text-danger"><?php echo $errors['address'] ?></div>
									<?php } ?>
								</div>
							</div>
							<button class="btn btn-save-profile" id="update-profile" type="submit"><?= __('client.update_shipping') ?></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>	   
</section>

<script type="text/javascript">
	var selected_state = '<?= isset($shipping) ? $shipping['state_id'] : '' ?>';
	$(document).delegate('[name="country"]',"change",function(){
		$this = $(this);
		$.ajax({
			url:'<?= base_url('store/getState') ?>',
			type:'POST',
			dataType:'json',
			data:{id:$this.val()},
			beforeSend:function(){$this.prop("disabled",true);},
			complete:function(){$this.prop("disabled",false);},
			success:function(json){
				var html = '';
				$.each(json['states'], function(i,j){
					var s = '';
					if(selected_state && selected_state == j['id']){
						s = 'selected';selected_state = 0;
					}
					html += "<option "+ s +" value='"+ j['id'] +"'>"+ j['name'] +"</option>";
				})
				$('[name="state"]').html(html);
			},
		})
	})

	$('[name="country"]').trigger("change");
</script>
