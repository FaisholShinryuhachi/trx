<?php if (isset($plan)) { ?>
	<div class="text-center">
		<button onclick="payWithPaypal()" type="button" class="btn btn-primary">Pay with paypal</button>
	</div>

	<script type="text/javascript">
		function payWithPaypal(){
			Swal.fire({
				title: 'Are you sure?',
				text: "Are you sure to pay with paypal ?",
				icon: 'info',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Pay!'
			}).then((result) => {
				if(result.value){
					window.location.href='<?= base_url('membership_callback/paypal/doPayment/'. $plan['id']) ?>';
				}
			})
		}
	</script>
<?php } ?>