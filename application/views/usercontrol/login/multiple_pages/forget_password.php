<?php include(APPPATH.'/views/usercontrol/login/multiple_pages/header.php'); ?>
    <a href="<?= base_url('/'); ?>" class="btn-orage back-to-home">Back to Homepage</a>
    <div class="login-hero-area forgat-password-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 banner-bg" style="background: url(<?= base_url('assets/login/multiple_pages') ?>/img/forgat.png);">
                </div>
				<div class="col-lg-6 form-gray-bg">
					<div class="form-inner w-100">
                       <div class="row justify-content-center">
                           <div class="col-lg-6">
								<div class="login-form register-form text-center">
                                    <div class="logo"><div class="logo mt-4"><img src="<?= $logo; ?>" alt="Logo"></div></div>
                                    <form class="reset-password-form">
                                        <div class="form-group">
                                            <input class="form-control" name="email" placeholder="<?= __('user.email') ?>" type="email">
                                        </div>  
										<div class="form-group">
                                            <p><?= __('user.Please_enter_your_email_address_and_we_will_send_you_a_password_password_link') ?></p>
                                        </div>                                        
                                        <input class="btn-submit" type="submit" value="<?= __('user.send_reset_link') ?>">
                                    </form>
                                </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php include(APPPATH.'/views/usercontrol/login/multiple_pages/footer.php'); ?>
<script type="text/javascript">
	(function ($) {
        $.fn.btn = function (action) {
            var self = $(this);
            if (action == 'loading') { $(self).addClass("btn-loading"); }
            if (action == 'reset') { $(self).removeClass("btn-loading"); }
        }
    })(jQuery);
    
    $('.reset-password-form').on('submit',function(){
        $this = $(this);
        $.ajax({
            url:'<?= base_url('auth/forget') ?>',
            type:'POST',
            dataType:'json',
            data: $this.serialize(),
            beforeSend:function(){ $this.find(".btn-submit").btn("loading"); },
            complete:function(){ $this.find(".btn-submit").btn("reset"); },
            success:function(json){
                $this.find(".is-invalid").removeClass("is-invalid");
                $this.find("span.invalid-feedback,.success-msg").remove();

                if(json['success']){
                    $this.find(".btn-submit").before("<div class='alert success-msg alert-success'> " + json['success'] + "</div>");
                }
                if(json['errors']){
                    $.each(json['errors'], function(i,j){
                        if(i == 'captch_response' && grecaptcha){ grecaptcha.reset(); }
                        $ele = $this.find('[name="'+ i +'"]');
                        if($ele){
                            $formGroup = $ele.parents(".form-group");
                            $ele.addClass("is-invalid");
                            if($formGroup.find(".input-group").length){
                                $formGroup.find(".input-group").after("<span class='bg-white d-block invalid-feedback'>"+ j +"</span>");
                            } else {
                                $ele.after("<span class='invalid-feedback'>"+ j +"</span>");
                            }
                        }
                    })
                }
                if(json['redirect']){ window.location = json['redirect']; }
            },
        })
        return false;
    });
</script>