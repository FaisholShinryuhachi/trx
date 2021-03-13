<div class="form-group">
	<label class="control-label">Status</label>
	<select class="form-control" name="status">
		<option <?= (int)$setting_data['status'] == '0' ? 'selected' : '' ?> value="0">Disabled</option>
		<option <?= (int)$setting_data['status'] == '1' ? 'selected' : '' ?> value="1">Enabled</option>
	</select>
</div>


<div class="form-group">
	<label class="control-label"><span data-toggle="tooltip" title="" data-original-title="Enter your Paystack Public Key">Paystack Public Key</span></label>
	<input class="form-control" name="public_key" value="<?= $setting_data['public_key'] ?>">
</div>




<div class="form-group">
	<label class="control-label"><span data-toggle="tooltip" title="" data-original-title="Order status that will set for Successful Payment">Order Success Status</span></label>
	<select name="order_success_status_id" class="form-control">
		<?php foreach ($order_status as $order_status_id => $name) { ?>
			<?php if ($order_status_id == $setting_data['order_success_status_id']) { ?>
				<option value="<?php echo $order_status_id; ?>" selected="selected"><?= $name ?></option>
			<?php } else { ?>
				<option value="<?php echo $order_status_id; ?>"><?= $name ?></option>
			<?php } ?>
		<?php } ?>
	</select>
</div>

<div class="form-group">
	<label class="control-label"><span data-toggle="tooltip" title="" data-original-title="Order status that will set for Failed Payment" aria-describedby="tooltip372536">Order Failed Status</span></label>
	<select name="order_failed_status_id" class="form-control">
		<?php foreach ($order_status as $order_status_id => $name) { ?>
			<?php if ($order_status_id == $setting_data['order_failed_status_id']) { ?>
				<option value="<?php echo $order_status_id; ?>" selected="selected"><?= $name ?></option>
			<?php } else { ?>
				<option value="<?php echo $order_status_id; ?>"><?= $name ?></option>
			<?php } ?>
		<?php } ?>
	</select>
</div>