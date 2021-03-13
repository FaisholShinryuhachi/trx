<section class="profile-page">
	<div class="container">
		<div class="profile-page-wrapper">
			<div class="profile-sidebar">
				<h3>User Menu</h3>
				<ul>
					<li><a href="<?= $base_url ?>profile"><?= __('store.profile') ?></a></li>
					<li><a href="<?= $base_url ?>order"><?= __('store.order') ?></a></li>
					<li><a href="<?= $base_url ?>shipping"><?= __('store.shipping') ?></a></li>
					<li><a class="active" href="<?= $base_url ?>wishlist">Wishlist</a></li>
					<li><a href="<?= $base_url ?>logout"><?= __('store.logout') ?></a></li>
				</ul>
			</div>

			<div class="profile-main">
				<h2>Wishlist</h2>
				<div class="my-orders">
					<div class="cart-wrapper w-listed-products">
						<?php  
							if(isset($products) && sizeof($products)) {
								foreach($products as $product) {
									$href = base_url("store/". base64_encode($user_id) . "/product/". $product['product_slug']);
									$image = (!empty($product['product_featured_image'])) ? resize('assets/images/product/upload/thumb/'. $product['product_featured_image'], 200,200) : base_url('assets/store/default/').'img/product1.png';
									?>
									<div class="row bg-white py-2 mb-2">
										<div class="col-9 p-2">
											<img src="<?= $image; ?>" class="mr-2" width="50" height="50"/>
											<span class=""><?= $product['product_name'] ?></span>
										</div>
										<div class="col-3">
											<span class="my-orders-text">
												<a href="<?= $href ?>" class="btn btn-wishlist">Details</a>&nbsp;
												<a id="btn-add-to-wishlist" data-product_id="<?= $product['product_id'] ?>" href="javascript:void(0);" class="btn btn-wishlist-remove">Remove</a>
											</span>
										</div>
									</div>									
									<?php
								}
							} else {
								?>
									<div class="row bg-white py-2 mb-2">
										<div class="col-12 p-2 text-center">
											<span class="wishlist-product-title ml-4">No wishlisted products available!</span>
										</div>
									</div>
								<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
$(document).on('click', '#btn-add-to-wishlist',function(){
	$.ajax({
		url:'<?= base_url('Store/toggle_wishlist') ?>',
		type:'POST',
		dataType:'json',
		data: { product_id : $(this).data('product_id')},
		success:function(json){
			location.reload();
		},
	});
});
</script>