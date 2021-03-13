<div class="row">
	<div class="col-sm-12">
		<?php if($MembershipSetting['status'] && isset($plan) && $plan){ ?>
	        <div class="new-card pb-3 shadow-sm m-0">
	            <div class="card-header">
	                <h5 class="card-title">Active Plan</small></h5>
	            </div>
	            
	            <?php if (isset($is_lifetime_plan) && $is_lifetime_plan) { ?>
	                <div class="card-body">
	                    <h4 class="text-center text-success">Lifetime free membership</h4>
	                    <p class="text-center text-muted">You have a lifetime free membership. you can access all functions of script lifetime</p>
	                </div>
	            <?php } ?>
	            <?php if (isset($plan) && $plan) { ?>
	                <div class="card-body">
	                    <h4 class="text-success"><span class="text-muted">Plan: </span><?= $plan->plan ? $plan->plan->name : '' ?></h4>
	                </div>
	                <ul class="list-group list-group-flush">
	                    <li class="list-group-item">
	                        <span>Plan Date</span>
	                        <span class="text-right pull-right text-primary">
							<?php 
								$remain = $plan->remainDay();
								$planto = ($plan->is_lifetime) ? 'Lifetime' : dateFormat($plan->expire_at,'d F Y h:i A');
							?>
							<?= dateFormat($plan->started_at,'d F Y h:i A') . " to ". $planto ?>
	                        </span>  
	                    </li>
	                    <li class="list-group-item">
	                        <span class="d-inline-block">Remaining Time</span>
	                        <span class=" pull-right text-primary text-right">
	                            <?php
	                                if($plan->is_lifetime){
										echo '<span class="font-32" style="line-height: 22px;">&infin;</span>';
									} else {
										echo "<span data-time-remains='".$plan->strToTimeRemains()."'>". $remain ."</span>";
									}
	                            ?>
	                        </span>  
	                    </li>
	                    <li class="list-group-item">
	                        <span>Status</span>
	                        <span class="text-right pull-right text-primary">
	                            <?= $plan->status_text ?>
	                        </span>  
	                    </li>
	                    <li class="list-group-item">
	                        <span>Active</span>
	                        <span class="text-right pull-right text-primary">
	                            <?= $plan->active_text ?>
	                        </span>  
	                    </li>
	                </ul>
	                <!-- <div class="card-body">
	                    <?= $plan->plan ? $plan->plan->description : '' ?>
	                </div> -->
	            <?php } ?>
	        </div>
		    <div class="new-card border card-toggle shadow-sm">
	            <div class="card-header">
	                <h6 class='card-title'>Description</h6>
	                <div class="card-options">
	                    <button class="open-close-button"></button>
	                </div>
	            </div>
	            <div class="card-container">
	                <div class="card-body pb-0">
	                    <?= $plan->plan ? $plan->plan->description : '' ?>
	                </div>
	            </div>
	        </div>
	    <?php }else{ ?>
	    	<div class="alert alert-dark text-center">Currently you don't have any active plan, To activate your membership please choose one of the below plan!</div>
	    <?php } ?>
	</div>
</div>
<div class="row text-center">
	<div class="col-sm-12">
		<h5>Buy New Plan</small></h5>
	</div>
	<?php foreach ($plans as $key => $plan) { ?>
	    <div class="col-lg-3">
	        <div class="card plan-card mb-4">
	            <div class="card-body" style="position: relative;overflow: hidden;">
	            	<?php if($plan->label_text) { ?>
	                <span class="plan-label" style="background: <?= $plan->label_background ?>;color: <?= $plan->label_color ?>;"><?= $plan->label_text ?></span>
	                <?php } ?>
	                <div class="pt-3 pb-3">
	                    <h6 class="text-uppercase text-primary"><?= $plan->name ?></h6>
	                </div>
	                <div>
	                    <h1 class="plan-price padding-b-15">
	                    	<?php  if($plan->price == 0){ ?>
	                    		FREE
	                    	<?php } else { ?>
	                    		<?php if($plan->special) { ?>
	                    		<?= c_format($plan->special) ?>
	                    		<?php }else{ ?>
	                    		<?= c_format($plan->price) ?>
	                    		<?php } ?>
	                    	<?php } ?>
	                    </h1>
	                    <?php if($plan->special) {
	                    	$percentage = round((($plan->price - $plan->special) * 100) / $plan->price);
	                    ?>
	                    <h4><span class="price" style="text-decoration: line-through;color: gray"><?= c_format($plan->price) ?></span> <span class="badge" style="background: <?= $plan->label_background ?>;color: <?= $plan->label_color ?>;">Save <?= $percentage ?>%!</span></h4>
	                    <?php } ?>
	                    <div class="text-muted m-l-10"><sup><?= $plan->billing_period_text ?></sup></div>
	                    <div class="plan-div-border"></div>
	                </div>
	                <div class="plan-features pb-3 mt-3 text-muted padding-t-b-30">
	                    <?= $plan->description ?>
	                    <a href="javascript:void(0)" onclick="choosePlan(<?= $plan->id ?>)" class="btn btn-primary">Purchase Now</a>
	                </div>
	                <?php if($plan->bonus) { ?>
	                <div class="bonus">
	                	<label>Bonus Rate</label>
	                	<p class="m-0"><?= c_format($plan->bonus) ?></p>
	                </div>
	            	<?php } ?>
	            </div>
	        </div>
	    </div>
	<?php } ?>

	<div class="modal" id="model-payments">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h6 class="modal-title m-0">Choose Payment Gateway</h6>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>
	      <div class="modal-body">
	        <ul class="list-group">
	        	<?php 
	        		$index = 0;
	        		foreach ($methods as $key => $value) { 
	        		if(!$value['status']){ continue; } 
	        		$index++;
        		?>
		        	<li class="list-group-item text-left">
		        		<a href="javascript:void(0)" onclick="buy('<?= $value['code'] ?>')"><?= $value['title'] ?></a>
		        	</li>
		        <?php } ?>
	        </ul>
	        <?php if($index == 0){ ?>
	      		<div class="alert alert-info">There are no any payment gateway available. please  <a href="<?= base_url('usercontrol/contact-us') ?>">contact </a> administrator </div>
	      	<?php } ?>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>


	<script type="text/javascript">
		var plan_id= 0;
		function buy(code){
			window.location.href = "<?= base_url('membership/buy_membership') ?>/" + plan_id +"/" + code;
		}

		function choosePlan(pID) {
			plan_id = pID;
			$("#model-payments").modal("show");
		}
	</script>
	<script type="text/javascript">
	    $(".card-toggle .open-close-button").click(function(){
	        $(this).parents(".card-toggle").toggleClass("open")
	    })
	</script>
</div>