
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="home-well">
				<h1><?php echo $store_setting['title'] ?></h1>
				<?php echo $store_setting['content'] ?>
			</div>
			<div class="card">
				<div class="card-header">
					<?= __('store.our_products_click_buy_to_record_a_sale') ?>
				</div>
				<div class="card-body">
					<div class="input-group mb-4">
						<input type="text" class="form-control" id="searchProduct" placeholder="Search Products" />
						<div class="input-group-append">
							<button class="btn btn-primary btn-search" type="button"><i class="fas fa-search"></i></button>
						</div>
					</div>
					
					<div class="row product-list">
						<?php if(!$products){ ?>
							<div class="col-sm-12">
								<h3 class="mb-4 mt-4 text-center text-muted"><?= __('store.store_have_no_any_products') ?></h3>
							</div>
						<?php } ?>
						<?php foreach ($products as $key => $product) { ?>
						<div class="col-md-3 col-sm-6 mb-2">
							<div class="card h-100">
								<?php $href = base_url("store/". base64_encode($user_id) . "/product/". $product['product_slug']); ?>
								<a href="<?php echo $href ?>"><img src="<?php echo resize('assets/images/product/upload/thumb/'. $product['product_featured_image'], 245,165); ?>" class="card-img-top" style="height:165px;"></a>
								<div class="card-body">
									<h4 class="card-title">
										<a href="<?php echo $href ?>"><?php echo $product['product_name'] ?></a>
									</h4>
									<h5><?php echo c_format($product['product_price']) ?></h5>
									<p class="card-text"><?php echo $product['product_short_description'] ?></p>
								</div>
								<div class="card-footer">
									<a href="<?php echo $href ?>" class="btn btn-primary btn-block"><?= __('store.buy_now') ?></a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<br>
		</div>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function() {
		var search = null;
		load_Product(search);


		$('#searchProduct').keyup(function(e) {
			e.preventDefault();
			var search = $(this).val();
			load_Product(search);
		});
	});



	function load_Product(search) {
		var ajaxReq = 'ToCancelPrevReq';
		var ajaxReq = $.ajax({
			url: "<?= base_url() ?>" + 'Store/load_Product',
			type: 'POST',
			dataType: 'JSON',
			data: { search: search },
			beforeSend : function() {
				if(ajaxReq != 'ToCancelPrevReq' && ajaxReq.readyState < 4) {
					ajaxReq.abort();
				}
				$('.btn-search').addClass('btn-loading');
			},
			complete : function() {
				$('.btn-search').removeClass('btn-loading');
			},
			success: function(res) {
				$('.product-list').html(res.product);
			}
		});

		
	}
</script>