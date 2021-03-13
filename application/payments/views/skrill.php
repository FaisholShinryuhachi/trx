<form action="<?php echo $action; ?>" method="post">
    <input type="hidden" name="pay_to_email" value="<?php echo $pay_to_email; ?>" />
    <input type="hidden" name="recipient_description" value="<?php echo $description; ?>" />
    <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>" />
    <input type="hidden" name="return_url" value="<?php echo $return_url; ?>" />
    <input type="hidden" name="cancel_url" value="<?php echo $cancel_url; ?>" />
    <input type="hidden" name="status_url" value="<?php echo $status_url; ?>" />
    <input type="hidden" name="language" value="<?php echo $language; ?>" />
    <input type="hidden" name="logo_url" value="<?php echo $logo; ?>" />
    <input type="hidden" name="pay_from_email" value="<?php echo $pay_from_email; ?>" />
    <input type="hidden" name="firstname" value="<?php echo $firstname; ?>" />
    <input type="hidden" name="lastname" value="<?php echo $lastname; ?>" />
    <input type="hidden" name="address" value="<?php echo $address; ?>" />
    <input type="hidden" name="address2" value="<?php echo $address2; ?>" />
    <input type="hidden" name="phone_number" value="<?php echo $phone_number; ?>" />
    <input type="hidden" name="postal_code" value="<?php echo $postal_code; ?>" />
    <input type="hidden" name="city" value="<?php echo $city; ?>" />
    <input type="hidden" name="state" value="<?php echo $state; ?>" />
    <input type="hidden" name="country" value="<?php echo $country; ?>" />
    <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
    <input type="hidden" name="currency" value="<?php echo $currency; ?>" />
    <input type="hidden" name="detail1_text" value="<?php echo $detail1_text; ?>" />
    <input type="hidden" name="merchant_fields" value="order_id" />
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
    <input type="hidden" name="platform" value="" />
    <div class="buttons">
        <div class="pull-right">
            <button type="button" class="btn btn-default" onclick='backCheckout()'>Back</button>
            <input type="submit" id="btn-confirm" value="Confirm" class="btn btn-primary" style="display: none;" />
            <button class="btn btn-primary" id="button-confirm">Confirm</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $("#button-confirm").click(function(){
        $this = $(this);

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
                    $('#btn-confirm').trigger('click');
                }
            },
        });
    })
</script>
