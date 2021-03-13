<?php 
include(APPPATH.'/views/usercontrol/login/multiple_pages/header.php');
$login_content = $theme_settings[0]->login_content;
$login_img = $theme_settings[0]->login_img;
?>

<?php 
if ($login_img != '' || !empty($login_img)) { 
    $image_link =  base_url().'assets/images/theme_images/'.$login_img;
}else{ 
    $image_link =  base_url('assets/login/multiple_pages/img/login-bg.jpg');
} 
?>  
 
    <a href="<?= base_url('/'); ?>" class="btn-orage back-to-home">Back to Homepage</a>


        <div class="login-hero-area d-flex align-items-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 banner-bg" style="background: url('<?php echo  $image_link;?>');">
                    <div class="login-info text-center">
                        <img src="<?= base_url('assets/login/multiple_pages/img/question.png'); ?>" alt="Question">
                        <h1>Don't have an account yet?</h1>
                        <a href="<?= site_url('/register') ?>">Sign Up</a>
                    </div>
                </div>
                <div class="col-lg-6 form-gray-bg">
                    <div class="form-inner">
                       <div class="row justify-content-center">
                           <div class="col-lg-6">
                                <div class="login-form text-center">
                                    <div class="logo"><img src="<?= $logo; ?>" alt="Logo"></div>
                                    <form id="login-form" autocomplete="off">
                                        <div class="form-group input-group">
                                            <span class="input-group-prepend">
                                                <div class="input-group-text"><i class="user-icon"></i></div>
                                            </span>
                                            <input class="form-control py-2" type="text" name="username" placeholder="<?= __('user.username') ?>" autocomplete="off">
                                        </div>                                    
                                        <div class="form-group input-group">
                                            <span class="input-group-prepend">
                                                <div class="input-group-text"><i class="password-icon"></i></div>
                                            </span>
                                            <input class="form-control py-2" type="password" name="password" placeholder="*************" autocomplete="off">
                                        </div>
                                        <?php if (isset($googlerecaptcha['affiliate_login']) && $googlerecaptcha['affiliate_login']) { ?>
                                        <div class="captch mb-3">
                                            <script src='https://www.google.com/recaptcha/api.js'></script>
                                            <div class="g-recaptcha" data-sitekey="<?= $googlerecaptcha['sitekey'] ?>"></div>
                                        </div>
                                        <?php } ?>
                                        <input class="btn-submit" type="submit" value="<?= __('user.login') ?>">
                                    </form>
                                    <a href="<?= base_url('/forget-password') ?>">Forgot your password?</a>
                                </div>
                           </div>
                       </div>
                       <div class="form-description text-center" id="scrollbar">
                            <p><?= (!empty($login_content)) ? $login_content : "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";?></p>
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
    var grecaptcha = undefined;
    $('#login-form').on('submit',function(){
    $this = $(this);
    $.ajax({
    url:'<?= base_url('auth/login') ?>',
    type:'POST',
    dataType:'json',
    data: $this.serialize() + '&type=user',
    beforeSend:function(){ $this.find(".btn-submit").btn("loading"); },
    complete:function(){ $this.find(".btn-submit").btn("reset"); },
    success:function(json){
    $this.find(".is-invalid").removeClass("is-invalid");
    $this.find(".has-error").removeClass("has-error");
    $this.find("span.invalid-feedback").remove();
    if(json['errors']){
    $.each(json['errors'], function(i,j){
    if(i == 'captch_response' && grecaptcha){ grecaptcha.reset(); }
    $ele = $this.find('[name="'+ i +'"]');
    if($ele){
    $formGroup = $ele.parents(".form-group");
    $ele.addClass("is-invalid");
    if($formGroup.find(".input-group").length){
    $formGroup.find(".input-group").after("<span class='invalid-feedback'>"+ j +"</span>");
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