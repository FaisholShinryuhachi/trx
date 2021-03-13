
<div class="form-group">
	<label class="control-label">Status</label>
	<select class="form-control" name="status">
		<option <?= (int)$setting_data['status'] == '0' ? 'selected' : '' ?> value="0">Disabled</option>
		<option <?= (int)$setting_data['status'] == '1' ? 'selected' : '' ?> value="1">Enabled</option>
	</select>
</div>
<div class="form-group">
	<label class="control-label">Environment</label>
	<select class="form-control" name="environment">
		<option <?= (int)$setting_data['environment'] == '0' ? 'selected' : '' ?> value="0">Test</option>
		<option <?= (int)$setting_data['environment'] == '1' ? 'selected' : '' ?> value="1">Live</option>
	</select>
</div>
<div class="form-group">
	<label class="control-label">Test Key ID</label>
	<input class="form-control" name="test_key_id" value="<?= $setting_data['test_key_id'] ?>">
</div>
<div class="form-group">
	<label class="control-label">Test Key Secret</label>
	<input class="form-control" name="test_key_secret" value="<?= $setting_data['test_key_secret'] ?>">
</div>
<div class="form-group">
	<label class="control-label">Live Key ID</label>
	<input class="form-control" name="live_key_id" value="<?= $setting_data['live_key_id'] ?>">
</div>
<div class="form-group">
	<label class="control-label">Live Key Secret</label>
	<input class="form-control" name="live_key_secret" value="<?= $setting_data['live_key_secret'] ?>">
</div>
<div class="form-group">
	<label class="control-label">Order Success Status</label>
	<select name="order_success_status" class="form-control">
		<?php foreach ($order_status as $order_status_id => $name) { ?>
			<?php if ($order_status_id == $setting_data['order_success_status']) { ?>
				<option value="<?php echo $order_status_id; ?>" selected="selected"><?= $name ?></option>
			<?php } else { ?>
				<option value="<?php echo $order_status_id; ?>"><?= $name ?></option>
			<?php } ?>
		<?php } ?>
	</select>
</div>

<div class="form-group">
	<label class="control-label">Order Failed Status</label>
	<select name="order_failed_status" class="form-control">
		<?php foreach ($order_status as $order_status_id => $name) { ?>
			<?php if ($order_status_id == $setting_data['order_failed_status']) { ?>
				<option value="<?php echo $order_status_id; ?>" selected="selected"><?= $name ?></option>
			<?php } else { ?>
				<option value="<?php echo $order_status_id; ?>"><?= $name ?></option>
			<?php } ?>
		<?php } ?>
	</select>
</div>