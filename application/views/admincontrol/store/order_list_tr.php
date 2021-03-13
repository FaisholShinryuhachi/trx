<?php foreach($orders as $order){ ?>
	<tr>
		<td><?php echo $order['id'];?></td>
		<td class="txt-cntr"><?php echo c_format($order['total_sum']); ?></td>
		<td class="txt-cntr order-status"><?php echo $status[$order['status']]; ?></td>
		<td class="txt-cntr"><?php echo str_replace("_", " ", $order['payment_method']) ?></td>
		<td class="txt-cntr">
			<img style="width: 20px;margin: 0 10px;" src="<?= base_url('assets/vertical/assets/images/flags/'. strtolower($order['country_code'])).'.png' ?>" /> IP: <?= $order['ip'] ?>
			</td>
		<td class="txt-cntr"><?php echo $order['txn_id'];?></td>
		<td>
			<div class="badge <?php if($order['status'] == 1){ ?>badge-success<?php }else{ ?>badge-warning<?php } ?>"><?= $status[$order['status']] ?></div>
			<!-- <div class="wallet-status-switch m-0" style="width: 150px">
				<div class="radio radio-inline">
					<label><input type="radio" <?= $order['status'] == 1 ? 'checked' : '' ?> class="status-change-rdo" name="status_<?= $order['id'] ?>" data-id='<?= $order['id'] ?>' value="1" ><span>Complete</span></label>
				</div>
				<div class="radio radio-inline loading">
					<img src="<?=  base_url('assets/images/switch-loading.svg') ?>">
				</div>
				<?php if($order['status'] == 7 || $order['status'] == 1) { ?>
					<div class="radio radio-inline">
						<label><input type="radio" <?= $order['status'] == 7 ? 'checked' : '' ?> class="status-change-rdo" name="status_<?= $order['id'] ?>" data-id='<?= $order['id'] ?>' value="7" ><span>Processed</span></label>
					</div>
				<?php } else { ?>
					<div class="radio radio-inline">
						<label><input type="radio" checked class="status-change-rdo" name="status_<?= $order['id'] ?>" data-id='<?= $order['id'] ?>' value="<?= $order['status'] ?>" ><span><?= $status[$order['status']] ?></span></label>
					</div>
				<?php } ?>
			</div> -->
		</td>
		<td>
			<a href="<?= base_url('admincontrol/vieworder/'. $order['id']) ?>" class="btn btn-primary btn-sm"><?= __('admin.details') ?></a>
		</td>
	</tr>
<?php } ?>
<tr>
    <td colspan="8" class="text-right">
        <ul class="pagination pagination-td"><?= $pagination ?></ul>
    </td>
</tr>