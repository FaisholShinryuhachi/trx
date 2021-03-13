<div class="well">
	<div class="form-group">
		<label>Instructions</label>
		<div>
			<?= $setting_data['bank_details'] ?>
		</div>
	</div>

	<div class="text-center">
		<a href="<?= base_url('membership_callback/bank_transfer/doPayment/'. $plan->id) ?>" class="btn btn-primary">Buy Now</a>
	</div>
</div>