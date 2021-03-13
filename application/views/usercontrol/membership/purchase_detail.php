<div class="row">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title m-0">Purchase Details</h5>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item"><b>ID:</b> <?= $plan->id ?></li>
				<li class="list-group-item"><b>Plan Name:</b> <?= ($plan->plan ? $plan->plan->name : '') ?></li>
				<li class="list-group-item"><b>Price:</b> <?= c_format(($plan->plan ? ($plan->plan->special ? $plan->plan->special : $plan->plan->price) : 0)) ?></li>
				<?php 
					$bonus = $plan->bonusData();
					if($bonus){
				?>
				<li class="list-group-item"><b>Bonus:</b> <?= c_format($bonus->amount) ?></li>
				<?php } else { ?>
				<li class="list-group-item"><b>Bonus:</b> No Bonus</li>
				<?php } ?>
				<li class="list-group-item"><b>Type:</b> <?= ($plan->plan ? $plan->plan->type : '') ?></li>
				<li class="list-group-item"><b>Is Active:</b> <?= $plan->active_text ?></li>
				<li class="list-group-item"><b>Plan Status:</b> <?= $plan->status_text ?></li>
				<li class="list-group-item"><b>Payment Method:</b> <?= $plan->payment_method ?></li>
				<?php if($plan->status_id == 1) { ?>

				<?php if(!$plan->is_lifetime) { ?>

				<li class="list-group-item"><b>Remaining Time:</b> <span data-time-remains="<?= $plan->strToTimeRemains(); ?>"><?= $plan->remainDay() ?></span></li>

				<?php } ?>

				<li class="list-group-item"><b>Started On:</b> <?= dateFormat($plan->started_at,'d F Y, h:i A'); ?></li>

				<?php if(!$plan->is_lifetime) { ?>

				<li class="list-group-item"><b>Ending On:</b> <?= dateFormat($plan->expire_at,'d F Y, h:i A'); ?></li>

				<?php } ?>

				<?php } ?>



				<li class="list-group-item"><b>Created at:</b> <?= dateFormat($plan->created_at, 'd F Y, h:i A') ?></li>

			</ul>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title m-0">Plan Details</h5>
			</div>
    		<ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Name:</b> <?= $plan->plan->name ?></li>
                <li class="list-group-item"><b>Type:</b> <?= $plan->plan->type ?></li>
                <li class="list-group-item"><b>Price:</b> <?= ($plan->plan->special ? $plan->plan->special : $plan->plan->price) ?></li>
                <li class="list-group-item"><b>Description:</b></li>
            </ul>
            <div class="px-3 mt-2">
            	<?= $plan->plan->description ?>
            </div>
		</div>

		<div class="card mt-3">
			<div class="card-header">
				<h5 class="card-title m-0">Status History</h5>
			</div>
    		<div class="card-body m-0 p-0">
    			<div class="table-responsive">
    				<table class="table table-striped">
	    				<thead>
	    					<tr>
	    						<td width="100px">Status</td>
	    						<td>Note</td>
	    					</tr>
	    				</thead>
	    				<tbody>
	    					<?php foreach ($history as $key => $value) { ?>
	    						<tr>
	    							<td><?= $value->status_text ?></td>
	    							<td><?= $value->comment ?></td>
	    						</tr>
	    					<?php } ?>
	    				</tbody>
	    			</table>
    			</div>
    		</div>
		</div>
	</div>
	<?php if($this->session->flashdata('success')){?>
		<div class="col-sm-12 m-t-10 text-center">
			<div class="alert alert-success"> <?php echo $this->session->flashdata('success'); ?> </div>
		</div>
	<?php } ?>
	<?php if($this->session->flashdata('error')){?>
		<div class="col-sm-12 m-t-10 text-center">
			<div class="alert alert-danger"> <?php echo $this->session->flashdata('error'); ?> </div>
		</div>
	<?php } ?>
</div>

<script type="text/javascript">
    $(function() {
        start_plan_expiration_timer();
    });
</script>