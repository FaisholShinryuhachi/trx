<?php print_message($this); ?>
<div class="row">
	<div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="dashboard-box box-purple">
                    <div class="text"><label class="m-0">Order Total</label></div>
                    <div class="count"><h1><?= $dashboard_totals->week_ago_total_orders ?></h1></div>
                    <div class="count"><h6><?= c_format($dashboard_totals->week_ago_total_order_amount) ?></h6></div>
                    <div class="title">Last 7 Days</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-box box-purple">
                    <div class="text"><label class="m-0">Order Total</label></div>
                    <div class="count"><h1><?= $dashboard_totals->month_ago_total_orders ?></h1></div>
                    <div class="count"><h6><?= c_format($dashboard_totals->month_ago_total_order_amount) ?></h6></div>
                    <div class="title">Last 30 Days</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-box box-purple">
                    <div class="text"><label class="m-0">Order Total</label></div>
                    <div class="count"><h1><?= $dashboard_totals->year_ago_total_orders ?></h1></div>
                    <div class="count"><h6><?= c_format($dashboard_totals->year_ago_total_order_amount) ?></h6></div>
                    <div class="title">This Year</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-box box-purple">
                    <div class="text"><label class="m-0">Order Total</label></div>
                    <div class="count"><h1><?= $dashboard_totals->all_time_total_orders ?></h1></div>
                    <div class="count"><h6><?= c_format($dashboard_totals->all_time_total_order_amount) ?></h6></div>
                    <div class="title">All Time</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-box box-purple">
                    <div class="text"><label class="m-0">Bonus Commission</label></div>
                    <div class="count"><h6><?= c_format($dashboard_totals->week_ago_total_bonus_commission) ?></h6></div>
                    <div class="title">Last 7 Days</div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="dashboard-box box-purple">
                    <div class="text"><label class="m-0">Bonus Commission</label></div>
                    <div class="count"><h6><?= c_format($dashboard_totals->month_ago_total_bonus_commission) ?></h6></div>
                    <div class="title">Last 30 Days</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-box box-purple">
                    <div class="text"><label class="m-0">Bonus Commission</label></div>
                    <div class="count"><h6><?= c_format($dashboard_totals->year_ago_total_bonus_commission) ?></h6></div>
                    <div class="title">This Year</div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-box box-purple">
                    <div class="text"><label class="m-0">Bonus Commission</label></div>
                    <div class="count"><h6><?= c_format($dashboard_totals->all_time_total_bonus_commission) ?></h6></div>
                    <div class="title">All Time</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title m-0">Purchase History</h5>
                <form>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="form-control filter_status" name="status_id">
                                    <option value="">Filter By Status</option>
                                    <?php foreach (App\MembershipPlan::$status_list as $key => $value) { ?>
                                        <option <?= (isset($_GET['status_id']) && $_GET['status_id'] != '' && $_GET['status_id'] == $key) ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="form-control" name="user_id">
                                    <option value="">Filter By User</option>
                                    <?php foreach ($users as $key => $value) { ?>
                                    <option <?= isset($user_id) && $user_id == $value['id'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input autocomplete="off" type="text" name="date" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>" class="form-control daterange-picker" placeholder='Filter By Date'>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <button class="btn btn-primary">Search</button>
                                <button type="button" class="btn btn-delete-multiple d-none btn-danger">Delete Selected</button>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
			<div class="card-body p-0">
                <form id="delete-form" method="post" action="<?= base_url('membership/odrer_plan_delete_multiple/') ?>">
                	<div class="table-responsive m-0">
                    	<table class="table table-striped">
                    		<thead>
                    			<tr>
                    				<th width="1">
                                        <input type="checkbox" class="select-all">
                                    </th>
                    				<th>Username</th>
                                    <th>Plan Name</th>
                    				<th>Price</th>
                    				<th>Type</th>
                    				<th>Is Active</th>
                    				<th>Plan Status</th>
                                    <th>Payment Method</th>
                    				<th>Remaining Time</th>
                    				<th>Start Date</th>
                    				<th>End Date Date</th>
                    				<th width="180px">Created at</th>
                    				<th>Action</th>
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
                    					<td>
                                            <?php if($plan->is_active == 0){ ?>
                                                <input type="checkbox" name="delete[]" value="<?= $plan->id ?>" class="single-check">
                                            <?php } ?>
                                            <span class="badge badge-secondary">
                                                ID <?= $plan->id ?>
                                            </span>
                                        </td>
                    					<td><?= ($plan->user ? $plan->user->username : '') ?></td>
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
                                                <br><b>Payment Status:</b> <span class="badge <?php if(in_array(strtolower($payment_details['payment_status']), array('completed','succeeded','succcess'))) { ?>badge-success<?php }else{ ?>badge-danger<?php } ?>"><?= ucfirst($payment_details['payment_status']) ?></span>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                    					<td><?= $plan->remainDay() ?></td>
                    					<td><?= dateFormat($plan->started_at,'d/m/Y') ?></td>
                    					<td><?= $plan->expire_text ?></td>
                    					<td><?= dateFormat($plan->created_at) ?></td>
                    					<td>
                    						<a href="<?= base_url('membership/membership_purchase_edit/'. $plan->id) ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <?php if($plan->is_active == 0){ ?>
                                                <a href="javascript:void(0)" onclick="delete_confirm('<?= base_url('membership/odrer_plan_delete/'. $plan->id) ?>')" class="btn btn-sm btn-danger">Delete</a>
                                            <?php } ?>
                    					</td>
                    				</tr>
                    			<?php } ?>
                    		</tbody>
                    	</table>
                	</div>
                </form>
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

<script src="<?= base_url('assets/plugins/datatable') ?>/moment.js"></script>
<script type="text/javascript" src="<?= base_url('assets/plugins/datatable') ?>/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/datatable') ?>/daterangepicker.css" />
<script type="text/javascript">
    $(".single-check").change(buttonToggle);
    $(".select-all").change(function(){
        $(".single-check").prop("checked", $(this).prop("checked"))
        buttonToggle();
    })

    $(".btn-delete-multiple").click(function(){
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
                $("#delete-form")[0].submit();
            }
        })
    })

    function buttonToggle() {
        if($(".single-check:checked").length){
            $(".btn-delete-multiple").removeClass("d-none")
        } else {
            $(".btn-delete-multiple").addClass("d-none")
        }
    }

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

    $('[name="user_id"]').select2();
    $('.daterange-picker').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            cancelLabel: 'Clear',
            format: 'DD-M-YYYY'
        }
    });
    $('.daterange-picker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-M-YYYY') + ' - ' + picker.endDate.format('DD-M-YYYY'));
    });
    $('.daterange-picker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
</script>