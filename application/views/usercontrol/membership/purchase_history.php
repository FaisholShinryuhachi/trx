<div class="row">

	<div class="col-sm-12">

		<div class="card">

			<div class="card-header">

				<h5 class="card-title m-0">Purchase History</h5>

			</div>

			<div class="card-body p-0">

            	<div class="table-responsive m-0">

                	<table class="table table-striped">

                		<thead>

                			<tr>

                				<th width="1">ID</th>

                				<th>Plan Name</th>

                				<th>Price</th>

                				<th>Type</th>

                				<th>Is Active</th>

                				<th>Status</th>

                                <th>Payment Method</th>

                				<th>Remaining Time</th>

                				<th>Start Date</th>

                				<th>End Date Date</th>

                				<th width="180px">Created at</th>

                				<th width="180px">Action</th>

                			</tr>

                		</thead>

                		<tbody>

                			<?php if(count($plans) == 0){ ?>

                        		<tr>

                        			<td colspan="100%" class="text-center">No records found...</td>

                        		</tr>

                        	<?php } ?>

                			<?php foreach ($plans as $key => $plan) { ?>

                				<tr>

                					<td><?= $plan->id ?></td>

                					<td><?= ($plan->plan ? $plan->plan->name : '') ?></td>

                					<td><?= c_format($plan->total) ?></td>

                					<td><?= ($plan->plan ? $plan->plan->type : '') ?></td>

                					<td><?= $plan->active_text ?></td>

                					<td><?= $plan->status_text ?></td>

                                    <td>
                                        <?= $plan->payment_method ?>
                                        <?php if($plan->payment_details) { ?>
                                        <?php $payment_details = json_decode($plan->payment_details, true); ?>
                                            <?php if(isset($payment_details['transaction_id'])) { ?>
                                            <br><b>Transaction ID:</b>  <?= $payment_details['transaction_id'] ?>
                                            <?php } ?>
                                            <?php if(isset($payment_details['payment_status'])) { ?>
                                            <br><b>Payment Status:</b> <span class="badge <?php if(in_array(strtolower($payment_details['payment_status']), array('completed','succeeded','success','complete'))) { ?>badge-success<?php }else{ ?>badge-danger<?php } ?>"><?= $payment_details['payment_status'] ?></span>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>

                					<td>
									
										<?php if($plan->status_id == 1 && !$plan->is_lifetime) { ?>
											<span data-time-remains="<?= $plan->strToTimeRemains(); ?>"><?= $plan->remainDay() ?></span>
										<?php } else { ?>
											<?= $plan->remainDay() ?>
										<? } ?>
										
									</td>

                					<td><?= dateFormat($plan->started_at,'d/m/Y') ?></td>

                					<td><?= $plan->expire_text ?></td>

                					<td><?= dateFormat($plan->created_at) ?></td>

                					<td>

                						<a href="<?= base_url('usercontrol/membership_purchase_details/'. $plan->id) ?>" class="btn btn-sm btn-primary">Details</a>

                					</td>

                				</tr>

                			<?php } ?>

                		</tbody>

                	</table>

            	</div>

            </div>

            <?php if($links){ ?>

                <div class="card-footer text-right">

                	<div class="pull-left">

                		<?= $links[1] ?>

                	</div>

                	<div class="pull-right">

                    	<ul class="pagination m-0"><?= $links[0] ?></ul>

                    </div>

                </div>

           <?php } ?>

		</div>

	</div>

</div>

<script type="text/javascript">
    $(function() {
        start_plan_expiration_timer();
    });
</script>