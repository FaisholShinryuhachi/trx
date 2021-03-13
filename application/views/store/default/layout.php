<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <meta name="author" content=""/>
    
    <meta property='og:url' content='<?= $_SERVER['REQUEST_URI']; ?>'/>
    <?php if(isset($meta_title)){ ?> <meta property="og:title" content="<?php echo $meta_title ?>"/><?php } ?>
    <?php if(isset($meta_description)){ ?> 
      <meta name="description" content="<?php echo $meta_description ?>"/>
      <meta property="og:description" content="<?php echo $meta_description ?>"/>
    <?php } ?>
    <?php if(isset($meta_image)){ ?> <meta property="og:image" content="<?php echo $meta_image ?>"/><?php } ?>
    <?php 
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
    <meta property="og:url" content="<?= $actual_link ?>"/>
    <meta name="twitter:card" content="summary_large_image"/>

    <?php if($store_setting['favicon']){ ?>
        <link rel="icon" href="<?= base_url('assets/images/site/'.$store_setting['favicon']) ?>" type="image/*" sizes="16x16">
    <?php } ?>

    <title><?= $store_setting['name'] ?>  <?= isset($meta_title) ? '- ' . $meta_title : '' ?></title>

    <!--  CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/store/default/'); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/store/default/'); ?>fonts/fonts.css" />
    <link rel="stylesheet" href="<?= base_url('assets/store/default/'); ?>fonts/fonts.css" />
    <link rel="stylesheet" href="<?= base_url('assets/store/default/'); ?>css/placeholder-loading.css" />
    <link rel="stylesheet" href="<?= base_url('assets/store/default/'); ?>css/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/store/default/'); ?>css/nouislider.css" />
    <link rel="stylesheet" href="<?= base_url('assets/store/default/'); ?>css/style.css" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <script src="<?= base_url('assets/store/default/'); ?>js/jquery-3.5.1.slim.min.js"></script>
    <script src="<?= base_url('assets/store/default/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/store/default/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/plugins/store/') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/plugins/store/') ?>jquery.star-rating-svg.js"></script>
    <script src="<?= base_url('assets/store/default/') ?>js/nouislider.min.js"></script>
    <script src="<?= base_url('assets/store/default/') ?>js/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/plugins/') ?>mustache.js"></script>
    
    <script type="text/javascript">
      try {
          <?php 
          if($store_setting['google_analytics'] != ''){
            $ana = preg_replace('/<script>/', '', $store_setting['google_analytics']);
            $ana = preg_replace('/<\/script>/', '', $ana);
            echo $ana;
          } 
          ?>
      } catch (error) {
        console.log(error);
      }
    </script>

    <?php 
    $global_script_status = (array)json_decode($SiteSetting['global_script_status'],1);
    if(in_array('store', $global_script_status)){
        echo $SiteSetting['global_script'];
    }
    ?>

    <script type="text/javascript">
        (function ($) {
            $.fn.btn = function (action) {
                var self = $(this);
                if (action == 'loading') {
                    if ($(self).attr("disabled") == "disabled") {
                      //e.preventDefault();
                    }
                    $(self).attr("disabled", "disabled");
                    $(self).attr('data-btn-text', $(self).html());
                    $(self).html('<i class="fa fa-spinner fa-spin"></i>&nbsp;' + $(self).text());
                }
                if (action == 'reset') {
                    $(self).html($(self).attr('data-btn-text'));
                    $(self).removeAttr("disabled");
                }
            }
        })(jQuery);
        var formDataFilter = function(formData) {
            if (!(window.FormData && formData instanceof window.FormData)) return formData
            if (!formData.keys) return formData
            var newFormData = new window.FormData()
            Array.from(formData.entries()).forEach(function(entry) {
                var value = entry[1]
                if (value instanceof window.File && value.name === '' && value.size === 0) {
                    newFormData.append(entry[0], new window.Blob([]), '')
                } else {
                    newFormData.append(entry[0], value)
                }
            });
            return newFormData;
        }
    </script>

    <?php if (is_rtl()) { ?>
      <!-- place here your RTL css code -->
    <?php } ?>
</head>

<body>

<?php 
$fbmessager_status = (array)json_decode($SiteSetting['fbmessager_status'],1);
if(in_array('store', $fbmessager_status)){
    echo $SiteSetting['fbmessager_script'];
}
?>
      
