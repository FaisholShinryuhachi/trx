<?php print_message($this); ?>

<div class="row">

    <div class="col-12">

        <form id="form_plan">

            <div class="row">

                <div class="col-sm-12">

                    <div class="card m-b-30">

                        <div class="card-header">

                        	<h4 class="header-title pull-left m-0">Plans</h4>

                        	<a href="<?= base_url('membership/plan_create') ?>" class="btn btn-sm btn-primary pull-right">Create New</a>

                        </div>

                        <div class="card-body p-0">



                        	<div class="table-responsive m-0">

	                        	<table class="table table-striped">

	                        		<thead>

	                        			<tr>

	                        				<th width="1">ID</th>

	                        				<th>Name</th>

	                        				<th>Price</th>

	                        				<th>Bonus</th>

	                        				<th>Type</th>

	                        				<th>Billing Period</th>

	                        				<th>Period Days</th>

	                        				<th>Is Display</th>

	                        				<th width="180px">Updated at</th>

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

	                        					<td><?= $plan->name ?></td>

	                        					<td><?= c_format($plan->price) ?></td>

	                        					<td><?= c_format($plan->bonus) ?></td>

	                        					<td><?= $plan->type ?></td>

	                        					<td><?= $plan->billing_period_plain ?></td>

	                        					<td><?= $plan->billing_period == 'lifetime_free' ? 'Life Time' : $plan->total_day ?></td>

	                        					<td><?= $plan->status ? 'Yes' : 'No' ?></td>

	                        					<td><?= dateFormat($plan->updated_at) ?></td>

	                        					<td>

	                        						<a href="<?= base_url('membership/plan_edit/'. $plan->id) ?>" class="btn btn-sm btn-primary">Edit</a>

	                        						<a href="javascript:void(0)" onclick="delete_confirm('<?= base_url('membership/plan_delete/'. $plan->id) ?>')" class="btn btn-sm btn-danger">Delete</a>

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

        </form>

    </div> 

</div>



<script type="text/javascript">

	function delete_confirm(url) {

		Swal.fire({

			title: 'Are you sure?',

			text: "You won't be able to revert this!",

			icon: 'warning',

			showCancelButton: true,

			confirmButtonText: 'Yes, delete it!',

			cancelButtonText: 'No, cancel!',

			reverseButtons: true

		}).then((result) => {

			if (result.value) {

				window.location.href = url;

			}

		})

		return false;

	}

</script>