<button class="btn btn-default" onclick='backCheckout()'>Back</button>
<button class="btn btn-primary" id="button-confirm">Confirm</button>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script type="text/javascript">
	$("#button-confirm").click(function(){
		$.ajax({
			url:'<?= base_url("/store/payment_confirmation") ?>',
			type:'POST',
			dataType:'json',
			data:$('[name^="comment"]').serialize(),
			beforeSend:function(){$("#button-confirm").btn("loading");},
			complete:function(){$("#button-confirm").btn("reset");},
			success:function(json){
				$container = $("#checkout-confirm");
				$container.find(".has-error").removeClass("has-error");
				$container.find("span.text-danger").remove();

				if(json['errors']){
					$.each(json['errors']['comment'], function(ii,jj){
					    $ele = $container.find('#comment_textarea'+ ii);
					    if($ele){
					        $ele.parents(".form-group").addClass("has-error");
					        $ele.after("<span class='text-danger'>"+ jj +"</span>");
					    }
					});
				}

				if(json['success']){
					FlutterwaveCheckout({
						public_key: "<?php echo $flutterwave_public_key; ?> ",
						tx_ref: "<?php echo $order_id; ?>",
						amount: <?php echo $amount; ?>,
						currency: "<?php echo $currency; ?>",
						payment_options: "card, mobilemoneyghana, ussd",
						redirect_url: // specified redirect URL
						"<?php echo $status_url; ?>",
						meta: {
							consumer_id: <?php echo $order_id; ?>,
							consumer_mac: "<?php
							echo exec('getmac');
							?>",
					    },
						customer: {
							email: "<?php echo $pay_from_email; ?>",
							phone_number: "<?php echo $phone_number; ?>",
							name: "<?php echo $firstname; ?> <?php echo $lastname; ?>",
						},
						callback: function (data) {
							console.log(data);
						},
						onclose: function() {
							// close modal
						},
						customizations: {
							title: "<?php echo $web_site_title; ?>",
							description: "<?php echo $description; ?>",
							logo: "<?php echo $web_site_logo_link; ?>",
						},
					});
				}
			},
		});
	});
</script>