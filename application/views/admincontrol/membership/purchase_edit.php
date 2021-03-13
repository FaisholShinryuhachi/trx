<?php print_message($this); ?>

<div class="row">

	<div class="col-sm-6">

		<div class="card mb-2">

			<div class="card-header">

				<h5 class="card-title m-0">Purchase Details</h5>

			</div>

			<ul class="list-group list-group-flush">

				<li class="list-group-item"><b>ID:</b> <?= $plan->id ?></li>

				<li class="list-group-item"><b>Plan Name:</b> <?= ($plan->plan ? $plan->plan->name : '') ?></li>

				<li class="list-group-item"><b>Price:</b> <?= c_format(($plan->plan ? $plan->plan->price : 0)) ?></li>

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

				<li class="list-group-item"><b>Status:</b> <?= $plan->status_text ?></li>



				<?php if($plan->status_id == 1) { ?>

					<?php if(!$plan->is_lifetime) { ?>

					<li class="list-group-item"><b>Remaining Time:</b> <?= $plan->remainDay(); ?></li>

					<?php } ?>

					<li class="list-group-item"><b>Started On:</b> <?= dateFormat($plan->started_at,'d F Y, h:i A'); ?></li>

					<?php if(!$plan->is_lifetime) { ?>

					<li class="list-group-item"><b>Ending On:</b> <?= dateFormat($plan->expire_at,'d F Y, h:i A'); ?></li>

					<?php } ?>

				<?php } ?>

					

				<li class="list-group-item"><b>Created at:</b> <?= dateFormat($plan->created_at, 'd F Y, h:i A') ?></li>

			</ul>

		</div>



		

		<?php if(!$plan->is_lifetime && $plan->status_id == 1) { ?>

		<div class="card mb-2">

			<div class="card-header">

				<h5 class="card-title m-0">Edit Plan</h5>

			</div>

			<div class="card-body">

				<form id="plan-form">

					<div class="form-group">

						<label class="form-control-label">Expire On</label>

						<input type="text" value="<?= dateFormat($plan->expire_at,'d-m-Y H:i') ?>" name="expire_at" class='form-control datepicker'>

					</div>

				</form>

			</div>

			<div class="card-footer text-right">

				<button class="btn btn-save-plan btn-primary btn-sm">Save Plan</button>

			</div>

		</div>

		<?php } ?>

	</div>



	<div class="col-sm-6">

		<div class="card">

			<div class="card-header">

				<h5 class="card-title m-0">Plan Details</h5>

			</div>

    		<ul class="list-group list-group-flush">

                <li class="list-group-item"><b>Name:</b> <?= $plan->plan->name ?></li>

                <li class="list-group-item"><b>Type:</b> <?= $plan->plan->type ?></li>

                <li class="list-group-item"><b>Price:</b> <?= $plan->plan->price ?></li>

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

	    			<div class="card-body border-top">

	    				<h6 class="mt-0 text-primary">Status History</h6>

	    				<div class="add-history">

	    					<div class="form-group">

		    					<label class="form-control-label">Status</label>

		    					<select class="form-control" name="status_id">

		    						<option value="">Select Status</option>

		    						<?php foreach (App\MembershipPlan::$status_list as $key => $value) { ?>

		    							<option value="<?= $key ?>"><?= $value ?></option>

		    						<?php } ?>

		    					</select>

		    				</div>

		    				<div class="form-group">

		    					<label class="form-control-label">Comment</label>

		    					<textarea class="form-control" name="comment"></textarea>

		    				</div>

		    				<div class="form-footer text-right">

		    					<button type="button" class="btn-add-commnet btn btn-primary">Add History</button>

		    				</div>

	    				</div>

	    			</div>

    			</div>

    		</div>

		</div>

	</div>

</div>



<link href="<?php echo base_url('assets/css/datepicker.css'); ?>" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>



<script type="text/javascript">

	$(".datepicker").datetimepicker({ 

        autoclose: true, 

        todayHighlight: true,

		showSecond: true,

        format:"d-m-Y H:m"

    })



	$(".btn-save-plan").click(function(){

		$this = $(this);

		$.ajax({

			url:'<?= base_url("membership/submit_plan_update/". $plan->id) ?>',

			type:'POST',

			dataType:'json',

			data:$("#plan-form").serialize(),

			beforeSend:function(){$this.btn("loading");},

			complete:function(){$this.btn("reset");},

			success:function(json){

				$container = $("#plan-form");

				$container.find(".is-invalid").removeClass("is-invalid");

				$container.find("span.invalid-feedback").remove();

		

				if (json['location']) {

					window.location.href= json['location'];

				}

				

				if(json['errors']){

				    $.each(json['errors'], function(i,j){

				        $ele = $container.find('[name="'+ i +'"]');

				        if($ele){

				            $ele.addClass("is-invalid");

				            if($ele.parent(".input-group").length){

				                $ele.parent(".input-group").after("<span class='invalid-feedback'>"+ j +"</span>");

				            } else{

				                $ele.after("<span class='invalid-feedback'>"+ j +"</span>");

				            }

				        }

				    })

				}

			},

		})

	})



	$(".btn-add-commnet").click(function(){

		$this = $(this);

		$.ajax({

			url:'?addhistory=true',

			type:'POST',

			dataType:'json',

			data:$(".add-history :input"),

			beforeSend:function(){$this.btn("loading");},

			complete:function(){$this.btn("reset");},

			success:function(json){

				$container = $(".add-history");

				$container.find(".is-invalid").removeClass("is-invalid");

				$container.find("span.invalid-feedback").remove();

		

				if (json['reload']) {

					window.location.reload();

				}

				

				if(json['errors']){

				    $.each(json['errors'], function(i,j){

				        $ele = $container.find('[name="'+ i +'"]');

				        if($ele){

				            $ele.addClass("is-invalid");

				            if($ele.parent(".input-group").length){

				                $ele.parent(".input-group").after("<span class='invalid-feedback'>"+ j +"</span>");

				            } else{

				                $ele.after("<span class='invalid-feedback'>"+ j +"</span>");

				            }

				        }

				    })

				}

			},

		})

	})

</script>