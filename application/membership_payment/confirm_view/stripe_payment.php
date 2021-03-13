<?php if (isset($plan)) { ?>

	<div class="text-center">

		<button onclick="payWithStripe()" type="button" class="btn btn-primary">Pay with Stripe</button>

	</div>



	<script type="text/javascript">

		function payWithStripe(){

			Swal.fire({

				title: 'Are you sure?',

				text: "Are you sure to pay with Stripe ?",

				icon: 'info',

				showCancelButton: true,

				confirmButtonColor: '#3085d6',

				cancelButtonColor: '#d33',

				confirmButtonText: 'Yes, Pay!'

			}).then((result) => {

				if(result.value){

					window.location.href='<?= base_url('membership_callback/stripe_payment/doPayment/'. $plan['id']) ?>';

				}

			})

		}

	</script>

<?php } ?>