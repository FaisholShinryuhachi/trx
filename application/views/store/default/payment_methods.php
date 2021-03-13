<div class="payment-list checkout-payments-wrapper">
	<?php if(!$payment_methods){ ?>
		<div class="alert alert-info">Warning: No Payment options are available. Please contact the store owner for assistance!</div>
	<?php } $i = 0; ?>
	
	<?php foreach ($payment_methods as $key => $method) { ?>
		<a class="payment-method-step <?= ($i == 0)? "active" : ""?>" data-value="<?= $method['code'] ?>" href="javascript:void(0);">
			<img alt="img"  src="<?= base_url($method['icon']); ?>" />
			<p><?= $method['html']?></p>
		</a>
		<input type="radio" name="payment_method" value="<?= $method['code'] ?>" <?= ($i == 0)? "checked" : ""?> style="display:none;">
	<?php $i++; } ?>
</div>
		   
<script type="text/javascript">
	// $(".payment-method-step input[type=radio]").eq(0).prop("checked",1);
	// $(".payment-method-step").eq(0).addClass("active");
	
	$(document).on('click', ".payment-method-step", function(){
		$('.active').removeClass('active');
		$(this).addClass('active');
		$('input[name="payment_method"][value="'+$(this).data('value')+'"]').trigger('click');
	});
</script>