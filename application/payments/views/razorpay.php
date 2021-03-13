<?php 
if (isset($error)) { echo $error; }else{ ?>

 <button class="btn btn-default" onclick='backCheckout()'>Back</button>
<button class="btn btn-primary" id="button-confirm">Confirm</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


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
                    var options = {
                        "key": "<?php echo $razorpay_key_id;?>", 
                        "amount": "<?php echo 100 * $amount;?>",
                        "currency": "<?php echo  $currency;?>",
                        "name": "<?php echo $firstname; ?> <?php echo $lastname; ?>",
                        "description": "<?php echo $description; ?>",
                        "image": "<?php echo $web_site_logo_link; ?>",
                        "order_id": "<?php echo $razorpay_id; ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "callback_url": "<?php echo $status_url; ?>",
                        "prefill": {
                            "name": "<?php echo $firstname; ?> <?php echo $lastname; ?>",
                            "email": "<?php echo $pay_from_email; ?>",
                            "contact": "<?php echo $phone_number; ?>"
                        },
                        "notes": {
                            "address": "<?php echo str_replace("\n", "", $address); ?>"
                        },
                        "theme": {
                            "color": "#F37254"
                        }
                    };
                    var rzp1 = new Razorpay(options);
            		rzp1.open();
                }
            },
        });
	});
</script>
<?php } ?>
