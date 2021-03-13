<form action="<?php echo $action; ?>" method="POST" class="form-horizontal" id="paytm_form_redirect">
	<?php foreach($parameters as $k=>$v) { ?>
		<input type="hidden" name="<?php echo $k; ?>" value="<?php echo $v; ?>" />
	<?php } ?>
</form>

<div class="buttons">
	<div class="pull-right">
		<button type="button" class="btn btn-default" onclick='backCheckout()'>Back</button>
		<input type="button" value="Confirm" id="button-confirm" class="btn btn-primary" />
	</div>
</div>

<script type="text/javascript">
	$('#button-confirm').bind('click', function() {
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
					$('#paytm_form_redirect').submit();
				}
            },
        });
	});
</script>