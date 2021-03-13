<?php if($allow_shipping) { ?>

<div class="shipping-warning"></div>
<div class="form-row">
	<div class="form-group">
		<label>Country</label>
		<?php $selected =  isset($shipping) ? $shipping->country_id : '' ?>
		<select name="country" class="custom-select form-control">
			<option value="">Select Country</option>
			<?php foreach ($countries as $key => $value) { ?>
				<option <?= $selected == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->name ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>State</label>
		<select name="state" class="custom-select form-control">
		</select>
	</div>
	<div class="form-group">
		<label>City</label>
		<input type="text" placeholder="City" name="city" class="form-control" type="text" value="<?= isset($shipping) ? $shipping->city : '' ?>">
	</div>
</div>
								
<div class="form-row">
	<div class="form-group">
		<label>Postal Code</label>
		<input class="form-control" name="zip_code" placeholder="Postal Code" type="text" value="<?= isset($shipping) ? $shipping->zip_code : '' ?>">
	</div>
	<div class="form-group">
		<label>Phone Number</label>
		<input class="form-control" name="phone" placeholder="Phone Number" type="text" value="<?= isset($shipping) ? $shipping->phone : '' ?>">
	</div>
</div>
<div class="form-row">
	<div class="form-group">
		<label>Full Address</label>
		<textarea class="form-control" placeholder="Full Address" name="address"><?= isset($shipping) ? $shipping->address : '' ?></textarea>
	</div>
</div>


<script type="text/javascript">
	var selected_state = '<?= isset($shipping) ? $shipping->state_id : '' ?>';
	//var selected_state = 0;
	$('[name="country"]').trigger("change");
</script>
<?php } else { ?>
	<?php if($show_blue_message){ ?>
		<div class="alert alert-info"><?= __('store.shipping_not_allows') ?></div>
	<?php } ?>
<?php } ?>