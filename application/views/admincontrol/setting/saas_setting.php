<div class="card">
		<div class="card-body">
			<form class="form-horizontal" method="post" action=""  enctype="multipart/form-data" id="setting-form">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-pills nav-stacked setting-nnnav" role="tablist">
							<li class="nav-item">
								<a class="nav-link active show" data-toggle="tab" href="#market_vendor-setting" role="tab"><?= __('admin.external_store_vendor_setting') ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#vendor_setting" role="tab" data-toggle="tab"><?= __('admin.vendor_setting') ?></a>
							</li>
						</ul>
					</div>
					<div class="col-sm-12">
						<div class="tab-content">
							<?php if($this->session->flashdata('success')){?>
								<div class="alert alert-success alert-dismissable"> <?php echo $this->session->flashdata('success'); ?> </div>
							<?php } ?>
							<div class="tab-pane p-3 active show" id="market_vendor-setting" role="tabpanel">

								<div class="form-group">
									<label class="control-label"><?= __('admin.vendor_status') ?></label>
									<select class="form-control" name="market_vendor[marketvendorstatus]">
										<option value="0"><?= __('admin.disable') ?></option>
										<option value="1" <?= $market_vendor['marketvendorstatus'] ? 'selected' : '' ?>><?= __('admin.enable') ?></option>
									</select>
								</div>

								<h5>Program Settings</h5>
								<div class="row">
									<div class="col-sm-6">
										<div class="custom-card card">
											<div class="card-header"><p class="text-center"><?= __('admin.sale_settings') ?></p></div>

											<div class="card-body">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label"><?= __('admin.commission_type') ?></label>
															<select name="market_vendor[commission_type]" class="form-control">
																<option value=""><?= __('admin.select_product_commission_type') ?></option>
																<option <?= ($market_vendor['commission_type'] == 'percentage') ? 'selected' : '' ?> value="percentage"><?= __('admin.percentage') ?></option>
																<option <?= ($market_vendor['commission_type'] == 'fixed') ? 'selected' : '' ?> value="fixed"><?= __('admin.fixed') ?></option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label"><?= __('admin.commission_for_sale') ?> </label>
															<input class="form-control" name="market_vendor[commission_sale]" type="number" value="<?= isset($market_vendor) ? $market_vendor['commission_sale'] : '' ?>">
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label"><?= __('admin.sale_status') ?></label>
													<div>
														<div class="radio radio-inline"> <label> <input type="radio" checked="" name="market_vendor[sale_status]" value="0"> <?= __('admin.disable') ?> </label> </div>
														<div class="radio radio-inline"> <label> <input <?= ($market_vendor['sale_status']) ? 'checked' : '' ?> type="radio" name="market_vendor[sale_status]" value="1"> <?= __('admin.enable') ?> </label> </div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="custom-card card">
											<div class="card-header"><p class="text-center"><?= __('admin.click_settings') ?></p></div>

											<div class="card-body">
												
												<div class="row">
													<div class="col-sm-12">
														<div class="form-group">
															<label class="control-label"><?= __('admin.click_allow') ?></label>
															<select name="market_vendor[click_allow]" class="form-control">
																<option <?php if($market_vendor['click_allow'] == 'single') { ?> selected <?php } ?> value="single">Allow Single Click</option>
																<option <?php if($market_vendor['click_allow'] == 'multiple') { ?> selected <?php } ?>  value="multiple">Allow Multi Click</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label"><?= __('admin.number_of_click') ?></label>
															<input class="form-control" name="market_vendor[commission_number_of_click]" type="number" value="<?= isset($market_vendor) ? $market_vendor['commission_number_of_click'] : '' ?>">
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label class="control-label"><?= __('admin.amount_per_click') ?></label>
															<input class="form-control" name="market_vendor[commission_click_commission]" type="number" value="<?= isset($market_vendor) ? $market_vendor['commission_click_commission'] : '' ?>">
														</div>
													</div>
												</div>
												

												<div class="form-group">
													<label class="control-label"><?= __('admin.click_status') ?></label>
													<div>
														<div class="radio radio-inline"> <label> <input type="radio" checked="" name="market_vendor[click_status]" value="0"> <?= __('admin.disable') ?> </label> </div>
														<div class="radio radio-inline"> <label> <input type="radio" <?= ($market_vendor['click_status']) ? 'checked' : '' ?> name="market_vendor[click_status]" value="1"> <?= __('admin.enable') ?> </label> </div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane p-3" id="vendor_setting">
								<div class="form-group">
									<label class="control-label"><?= __('admin.vendor_status') ?></label>
									<select class="form-control" name="vendor[storestatus]">
										<option value="0"><?= __('admin.disable') ?></option>
										<option value="1" <?= $vendor['storestatus'] ? 'selected' : '' ?>><?= __('admin.enable') ?></option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label"><?= __('admin.click_commission'); ?></label>
									<div class="form-group">
										<div class="comm-group">
											<div>
												<div class="input-group mt-2">
													<div class="input-group-prepend"><span class="input-group-text">Click</span></div>
													<input name="vendor[admin_click_count]"  class="form-control" value="<?php echo $vendor['admin_click_count']; ?>" type="text" placeholder='Clicks'>
												</div>
											</div>
											<div>
												<div class="input-group mt-2">
													<div class="input-group-prepend"><span class="input-group-text">$</span></div>
													<input name="vendor[admin_click_amount]" class="form-control" value="<?php echo $vendor['admin_click_amount']; ?>" type="text" placeholder='Amount'>
												</div>
											</div>
										</div>
									</div>							
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<label class="control-label"><?= __('admin.sale_commission'); ?></label>
											<div>
												<?php
													$commission_type= array(
														'percentage' => 'Percentage (%)',
														'fixed'      => 'Fixed',
													);
												?>
												<select name="vendor[admin_sale_commission_type]" class="form-control admin_sale_commission_type">
													<?php foreach ($commission_type as $key => $value) { ?>
														<option <?= $vendor['admin_sale_commission_type'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="toggle-container">
												<div class="percentage-value d-none">									
													<div class="form-group">
														<label class="control-label m-0 d-block">&nbsp;</label>
														<input name="vendor[admin_commission_value]" id="admin_commission_value" class="form-control mt-2" value="<?php echo $vendor['admin_commission_value']; ?>" type="text" placeholder='Sale Commission'>
													</div>
												</div>
											</div>
										</div>
									</div>
								
									<script type="text/javascript">
										$("select.admin_sale_commission_type").on("change",function(){
											$con = $(this).parents(".form-group");
											$con.find(".toggle-container .percentage-value, .toggle-container .default-value").addClass('d-none');
											if($(this).val() == 'default'){
												$con.find(".toggle-container .default-value").removeClass("d-none");
											}else{
												$con.find(".toggle-container .percentage-value").removeClass("d-none");
											}
										})
										$("select.admin_sale_commission_type").trigger("change");
									</script>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 text-right">
						<button type="submit" class="btn btn-sm btn-primary btn-submit"><?= __('admin.save_settings') ?></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<link href="<?php echo base_url(); ?>assets/js/summernote-0.8.12-dist/summernote-bs4.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/summernote-0.8.12-dist/summernote-bs4.js"></script>


<script type="text/javascript">


$('.setting-nnnav li a').on('shown.bs.tab', function(event){
    var x = $(event.target).attr('href');         // active tab
    localStorage.setItem("last_pill", x);
});
$("#setting-form").on('submit',function(){
	$("#setting-form .alert-error").remove();
	var affiliate_cookie = parseInt($(".input-affiliate_cookie").val());
	if(affiliate_cookie <= 0 || affiliate_cookie > 365){
		$(".input-affiliate_cookie").after("<div class='alert alert-danger alert-error'>Days Between 1 and 365</div>");
	}
	if($("#setting-form .alert-error").length == 0) return true;
	return false;
})

$(".btn-submit").on('click',function(evt){
    evt.preventDefault();
    var formData = new FormData($("#setting-form")[0]);

    $(".btn-submit").btn("loading");
    formData = formDataFilter(formData);
    $this = $("#setting-form");
    
    $.ajax({
        type:'POST',
        dataType:'json',
        cache:false,
        contentType: false,
        processData: false,
        data:formData,
        success:function(result){
            $(".btn-submit").btn("reset");
            $(".alert-dismissable").remove();

            $this.find(".has-error").removeClass("has-error");
            $this.find("span.text-danger").remove();
            
            if(result['location']){
                window.location = result['location'];
            }

            if(result['success']){
                $(".tab-content").prepend('<div class="alert mt-4 alert-info alert-dismissable">'+ result['success'] +'</div>');
                var body = $("html, body");
				body.stop().animate({scrollTop:0}, 500, 'swing', function() { });
            }

            if(result['errors']){
                $.each(result['errors'], function(i,j){
                    $ele = $this.find('[name="'+ i +'"]');
                    if($ele){
                        $ele.parents(".form-group").addClass("has-error");
                        $ele.after("<span class='d-block text-danger'>"+ j +"</span>");
                    }
                });
            }
        },
    })
    return false;
});

</script>
