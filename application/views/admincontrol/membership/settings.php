<?php print_message($this); ?>
<div class="card">
	<div class="card-body">
		<form class="form-horizontal" method="post" action=""  enctype="multipart/form-data" id="setting-form">
			<div class="row">
				<div class="col-sm-12">
					<ul class="nav nav-pills nav-stacked setting-nnnav" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" data-toggle="tab" href="#tab-setting" role="tab"><?= __('admin.setting') ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tab-cron_jobs" role="tab"><?= __('admin.cron_jobs') ?></a>
						</li>
					</ul>
					<div class="tab-content">
						<?php if($this->session->flashdata('success')){?>
							<div class="alert alert-success alert-dismissable"> <?php echo $this->session->flashdata('success'); ?> </div>
						<?php } ?>
						<div class="tab-pane p-3 active" id="tab-setting" role="tabpanel">
							<div class="form-group">
								<label class="control-label"><?= __('admin.status') ?></label>
								<select class="form-control" name="membership[status]">
									<option value="0" <?= ($membership['status'] == 0) ? 'selected' : '' ?>><?= __('admin.disable') ?></option>
									<option value="1" <?= ($membership['status'] == 1) ? 'selected' : '' ?>><?= __('admin.enable_for_all_users') ?></option>
									<option value="2" <?= ($membership['status'] == 2) ? 'selected' : '' ?>><?= __('admin.enable_for_all_vendors') ?></option>
									<option value="3" <?= ($membership['status'] == 3) ? 'selected' : '' ?>><?= __('admin.enable_for_all_affiliates') ?></option>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">Show expire notification interval (In days)</label>
								<input type="number" value="<?= $membership['notificationbefore'] ?>" class="form-control" name="membership[notificationbefore]">
							</div>
							<div class="form-group">
								<label class="control-label">Default plan for new register members</label>
								<select class="form-control" name="membership[default_plan_id]">
									<option value="">None</option>
									<?php foreach ($plans as $key => $plan) { ?>
										<option value="<?= $plan->id ?>" <?= $membership['default_plan_id'] == $plan->id ? 'selected' : '' ?>><?= $plan->name ?></option>
									<?php } ?>
								</select>
							</div>

							<!-- <div class="form-group">
								<label class="control-label">Welcome Bonus</label>
								<input type="number" value="<?= $membership['welcomebonus'] ?>" class="form-control" name="membership[welcomebonus]">
								<span class="help-feedback">This amount will be added on user wallet when he register on script.</span>
							</div> -->
						</div>
						<div class="tab-pane p-3" id="tab-cron_jobs" role="tabpanel">
							<div class="row">
								<div class="col-sm-6">
									<h5>WHAT IS A CRON JOB?</h5>
									<p>A cron job is simply a task that you schedule to run automatically at specific intervals. For example, if you want to back up a file every six hours, you can set this up easily using cPanel's cron jobs feature.</p>

									<h6>To add a cron job, follow these steps:</h6>

									<ol>
										<li>Log in to cPanel</li>
										<li>In the <b>ADVANCED</b> section of the cPanel home screen, click <b>Cron Jobs</b>:</li>
										<li>Under <b>Add New Cron Job</b>, specify the interval for the command you want.</li>
										<li>In the <b>Common Settings</b>, select  <b>Once Per Minute(* * * * *)</b>.</li>
										<li>In the <b>Command</b> box add <div> <code>curl <?= base_url('/cronJob/expire_package_notification') ?></code></div> </li>
										<li>Click Add New Cron Job. cPanel creates the cron job.</li>
									</ol>
								</div>
								<div class="col-sm-6">
									<img src="<?= base_url('assets/images/cronjob2.jpg') ?>" width="100%" class='img-responsive'>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-sm btn-primary btn-submit"> Save </button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
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
	            $this.find(".is-invalid").removeClass("is-invalid");
	            $this.find("span.text-danger").remove();
	            
	            if(result['location']){
	                window.location = result['location'];
	            }

	            if(result['success']){
	                $("#setting-form").prepend('<div class="alert mt-4 alert-info alert-dismissable">'+ result['success'] +'</div>');
	                var body = $("html, body");
					body.stop().animate({scrollTop:0}, 500, 'swing', function() { });

					$('.formsetting_error').text("");
					$('.productsetting_error').text("");
	            }

	            if(result['errors']){
	                $.each(result['errors'], function(i,j){
	                    $ele = $this.find('[name="'+ i +'"]');
	                    if(!$ele.length){ 
	                    	$ele = $this.find('.'+ i);
	                    }
	                    if($ele){
	                        $ele.addClass("is-invalid");
	                        $ele.parents(".form-group").addClass("has-error");
	                        $ele.after("<span class='d-block text-danger'>"+ j +"</span>");
	                    }
	                });


					errors = result['errors'];
					$('.formsetting_error').text(errors['formsetting_recursion_custom_time']);
					$('.productsetting_error').text(errors['productsetting_recursion_custom_time']);
	            }
	        },
	    });
	

	    return false;
	});
</script>