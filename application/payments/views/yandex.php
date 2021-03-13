<form method="POST" class="form-horizontal" id="yandex_form">
	<input type="hidden" name="amount" value="<?php echo $amount; ?>" />
    <input type="hidden" name="currency" value="<?php echo $currency; ?>" />
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
</form>
Test
<div class="buttons">
    <div class="pull-right">
        <button type="button" class="btn btn-default" onclick='backCheckout()'>Back</button>
        <input type="button" value="Confirm" id="button-confirm" class="btn btn-primary" />
    </div>
</div>
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
                    $.ajax({
                        url:'<?= base_url("store/callbackfunctions/yandex/createPayment") ?>',
                        type:'POST',
                        dataType:'json',
                        data:$("#yandex_form").serialize(),
                        beforeSend:function(){
                            $this.prop("disabled",1);
                        },
                        complete:function(){
                            $this.prop("disabled",0);
                        },
                        success:function(json){
                            if(json['confirmationUrl']){
                            	window.location.href = json['confirmationUrl']
                            }
                        },
                    });
                }
            },
        });
    })
</script>