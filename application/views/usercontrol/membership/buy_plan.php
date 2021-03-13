<div class="row text-center">
    <?php if($this->session->flashdata('error')){?>
        <div class="col-sm-12 m-t-10 text-center">
            <div class="alert alert-warning"> <?php echo $this->session->flashdata('error'); ?> </div>
        </div>
    <?php } ?>
	<div class="col-lg-4"></div>
	<div class="col-lg-4">
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
                <div class="plan-features mt-3 text-muted padding-t-b-30">
                    <?= $plan->description ?>
                </div>
                <div class="confirm-view text-left">
                	<?= $confirm ?>
                </div>
                <?php if($plan->bonus) { ?>
                <div class="bonus mt-3">
                    <label>Bonus Rate</label>
                    <p class="m-0"><?= c_format($plan->bonus) ?></p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>