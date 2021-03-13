<?php 
if (isset($error)) { echo $error; }else{ ?>
<?php if ($setting_data['sandbox_mode']) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> Test mode is on</div>
<?php } ?>

<form action="<?php echo $action; ?>" method="post">
    <div class="buttons">
      <div class="pull-right">
        <button class="btn btn-default" onclick='backCheckout()'>Back</button>
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
<?php } ?>
