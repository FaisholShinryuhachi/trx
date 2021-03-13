<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    
    <?php if(isset($meta_title)){ ?> <meta property="og:title" content="<?php echo $meta_title ?>"/><?php } ?>
    <?php if(isset($meta_description)){ ?> <meta property="og:description" content="<?php echo $meta_description ?>"/><?php } ?>
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
    <link rel="stylesheet" href="<?= base_url('assets/store/default/'); ?>css/style.css" />

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <script src="<?= base_url('assets/store/default/'); ?>js/jquery-3.5.1.slim.min.js"></script>
    <script src="<?= base_url('assets/store/default/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/store/default/'); ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/plugins/store/') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

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
  
  <div class="thankyouheader">
     <div class="container">
	   <div class="thankyouheader-row">
	      <a class="no-print" href="<?= base_url('store/order') ?>"><img src="<?= base_url('assets/store/default/'); ?>img/thankyouback.png" class="thankyouback-img" alt="Back"></a>
		  <?php  $logo = ($store_setting['logo']) ? base_url('assets/images/site/'.$store_setting['logo']) : base_url('assets/store/default/').'img/logo.png'; ?>
	      <a href="#"><img src="<?= $logo; ?>" class="thankyoulogo" Alt="All4bussness"></a>
	      <a class="no-print print" href="javascript:void(0);"><img src="<?= base_url('assets/store/default/'); ?>img/thankyouprint.png" class="thankyouprint-img" alt="Print"></a>
	   </div>
	 </div>
  </div>