<?php 
if(isset($store_setting['notification']) && sizeOf(json_decode($store_setting['notification']) > 0) && !empty(json_decode($store_setting['notification'])[0])) { 
?>
<!-- Top notification bar -->
<div class="top-bar bg-main text-white text-center">
  <div class="container">
    <img alt="image" src="<?= base_url('assets/store/default/'); ?>img/top-icon.png" /> <?= json_decode($store_setting['notification'])[0]; ?>
  </div>
</div>
<?php
} else {
?>
<!-- Dummy Top notification bar -->
<div class="top-bar bg-main text-white text-center">
  <div class="container">
    <img alt="image" src="<?= base_url('assets/store/default/'); ?>img/top-icon.png" /> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
  </div>
</div>
<?php  
}
?>
    <!-- Header  -->
	<div class="headerbar"></div>
    <header id="myHeader">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <?php  $logo = ($store_setting['logo']) ? base_url('assets/images/site/'.$store_setting['logo']) : base_url('assets/store/default/').'img/logo.png'; ?>
                <a class="navbar-brand" href="<?= $home_link ?>"><img alt="image" src="<?= $logo ?>" height="36" onerror="this.src='<?=base_url('assets/store/default/').'img/logo.png'?>';"/></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><img src="<?= base_url('assets/store/default/'); ?>img/menu.png" class="img-toggler" alt="menu"></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item <?= ($page == 'home') ? 'active' : ''; ?>"><a href="<?= $home_link ?>" class="nav-link"><?= __('store.products') ?></a></li>
                        <li class="nav-item <?= ($page == 'product'||$page == 'product_list'|| $page == 'category') ? 'active' : ''; ?>"><a href="<?= $base_url ?>category" class="nav-link">Categories</a></li>
                        <li class="nav-item <?= ($page == 'about') ? 'active' : ''; ?>"><a href="<?= $base_url ?>about" class="nav-link"><?= __('store.about') ?></a></li>
                        <li class="nav-item <?= ($page == 'contact') ? 'active' : ''; ?>"><a href="<?= $base_url ?>contact" class="nav-link"><?= __('store.contact') ?></a></li>
                    </ul>

                    <div class="header-right-listing">
                        <ul class="d-flex">
                            <li><div class="dropdown"><?= $CurrencyHtml ?></div></li>
                            <li><div class="dropdown"><?= $LanguageHtml ?></div></li>

                            <?php if($is_logged){ ?>
                              <div class="dropdown">
                                <?php 
                                $avatar = $client['avatar'] != '' ? base_url('assets/images/users/'. $client['avatar']) : base_url('assets/store/default/img/blog1.png');
                                ?>
                                <a href="javascript::void(0)" class="js-link2">
                                  <img alt="image" src="<?= $avatar; ?>" class="mr-1" width="24" height="24"/>
                                </a>
                                <ul class="js-dropdown-list2">
                                  <li class="d-flex"><a class="text-dark" href="<?php echo $base_url ?>profile"><i class="fa fa-user"></i> &nbsp;&nbsp;<?= __('store.profile') ?></a></li>
                                  <li class="d-flex"><a class="text-dark" href="<?php echo $base_url ?>order"><i class="fa fa-gift"></i> &nbsp;&nbsp;<?= __('store.order') ?></a></li>
                                  <li class="d-flex"><a class="text-dark" href="<?php echo $base_url ?>shipping"><i class="fa fa-truck"></i> &nbsp;&nbsp;<?= __('store.shipping') ?></a></li>
                                  <li class="d-flex"><a class="text-dark" href="<?php echo $base_url ?>wishlist"><i class="fa fa-heart  "></i> &nbsp;&nbsp;Wishlist</a></li>
                                  <li class="d-flex"><a class="text-dark" href="<?php echo $base_url ?>logout"><i class="fa fa-power-off"></i> &nbsp;&nbsp;<?= __('store.logout') ?></a></li>
                                </ul>
                              </div>
                            </li>
                            <?php } else { ?>
                              <li><a href="<?php echo $base_url ?>login" class="top-login-btn btn bg-main2 text-white d-flex align-items-center"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/signin.png" class="mr-2" /><?= __('store.login') ?></a></li>
                            <?php } ?>
                            

                            <li class="d-flex align-items-center position-relative cart-top">
                                <img alt="image" src="<?= base_url('assets/store/default/'); ?>img/cart.png" /><span>My cart <small id="cart-sub-total" class="d-block"></small></span>
                                <span class="cart-count position-absolute">0</span>
                                <div class="cart-dropdown">
                                    <div class="cart-empty">
                                        <img src="<?= base_url('assets/store/default/'); ?>img/cart-icon-empty.png" alt="Icon">
                                        <p>Cart Is Blank</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div class="page-wrapper">
        <?php echo $content ?>
    </div>

    <footer class="text-white">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-3">
            <div class="ft-left">
              <div class="logo-ft">
                <a href="<?php echo $home_link ?>">
                    <img alt="image" src="<?= $logo ?>" width="110" height="36"/>
                </a>
              </div>
              <div class="ft-social">
                <div class="row" style="max-width:140px; margin-top:10px;">
                  <?php
                  $social_links = json_decode($store_setting['social_links']);
                  foreach($social_links as $link){
                  $social_links_available = true;

                  $icon = (!empty($link->image)) ? base_url('assets/images/site/'.$link->image) : base_url('assets/store/default/img/wf.png');
                  ?>
                  <div class="col-3 py-1" style="padding-left:10px !important; padding-right:10px !important;"><a href="<?= $link->url; ?>"><img alt="image" src="<?= $icon; ?>" height="13px"/></a></div>
                  <?php	
                  }
                  if(!isset($social_links_available)) {
                  ?>
                  <div class="col-3 py-1"><a href="#"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/facebook-logo.png"/></a></div>
                  <div class="col-3 py-1"><a href="#"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/twitt.png" /></a></div>
                  <div class="col-3 py-1"><a href="#"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/youtube.png" /></a></div>
                  <div class="col-3 py-1"><a href="#"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/wf.png" /></a></div>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-9">
            <div class="row">
              <div class="col-6 col-md-2">
                <div class="ft-col">
                  <h3>Contact us</h3>
                  <ul>
                    <li><a href="#"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/phone-call.png" /> <?= !empty($store_setting['contact_number']) ? $store_setting['contact_number'] : '+90 555 555 5555';?></a></li>
                    <li><a href="#"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/pin.png" /><?= !empty($store_setting['address']) ? $store_setting['address'] : '+90 555 555 5555';?></a></li>
                    <li><a href="#"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/email.png" /> <?= !empty($store_setting['email']) ? $store_setting['email'] : '+90 555 555 5555';?></a></li>
                  </ul>
                </div>
              </div>
              <?php
              $footer_menu = json_decode($store_setting['footer_menu']);
              foreach($footer_menu as $fm){
                $footer_menu_are_available = true;
                $letpreIndex = $fm->index - 1;
                ?>
                <div class="col-6 col-md-2">
                  <div class="ft-col">
                    <h3><?= $fm->title; ?></h3>
                    <ul>
                    <?php
                        for ($i=0; $i < sizeOf($fm->links); $i++) { 
                          $text .= ($i == 0) ? $fm->links[$i]->title : ", ".$fm->links[$i]->title;
                          ?>
                          <li><a href="<?= $fm->links[$i]->url; ?>" class="nav-link"><?= $fm->links[$i]->title; ?></a></li>
                          <?php
                        }
                      ?>
                    </ul>
                  </div>
                </div>
                <?php	
              }

              if(!isset($footer_menu_are_available)) {
                ?>
                <div class="col-6 col-md-2">
                <div class="ft-col">
                  <h3>Policies & Info</h3>
                  <ul>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-6 col-md-2">
                <div class="ft-col">
                  <h3>Quick Links</h3>
                  <ul>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-6 col-md-2">
                <div class="ft-col">
                  <h3>My account</h3>
                  <ul>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-6 col-md-2">
                <div class="ft-col">
                  <h3>Lorem Ipsum</h3>
                  <ul>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-6 col-md-2">
                <div class="ft-col">
                  <h3>Lorem Ipsum</h3>
                  <ul>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                    <li><a href="#">Lorem Ipsum</a></li>
                  </ul>
                </div>
              </div> <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <div class="footer-bottom">
      <div class="container">
        <div class="footer-row">
          <p><?= ($settings['footer'] != '') ? $settings['footer'] : "All rights Reserved ".date('Y')."."?> <a href="<?php echo $base_url ?>policy" class="text-light"><?= __('store.policy') ?></a></p>
          <ul class="pg-listing">
            <?php 
            $payments = get_payment_gateways();
            foreach ($payments as $key => $payment) {
                if($payment['status']){
                    echo '<li><a href="javaScript:void(0);"><img alt="'. $payment['title'] .'" src="'. base_url($payment['icon']) .'" width="68" height="32"/></a></li>';
                }
            }
            ?>
          </ul>
        </div>
      </div>
    </div>

    <div style="display:none;">
        <a href="<?= base_url() ?>">affiliate pro</a>
    </div>

<div class="modal fade" id="cart-confirm" tabindex="-1" aria-labelledby="cart-confirm" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="popup-content">
		<img src="<?= base_url('assets/store/default/'); ?>img/shopping-cart.png" class="pop-cart-img" alt="Icon">
		<h2 id="product-name-prev"></h2>
		<p><?= __('store.has_beent_added_to_your_cart') ?></p>
		<img src="<?= base_url('assets/store/default/'); ?>img/popline.png" class="img-fluid img-popline" alt="Icon">
		<div class="pop-btn-row">
			<a href="<?= $base_url ?>checkout" class="btn btn-poup bg-main2"><?= __('store.procceed_to_checkout') ?></a>
			<a href="javascript:void(0);" type="button" class="btn btn-poup bg-main" data-dismiss="modal"><?= __('store.continue_shopping') ?></a>
			<!-- <a href="<?= base_url("/store") ?>" class="btn btn-default mb-2 text-dark"><?= __('store.continue_shopping') ?></a> -->
		</div>
		</div>
	</div>
	</div>
</div>

<?php if($this->session->flashdata('success')){ ?>
    <script>
      Swal.fire({
        icon: 'info',
        text: '<?= $this->session->flashdata('success') ?>'
      });
    </script>
<?php } ?>
<?php if($this->session->flashdata('error')){ ?>
  <script>
      Swal.fire({
        icon: 'info',
        text: '<?= $this->session->flashdata('error') ?>'
      });
    </script>
<?php } ?>
<script type="text/javascript">

// Tooltip

$('.btn-cart').tooltip({
  trigger: 'click',
  placement: 'top'
});

function setTooltip(message) {
  $('.btn-cart').tooltip('hide').attr('data-original-title', message).tooltip('show');
}

function hideTooltip() {
  $('.btn-cart').tooltip('hide');
}


  $(function(){ 
    $(document).on('click', ".btn-cart", function(){
      let quantity = ($('input#product-quantity').length) ? $('input#product-quantity').val() : 1;
      let product_name = $(this).data('product_name');
      let product_id = $(this).data('product_id');
      $this = $(this);

      let variationNotSelected = [];
      let variationSelected = {};

      if($('.variation-row .variations').length != 0) {
        $('.variation-row .variations').each(function(){
          let type = $(this).find('span:first-child').data('variation-type');
          let optionSpan = $(this).find('.active');
          if(optionSpan.length) {
            if(type == 'colors') {
              variationSelected[type] = optionSpan.data('variation-code')+"-"+optionSpan.data('variation-name');
            } else {
              variationSelected[type] = optionSpan.data('variation-option');
            }
          } else {
            variationNotSelected.push(type);
          }
        });
      }

      if(variationNotSelected.length){
        let warningMessage = "Please select "
        for (let index = 0; index < variationNotSelected.length; index++) {
          const element = variationNotSelected[index];
          warningMessage += (index == 0) ? element : ", "+element
        }
        setTooltip(warningMessage+' before add to cart!');
      } else {
        $.ajax({
          url:'<?= $add_tocart_url ?>',
          type:'POST',
          dataType:'json',
          data: {
            quantity:quantity,
            product_id:product_id,
            variation:variationSelected,
          },
          beforeSend: function(){$this.btn("loading");},
          complete: function(){$this.btn("reset");},
          success: function(json) {
            if(json['location']){
              updateCart();
              //window.location = json['location'];
              $('#cart-confirm #product-name-prev').text(product_name)
              $("#cart-confirm").modal("show");
            }
          }
        });
      }
    });

    $(document).on("click", ".cart-dropdown .btn-remove-cart", function(){
      $this = $(this);
      $.ajax({
          url:$this.attr("data-href"),
          type:'POST',
          dataType:'json',
          beforeSend:function(){},
          complete:function(){},
          success:function(json){
              updateCart();              
          },
      })
      return false;
    });

    $(document).on('click', ".cart-top", function(){
      $(".js-dropdown-list").hide();
      $(".js-dropdown-list1").hide();
      $(".js-dropdown-list2").hide();
      $(".cart-dropdown").slideToggle();
    });

    updateCart();
  });

  $(function(){
    $("#login-form input, #register-form input").focus(function(){
      if($(document).width() <= 408){
        $(".navbar-expand-lg,footer").hide();
      }
    });

    $("#login-form input, #register-form input").blur(function(){
      $(".navbar-expand-lg,footer").show();
    });
  });
  
  $(function(){
    function updateSymbol(e) {
      var selected = $(".currency-selector option:selected");
      $(".currency-symbol").text(selected.data("symbol"));
      $(".currency-amount").prop("placeholder", selected.data("placeholder"));
      $(".currency-addon-fixed").text(selected.text());
    }

    $(".currency-selector").on("change", updateSymbol);

    updateSymbol(); 
  });
  
  $(function () {
    var list = $(".js-dropdown-list");
    var link = $(".js-link");
    link.click(function (e) {
      e.preventDefault();
      $(".js-dropdown-list1").hide();
      $(".js-dropdown-list2").hide();
      $(".cart-dropdown").hide();
      list.slideToggle(200);
    });
    list.find("li").click(function () {
      var text = $(this).html();
      link.html(text);
      list.slideToggle(200);
      if (text === "* Reset") {
        link.html("Select one option" + icon);
      }
    });
  });

  $(function() {
    var list = $('.js-dropdown-list1');
    var link = $('.js-link1');
    link.click(function(e) {
        e.preventDefault();
        $(".js-dropdown-list").hide();
        $(".js-dropdown-list2").hide();
        $(".cart-dropdown").hide();
        list.slideToggle(200);
    });
    list.find('li').click(function() {
        var text = $(this).html();
        link.html(text);
        list.slideToggle(200);
        if (text === '* Reset') {
        link.html('Select one option'+icon);
        }
    });
  });

  $(function () {
    var list = $(".js-dropdown-list2");
    var link = $(".js-link2");
    link.click(function (e) {
      e.preventDefault();
      $(".js-dropdown-list1").hide();
      $(".js-dropdown-list").hide();
      $(".cart-dropdown").hide();
      list.slideToggle(200);
    });
    // list.find("li").click(function () {
    //   list.slideToggle(200);
    // });
  });
    
  window.onscroll = function() {
    let header = document.getElementById("myHeader");
    let sticky = header.offsetTop;
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
  }
</script>

<script type="text/javascript">
<?php 
if(isset($store_setting['notification']) && sizeOf(json_decode($store_setting['notification']) > 0)) { 
?>
  $(document).ready(function() {
    var items = <?= $store_setting['notification']; ?>,
    $text = $('.top-bar .container'),
    delay = 2;

    var filtered = items.filter(function (el) {
      return (el != null && el != ""  );
    });

    if(filtered.length > 0) {
      filtered.push(filtered.shift());
      function loop ( delay ) {
          $.each(filtered, function ( i, elm ){
            $text.delay( delay*1E3).fadeOut();
            $text.queue(function(){
                $text.html('<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/top-icon.png" /> '+filtered[i]);
                $text.dequeue();
            });
            $text.fadeIn();
            $text.queue(function(){
                if ( i == filtered.length -1 ) {
                    loop(delay);   
                }
                $text.dequeue();
            });
          });
      }
      loop(delay);
    }
  });
  <?php } ?>

  function updateCart(){
      $.ajax({
          url:'<?= $base_url ?>/mini_cart',
          type:'POST',
          dataType:'json',
          beforeSend:function(){},
          complete:function(){},
          success:function(json){
              $(".cart-top .cart-dropdown").html(json['cart']);
              $(".cart-top .cart-count").html(json['total']);
              $('#cart-sub-total').text(json['sub_total']);
          },
      });
    }
</script>
</body>
</html>