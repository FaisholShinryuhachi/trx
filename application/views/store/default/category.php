<?php if($category) { ?>
<?php
	$image = $category['image'] != '' ? 'assets/images/product/upload/thumb/' . $category['image'] : 'assets/store/default/img/ct-banner-img.png';
	$background_image = $category['background_image'] != '' ? 'assets/images/product/upload/thumb/' . $category['background_image'] : 'assets/store/default/img/ctbg.png';
?>
<section class="single-ctg-banner" style="background-image: url(<?= base_url($background_image) ?>);">
   <div class="container">
      <div class="banner-caption-ctg">
        <div class="ctg-banner-img-wrapper"><img src="<?= base_url($image) ?>" alt="<?= $category['name'] ?>" width="306" height="100%"></div>
		<div class="text-caption">
		   <h2 style="color: <?= $category['color'] ?>;"><?= $category['name'] ?></h2>
		   <p><?= (!empty($category['description'])) ? $category['description'] : 'E-commerce (electronic commerce) is the buying and selling of goods and services, or the transmitting of funds or data, over an electronic network, primarily the internet. These business transactions occur either as business-to-business (B2B), business-to-consumer (B2C), consumer-to-consumer' ?></p>
		</div>
	  </div>
   </div>
</section>
<?php } ?>