<section class="thankyou-content">
  <div class="container">
     <div class="thankyou-content-wrapper">
	    <img src="<?= base_url('assets/store/default/'); ?>img/thankyoumain.png" class="thankyou-main-img" alt="Thank you For Purchasing an Order">
		<h3><?= __('store.order_status') ?> (#<?php echo orderId($order['id']); ?>)</h3>
		<h4><?= __('store.thank_you_for_purchasing_an_order') ?></h4>
		<p><?= __('store.thank_msg') ?></p>
	 </div>
  </div>
</section>


<section class="profile-page">
	<div class="container">
		<div class="profile-page-wrapper">
			<div class="profile-main w-100">
			   	<h2>Product Info</h2>
			   	<div class="my-orders my-order-details">
					<div class="cart-wrapper">
						<ul class="cart-header">
							<li><?= __('store.name') ?></li>
							<li><?= __('store.unit_price') ?></li>
							<li><?= __('store.quantity') ?></li>
							<li><?= __('store.discount') ?></li>
							<li><?= __('store.total') ?></li>		  
						</ul>
						<?php foreach ($products as $key => $product) { ?>
						<ul class="cart-items-row">
							<li>
								<span class="my-orders-text img-order-details-img"><img src="<?= (!empty($product['image'])) ? $product['image'] : base_url('assets/store/default/img/1.png'); ?>" alt="image">
								<p class="my-0">
								<?php
									$combinationString = "";
									if(isset($product['variation']) && !empty($product['variation'])) {
										$variation = json_decode($product['variation']);
										foreach ($variation as $key => $value) {
											if($key == 'colors') {
												$combinationString .= ($combinationString == "") ? explode("-",$value)[1] : ",".explode("-",$value)[1];
											} else {
												$combinationString .= ($combinationString == "") ? $value : ",".$value;
											}
										}
									}
								?>
								<?= $product['product_name'] ?> <?= ($combinationString != "") ? "(".$combinationString.")" : "" ?>
								<?php if($product['coupon_discount'] > 0){ ?>
									<br><small class="couopn-code-text">
										Code : <span class="c-name"> <?= $product['coupon_code'] ?></span> Applied
								</small>
								<?php } ?>
								</p>
								<?php if($order['status'] == 1 && $product['product_type'] == 'downloadable' && $product['downloadable_files']) { ?>
									<div class="download">	
									<?php foreach ($product['downloadable_files'] as $downloadable_filess) { ?>
										<a href="<?php echo base_url('store/downloadable_file/'. $downloadable_filess['name'] . '/' .$downloadable_filess['mask']) ?>" class="btn btn-link btn-sm" target="_blank"><?php echo $downloadable_filess['mask'] ?></a>
									<?php } ?>
									</div>
								<?php } ?>
								</span>
							</li>
							<li><span class="my-orders-text"><?php echo c_format($product['price'] + $product['variation_price']); ?></span>
							<li><span class="my-orders-text"><?php echo $product['quantity']; ?></span>
							<li><span class="my-orders-text">
								<?php $priceDiscount = (float)$product['msrp'] > 0 ? (float)$product['msrp'] - (float)$product['price'] : 0; ?>
								<?php echo c_format((float)$product['coupon_discount'] + (float)$priceDiscount); ?>
							</span>
							<li><span class="my-orders-text"><?php echo c_format($product['total']); ?></span>
						</ul>
						<?php } ?>
				
						<ul class="cart-footer-row">
							<?php foreach ($totals as $key => $total) { ?>
								<li>
								<span><?= $total['text'] ?></span>		 
								<span><?php echo c_format($total['value']); ?></span>		 
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				
				<div class="my-order-details-bottom">
					<div class="cart-wrapper order-details-bottom-left my-orders">
						<h2><?= __('store.order_payment_info') ?></h2>
						<ul class="cart-header">
							<li><?= __('store.mode') ?></li>
							<li class="cart-item-price"><?= __('store.transaction_id') ?></li>
							<li><?= __('store.payment_status') ?></li>
						</ul>

						<?php if($order['status'] == 0){ ?>
							<ul class="cart-items-row">
							<li><span class="my-orders-text"> <?= __('store.waiting_for_payment_status') ?></span></li>
							</ul>
						<?php } ?>
						<?php foreach ($payment_history as $key => $value) { ?>
						<ul>
							<li><span class="my-orders-text"><?php echo str_replace("_", " ", $value['payment_mode']) ?></span></li>
							<li><span class="my-orders-text"><?php echo $order['txn_id'];?></span></li>
							<li><span class="my-orders-text"><?php echo $value['paypal_status'] ?></span></li>
						</ul>
						<?php } ?>

						<?php if($order['payment_method'] == 'bank_transfer'){ ?>
							<div class="form-group">
								<label class="control-label"><b><?= __('store.bank_transfer_instruction') ?></b></label>
								<pre class="well"><?php echo $paymentsetting['bank_transfer_instruction'] ?></pre>
							</div>
						<?php } ?>

						<?php if($order['comment']){ ?>
							<div class="cart-wrapper order-details-bottom-left w-100 mt-4 my-orders">
								<h2><?= __('store.order_view_comment') ?></h2>
								<ul class="cart-header">
									<li><?= __('store.title') ?></li>
									<li><?= __('store.comment') ?></li>
								</ul>
								<?php foreach ($order['comment'] as $key => $value) { ?>
									<ul class="cart-items-row">
										<li><span class="my-orders-text"><?= $value['title'] ?></span> </li>		
										<li><span class="my-orders-text"><?= $value['comment'] ?></span> </li>		
									</ul>
								<?php } ?>
							</div>
						<?php } ?>

						<?php if($order['files']){ ?>
							<div class="card mt-2 no-border">
								<div class="card-body">
								<label class="control-label"><b><?= __('store.order_attechments_download') ?></b></label>
								<div><?php echo $order['files'] ?></div>
							</div>
							</div>
						<?php } ?>
						<?php if($order['order_country']){ ?>
							<div class="card mt-2 no-border">
								<div class="card-body">
								<label class="control-label"><b><?= __('store.order_done_from') ?></b></label>
								<div>
									<?php echo $order['order_country'];?><?php echo $order['order_country_flag'];?>
								</div>
							</div>
							</div>
						<?php  } ?>
						
						<?php if($orderProof){ ?>
							<div class="card mt-2 no-border">
								<div class="card-body">
								<label class="control-label"><b><?= __('store.payment_proof') ?></b>
									<a href="<?= $orderProof->downloadLink ?>" target='_blank'>: <?= __('store.download') ?></a>
								</label>
							</div>
							</div>
						<?php } ?>
					</div>


					<?php if($order['allow_shipping']){ ?>
						<div class="cart-wrapper order-details-bottom-right my-orders">
							<h2><?= __('store.shipping_details') ?></h2>
							<ul class="cart-header">
								<li>&nbsp;</li>
								<li class="cart-item-price">&nbsp;</li>
							</ul>
							<ul class="cart-items-row">
								<li><span class="my-orders-text"><?= __('store.address') ?></span></li>
								<li><span class="my-orders-text"><?php echo $order['address'] ?></span></li>
							</ul>
							<ul class="cart-items-row">
								<li><span class="my-orders-text"><?= __('store.country') ?></span></li>
								<li><span class="my-orders-text"><?php echo $order['country_name'] ?></span></li>
							</ul>
							<ul class="cart-items-row">
								<li><span class="my-orders-text"><?= __('store.state') ?></span></li>
								<li><span class="my-orders-text"><?php echo $order['state_name'] ?></span></li>
							</ul>
							<ul class="cart-items-row">
								<li><span class="my-orders-text"><?= __('store.city') ?></span></li>
								<li><span class="my-orders-text"><?php echo $order['city'] ?></span></li>
							</ul>
							<ul class="cart-items-row">
								<li><span class="my-orders-text"><?= __('store.postal_code') ?></span></li>
								<li><span class="my-orders-text"><?php echo $order['zip_code'] ?></span></li>
							</ul>
						</div>
					<?php } ?>  
				</div>

				<h2 class="mt-5"><?= __('store.update_order_status') ?></h2>
				<div class="cart-wrapper order-details-bottom-left w-100 mt-4 order-details-last-bottom">
					<ul class="cart-header">
						<li>#</li>
						<li class="cart-item-price"><?= __('store.status') ?></li>
						<li><?= __('store.comment') ?></li>
					</ul>

					<?php if(!$order_history){ ?>
						<ul class="cart-items-row">
							<li><span class="my-orders-text"><?= __('store.no_any_order_status') ?></span> </li>
						</ul>
					<?php } ?>
					<?php foreach ($order_history as $key => $value) { ?>
						<ul class="cart-items-row">
							<li><span class="my-orders-text">#<?= $key ?></span> </li>		
							<li><span class="my-orders-img-check"><?= $status[$value['order_status_id']] ?></span> </li>		
							<li><span class="my-orders-text"><?= $value['comment'] ?></span> </li>			
						</ul>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>	   
</section>
	
	

    <div class="footer-bottom">
      <div class="container">
        <div class="footer-row w-100 text-center pb-1">
          <p class="w-100 text-center pb-2"><?= ($store_setting['footer'] != '') ? $store_setting['footer'] : "All rights Reserved ".date('Y')."."?></p>
        </div>
      </div>
    </div>

	<script>
		$(".print").on('click',function(){
			window.print();
		})
	</script>
  </body>
</html>