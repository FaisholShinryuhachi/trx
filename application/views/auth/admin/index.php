
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin Login</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Mannatthemes" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if($setting['favicon']){ ?>
        <link rel="icon" href="<?php echo base_url('assets/images/site/'.$setting['favicon']) ?>" type="image/*" sizes="16x16">
    <?php } ?>

    <!--  CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/'); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin/'); ?>fonts/stylesheet.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin/'); ?>css/style.css">

    <title>Admin Login</title>
  </head>
  <body>
  
<div class="login-main">
  <div class="login-wrapper">
        <div class="login-form">
            <?php $logo = $setting['logo'] ? base_url('assets/images/site/'. $setting['logo'] ) : base_url('assets/admin/img/logo.png'); ?>
            <img src="<?= $logo ?>" class="img-fluid img-logo" alt="Logo">
            <form class="form-login">
                <input name="type" type="hidden" value="admin"/>
                <div class="form-group">
                    <input type="text" placeholder="Username" name="username" required>
                    <span></span>
                    <img src="<?= base_url('assets/admin/'); ?>img/user.png" alt="icon">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" name="password" required>
                    <span></span>
                    <img src="<?= base_url('assets/admin/'); ?>img/password.png" alt="icon">
                </div>
                <script type="text/javascript">
                    var grecaptcha = undefined;
                </script>
                <?php 
                    $db =& get_instance(); 
                    $googlerecaptcha =$db->Product_model->getSettings('googlerecaptcha');
                ?>
                <?php if (isset($googlerecaptcha['admin_login']) && $googlerecaptcha['admin_login']) { ?>
                    <div class="captch">
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="g-recaptcha" data-sitekey="<?= $googlerecaptcha['sitekey'] ?>"></div>
                        <input type="hidden" name="captch_response" id="captch_response"> <br><br>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <input type="submit" class="btn btn-loginsbt" value="Log In">
                </div>
                <a href="javascript:void(0)" onclick="_open('forget-form')" class="forgotpass">Forgot your password?</a>
            </form>

            <form class="forget-form" style="display:none;">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Enater Your Email Address" required>
                    <span></span>
                    <img src="<?= base_url('assets/admin/'); ?>img/user.png" alt="icon">
                </div>
                
                
                <div class="form-group">
                    <input type="submit" class="btn btn-loginsbt" value="Forgot Password">
                </div>
                <a href="javascript:void(0)" onclick="_open('form-login')" class="forgotpass">Back to Login</a>
            </form>
  </div>
</div>  
  
  
<script src="<?= base_url('assets/admin/'); ?>js/jquery.min.js"></script>
<script src="<?= base_url('assets/admin/'); ?>js/bootstrap.min.js" ></script>
<script type="text/javascript">
            function _open(form) {
                $(".form-login, .forget-form").hide();
                $("."+form).show();
            }

            $('.form-login').on('submit',function(){
                var check = true;
                var inputLogin = $('.form-login');
                
                if (check) {
                    var check_captch = true;
                    if (grecaptcha === undefined) {
                        check_captch = false;
                    }

                    $("#captch_response").val('')

                    if(check_captch){
                      captch_response = grecaptcha.getResponse();
                      $("#captch_response").val(captch_response)
                    }

                    $.ajax({
                        url:'<?= base_url('auth') ?>/login',
                        type:'POST',
                        dataType:'json',
                        data: $('.form-login').serialize(),
                        beforeSend:function(){ $('.form-login button').prop("disabled",true); },
                        complete:function(){ $('.form-login button').prop("disabled",false); },
                        success:function(json){
                            $container = inputLogin;
                            $container.find(".has-error").removeClass("has-error");
                            $container.find("span.text-danger,.alert").remove();
                            
                            if(json['errors']){
                                $.each(json['errors'], function(i,j){
                                    if(i == 'captch_response' && grecaptcha){ grecaptcha.reset(); }
                                    $ele = $container.find('[name="'+ i +'"]');
                                    if($ele){
                                        $ele.addClass("has-error");
                                        $ele.parent().before("<div class='alert alert-danger mb-3'>"+ j +"</div>");
                                    }
                                })
                            }

                            <?php 
                            if(isset($update_version_outside)) {
                                ?>
                                if(json['redirect']){
                                    window.location = '<?= base_url('update'); ?>';
                                }
                                <?php
                            } else {
                                ?>
                                if(json['redirect']){
                                    window.location = json['redirect'];
                                }
                                <?php
                            }
                            ?>
                        },
                    })
                }

                return false;
            });

            $('.forget-form').on('submit',function(){
              
                $.ajax({
                    url:'<?= base_url('auth') ?>/forget',
                    type:'POST',
                    dataType:'json',
                    data: $('.forget-form').serialize(),
                    beforeSend:function(){ $('.forget-form button').prop("disabled",true); },
                    complete:function(){ $('.forget-form button').prop("disabled",false); },
                    success:function(json){
                        
                        $container = $('.forget-form');
                        $container.find(".has-error").removeClass("has-error");
                        $container.find("span.text-danger,.alert").remove();
                        
                        if(json['errors']){
                            $.each(json['errors'], function(i,j){
                                $ele = $container.find('[name="'+ i +'"]');
                                if($ele){
                                    $ele.addClass("has-error");
                                    $ele.parent().before("<div class='alert alert-danger mb-3'>"+ j +"</div>");
                                }
                            })
                        }

                        if(json['success']){
                            $('.forget-form').prepend("<div class='alert alert-success'>"+ json['success'] +"</div>");
                        }

                        if(json['redirect']){
                            window.location = json['redirect'];
                        }
                    },
                })
                
                return false;
            });
        </script>
  </body>
</html>