<section class="product-category-page">
   <div class="container">
      	<div class="category-row">
			<div class="sidebar">
				<div class="sidebar-block">
					<h2>Related Categories</h2>
					<ul>
					<?php
					function display_with_children($parentRow, $level = 0) { 
						$space = $level > 0 ? str_repeat("&nbsp;&nbsp;&nbsp;", $level).'- ' : '';
						foreach ($parentRow as $key => $row) {
							echo '<li data-id="'. $row['id'] .'" class="'. ($row['children'] ? 'has-children' : '') .'" ><span>'. $space .'<a href="'. base_url('store/category/'. $row['slug']) .'">'. $row['name']."</a></span>"; 
							if ($row['children']) {
								echo '<ul>';display_with_children($row['children'], $level + 1);echo '</ul>';
							}
							echo '</li>';
						}
					}

					echo '<ul class="category_block">';
					echo '<li data-id="0" ><span><a href="'. base_url('store/category/') .'">All Categories</a></span>'; 
					display_with_children($category_tree, 0);
					echo '</ul>';
					?>
						<!-- <li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li> -->
					</ul>
				</div>
				
				<div class="sidebar-block mt-4">
					<h2>Refine by</h2>
					<div class="sidebar-search position-relative">
						<input id="searchProduct" type="text" placeholder="Enter Keywords">
						<img src="<?= base_url('assets/store/default/'); ?>img/cancel.png" class="cancel-img" alt="Cancel">
						<a href="javascript:void(0);" id="clear-all-search">Clear All</a>
					</div>
				</div>
				
				<div class="sidebar-block mt-4">
					<h2>Price</h2>
					<div class="price-sidebar-slider">
						<div id="slider-range"></div>
						<div class="price-caption">
							<span>Price:</span>
							<span id="slider-range-value1"></span>
							<span class="dashed"> &nbsp;  - &nbsp; </span>
							<span id="slider-range-value2"></span>
						</div>
						<a href="javascript:void(0);" id="filter-price-range">Filter</a>
						<form>
							<input type="hidden" name="min-value" value="0">
							<input type="hidden" name="max-value" value="10000">
						</form>
					</div>
				</div>
				
				<div class="sidebar-block mt-4">
					<h2>Product Rating</h2>
					<div class="sidebar-rating-filter">
						<div class="filter-rating-row">
							<div class="d-flex">
							<input type="radio" name="rating-filter" value="5">
							<div class="rating-images">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
							</div>
							</div>
							<span>(5)</span>
						</div>
						
						<div class="filter-rating-row">
							<div class="d-flex">
							<input type="radio" name="rating-filter" value="4">
							<div class="rating-images">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
							</div>
							</div>
							<span>(4)</span>
						</div>
						
						<div class="filter-rating-row">
							<div class="d-flex">
							<input type="radio" name="rating-filter" value="3">
							<div class="rating-images">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
							</div>
							</div>
							<span>(3)</span>
						</div>
						
						<div class="filter-rating-row">
							<div class="d-flex">
							<input type="radio" name="rating-filter" value="2">
							<div class="rating-images">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
							</div>
							</div>
							<span>(2)</span>
						</div>
						
						<div class="filter-rating-row">
							<div class="d-flex">
							<input type="radio" name="rating-filter" value="1">
							<div class="rating-images">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
								<img alt="image" src="<?= base_url('assets/store/default/'); ?>img/st1.png">
							</div>
							</div>
							<span>(1)</span>
						</div>
						<a href="javascript:void(0);" id="clear-rating-filter">Clear All</a>
					</div>
				</div>
				

				<?php 
				$store_setting = $this->Product_model->getSettings('store');
				if($store_setting['is_variation_filter']){ 
				  ?>
				<div class="sidebar-block mt-4">
					<h2>Color</h2>
					<div class="sidebar-colors">
					<?php 
						if(sizeOf($colors) > 0) {
							for ($i=0; $i < sizeOf($colors); $i++) { 
								echo '<span data-color="'.$colors[$i].'" style="background: '.$colors[$i].'"></span>';
							} 
						} else {
							?>
							<span style="background: #BE0027"></span>
							<span style="background: #CF8D2E"></span>
							<span style="background: #E4E932"></span>
							<span style="background: #371777"></span>
							<span style="background: #037EF3"></span>
							<span style="background: #BE0027"></span>
							<span style="background: #CF8D2E"></span>
							<span style="background: #E4E932"></span>
							<span style="background: #371777"></span>
							<span style="background: #037EF3"></span>
							<?php
						}
					?>
					</div>
				</div>
				  <?php
				}
				?>
				
				<div class="sidebar-block mt-4">
					<h2>Product tag</h2>
					<div class="sidebar-tags">
						<?php 
							if(sizeOf($tags) > 0) {
								for ($i=0; $i < sizeOf($tags); $i++) { 
									echo '<a href="javaScript:void(0);" data-tag="'.$tags[$i].'">'.$tags[$i].'</a>';
								} 
							} else {
								?>
								<a href="javaScript:void(0);">Lorem Ipsum</a>
								<a href="javaScript:void(0);" class="active">Lorem Ipsum</a>
								<a href="javaScript:void(0);">Lorem Ipsum</a>
								<a href="javaScript:void(0);">Lorem Ipsum</a>
								<a href="javaScript:void(0);">Lorem Ipsum</a>
								<?php
							}
						?>
					</div>
				</div>
				
			</div>
			
			
			
			<div class="catg-property-wrapper">
				
			<div class="inner-pages-breadcrumb">
				<h2><?= (isset($category['name'])) ? $category['name']: "All Categories" ?></h2>
				<p><a href="<?= $home_link ?>">Home</a> / <a href="<?= $base_url ?>category">Categories</a> / <?= (isset($category['name'])) ? $category['name']: "All Categories" ?></p>
			</div>
				
			<div class="product-sort-row">
				<p><span></span> Showing <small id="show-count">0</small> / <small id="total-count">15</small> results</p>
				<div class="sort-filter">
					<label>Sort by: </label>
					<select id="sort-by">
						<option value="popular" selected>Popular Products</option>
						<option value="low-to-high">Price Low to High</option>
						<option value="high-to-low">Price High to Low</option>
						<option value="latest">Newest First</option>
					</select>
				</div>
			</div>
				
			<div class="product-row d-flex flex-wrap product-list">
			</div>
			<a href="javascript:void(0);" class="see-more" data-next_page="1"><img alt="image" src="<?= base_url('assets/store/default/'); ?>img/loading.png">Show more</a></div>
		</div>
   	</div>
</section>

<?php include 'product-list-template.php';  ?>

