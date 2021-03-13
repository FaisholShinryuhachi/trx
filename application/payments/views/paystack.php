<button class="btn btn-default" onclick='backCheckout()'>Back</button>
<button class="btn btn-primary" id="button-confirm">Confirm</button>
<div class="paystack-loader">Loading...</div>
<h2><p id="show_result" style="color:red"></p></h2>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="https://js.paystack.co/v1/inline.js"></script>
<style type="text/css">
    .paystack-loader {
        display: none;
        z-index: 2147483647;
        background: rgba(0, 0, 0, 0.75);
        border: 0px none transparent;
        overflow: hidden;
        margin: 0px;
        padding: 0px;
        -webkit-tap-highlight-color: transparent;
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        transition: opacity 0.3s ease 0s;
        visibility: visible;
        color: #fff;
        padding-top: 100px;
        text-align: center;
        font-size: 39px;
    }
</style>
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
                        url:'<?= base_url("/store/confirm_payment") ?>',
                        type:'POST',
                        data:{
                            payment_method: $('input[name="payment_method"]:checked').val()
                        },
                        dataType:'json',
                        beforeSend:function(){
                            $this.prop("disabled",1);
                        },
                        complete:function(){
                            $this.prop("disabled",0);
                        },
                        success:function(json){
                            token_val = json['api_token'];
                            email_val = json['email'];
                            amt = json['amt'];
                            orderId = json['orderId'];

                            payWithPaystack(token_val,email_val,amt,orderId);
                        },
                    });
                }
            },
        });
    })

    function payWithPaystack(token_val,email,amt,orderId){
        var amt = amt;
        var handler = PaystackPop.setup({
        //key: 'pk_test_963b5a0776710267c531365efb9ca717c37e58e6',
        key: token_val,
        email: email,
        amount: amt,
        currency: "NGN",
        ref: ''+Math.floor((Math.random() * 1000000000) + 1),
        metadata: {
            custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
            ]
        },
        callback: function(response){
            $("#show_result").text('Please wait while are are updating data');
            $.ajax({
                url:'<?= base_url("store/callbackfunctions/paystack/update") ?>',
                type:'POST',
                dataType:'json',
                data:{orderId:orderId, reference:response.reference}, 
                beforeSend:function(){$(".paystack-loader").show()},
                complete:function(){},
                success:function(json){
                    if(json['redirect']){window.location = json['redirect'];}
                    if(json['warning']){
                        $(".paystack-loader").hide();
                        alert(json['warning'])
                    }
                },
        })
        },
        onClose: function(){
            alert('window closed');
        }
    });
        handler.openIframe();
    }


</script>