<script type="text/javascript">
	$(document).ready(function() {
		load_Product($('#searchProduct').val(), {
			category_slug : '<?= (isset($category['slug'])) ? $category['slug'] : ""; ?>',
		});

		
		
		$(document).on('click', '.sidebar-tags a', function() {
			$(this).toggleClass('active');
			load_Product($('#searchProduct').val(), {
				next_page: $(this).data('next_page'),
			});
		});


		$(document).on('click', '.sidebar-colors span', function() {
			$(this).toggleClass('active');
			load_Product($('#searchProduct').val(), {
				next_page: $(this).data('next_page'),
			});
		});
		
		
		$(document).on('click', '.see-more', function() {
			load_Product($('#searchProduct').val(), {
				next_page: $(this).data('next_page'),
			});
		});

		$('#searchProduct').keyup(function(e) {
			e.preventDefault();
			var search = $(this).val();
			load_Product(search);
		});

		$(document).on('click', ".category_block a", function(e){ 
			e.stopPropagation(); 
		});

		$(document).on('click', ".category_block .has-children", function(e){
			e.stopPropagation();
			$(this).find("> ul").slideToggle();
		});

		$(document).on('change', '#sort-by', function(){
			load_Product($('#searchProduct').val());
		});

		$(document).on('click', '#filter-price-range', function(){
			load_Product($('#searchProduct').val());
		});

		$(document).on('click', 'input[name="rating-filter"]', function(){
			load_Product($('#searchProduct').val());
		});

		$(document).on('click', '#clear-rating-filter', function(){
			$('input[name="rating-filter"]:checked').prop('checked', false);
			load_Product($('#searchProduct').val());
		});

		$(document).on('click', '#clear-all-search', function(){
			$('input[name="rating-filter"]:checked').prop('checked', false);
			$('#searchProduct').val('');
			load_Product($('#searchProduct').val());
		});
	});

	function load_Product(search, postData = {}) {
		var data = postData;
		data.search = search;
		data.order_by = $('#sort-by').val();
		data.min_price = $('input[name="min-value"]').val();
		data.max_price = $('input[name="max-value"]').val();
		if($('input[name="rating-filter"]:checked').length){
			data.product_avg_rating = $('input[name="rating-filter"]:checked').val();
		}

		data.colors = [];
		data.tags = [];

		$('.sidebar-tags a').each(function( index ) {
			if($(this).hasClass('active')){
				data.tags.push($(this).data('tag'));
			}
		});

		$('.sidebar-colors span').each(function( index ) {
			if($(this).hasClass('active')){
				data.colors.push($(this).data('color'));
			}
		});

		data.request_page = 'category';
		data.limit = 15;
		var ajaxReq = 'ToCancelPrevReq';
		var ajaxReq = $.ajax({
			url: "<?= base_url() ?>" + 'Store/load_Product',
			type: 'POST',
			dataType: 'JSON',
			data: data,
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
				if(res.category) {

					if(postData.next_page && postData.next_page > 1) {
						$('.product-list').append(Mustache.render($('#product-list-template').html(), res.category));
					} else {
						$('.product-list').html(Mustache.render($('#product-list-template').html(), res.category));
					}

					$('.see-more').data('next_page', res.category.next_page);
					if(res.category.is_last_page) {
						$('.see-more').hide();
					}

					if(res.category.total_count) {
						$('#total-count').text(res.category.total_count);
					}

					if(postData.next_page && postData.next_page > 1){
						$('#show-count').text((parseInt($('#show-count').text())+res.category.count));
					} else {
						$('#show-count').text(res.category.count);
					};
					
				}
			}
		});
	}

	<?php if($category) { ?>
		var c = $('[data-id="<?= $category['id'] ?>"]').parents("li");
		var ele = c[c.length-1];
		$(ele).find("ul").show()
	<?php } ?>

	// Initialize Range slider:
	$(document).ready(function() {
	$('.noUi-handle').on('click', function() {
		$(this).width(50);
	});
	var rangeSlider = document.getElementById('slider-range');
	var moneyFormat = wNumb({
		decimals: 0,
		thousand: ',',
		prefix: $('a[data-currency-symbol]').data('currency-symbol'),
		edit: function(value){
			if(value == "$10,000") {
				return "$10,000 +";
			} else {
				return value;
			}
		}
	});
	
	noUiSlider.create(rangeSlider, {
		start: [0, 10000],
		step: 50,
		range: {
		'min': [0],
		'max': [10000]
		},
		format: moneyFormat,
		connect: true
	});
	
		// Set visual min and max values and also update value hidden form inputs
		rangeSlider.noUiSlider.on('update', function(values, handle) {
			document.getElementById('slider-range-value1').innerHTML = values[0];
			document.getElementById('slider-range-value2').innerHTML = values[1];
			$('input[name="min-value"]').val(moneyFormat.from(values[0]));
			$('input[name="max-value"]').val(moneyFormat.from(values[1]));
			console.log(moneyFormat.from(values[0]));
			console.log(moneyFormat.from(values[1]));
		});
	});
</script>