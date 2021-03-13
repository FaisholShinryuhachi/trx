<?php
    $db =& get_instance();
    $userdetails = $db->userdetails();
    $products = $db->Product_model;
    $notifications_count = $products->getnotificationnew_count('admin',null);
?>

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/flag/css/main.min.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/plugins/table/datatables.min.css") ?>">
<script type="text/javascript" src="<?= base_url("assets/plugins/table/datatables.min.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/plugins/table/dataTables.responsive.min.js") ?>"></script>

<style>
    .counter{
        font-size: 1.7vw;
        font-weight: bold;
    }
    .market-tool-card .card-body{
        height: 280px !important;
        overflow:auto;
    }
    @media(max-width: 1200px){
        .counter{
            font-size: 1.3rem;
        }
    }
</style>


<div class="row mb-4">
    <div class="col-xl-3 mb-2">
        <div class="card border  shadow-sm counter-card h-100">
            <div class="card-body p-4  d-flex align-items-center">
                <div class="text-left">
                    <ul class="list-inline row mb-0 clearfix">
                        <li class="col-12">
                            <p class="mb-0 text-muted">Balance</p>
                            <p class="m-b-5 counter text-primary set-color"><?= c_format($user_totals['user_balance']) ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-2">
        <div class="card border shadow-sm h-100">
            <div class="card-header bg-transparent  border-0 pb-0">
                <h6 class='card-title text-center text-uppercase text-dark m-0 font-weight-bold'>Total Sales</h6>
            </div>
            <div class="card-body p-4">
                <div class="text-center">
                    <ul class="list-inline row mb-0 clearfix">
                        <li class="col-6">
                            <p class="m-b-5 counter text-primary set-color"><?= c_format($user_totals['sale_localstore_total'] + $user_totals['order_external_total']) ?></p>
                            <p class="mb-0 text-muted">Admin Store</p>
                        </li>
                        <li class="col-6 border-left">
                            <p class="m-b-5 counter text-primary set-color"><?= c_format($user_totals['vendor_sale_localstore_total'] + $user_totals['vendor_order_external_total']) ?></p>
                            <p class="mb-0 text-muted">Vendor Store</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-2">
        <div class="card border  shadow-sm h-100">
            <div class="card-header bg-transparent  border-0 pb-0">
                <h6 class='card-title text-center text-uppercase text-dark m-0 font-weight-bold'>Actions</h6>
            </div>
            <div class="card-body p-4">
                <div class="text-center">
                    <ul class="list-inline row mb-0 clearfix">
                        <li class="col-12">
                            <p class="m-b-5 counter text-primary">
                            	<span class="set-color"><?= (int)$user_totals['click_action_total'] + (int)$user_totals['vendor_action_external_total'] ?></span> / 
                            	<?= c_format($user_totals['click_action_commission']) ?>
                            	

                        	</p>
                            <p class="mb-0 text-muted">Vendor pay <span class="set-color"><?= c_format($user_totals['vendor_click_external_commission_pay']) ?></span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 mb-2">
        <div class="card border shadow-sm h-100">
            <div class="card-header bg-transparent  border-0 pb-0">
                <h6 class='card-title text-center text-uppercase text-dark m-0 font-weight-bold'>Clicks</h6>
            </div>
            <div class="card-body p-4">
                <div class="text-center">
                    <ul class="list-inline row mb-0 clearfix">
                        <li class="col-12">
                            <p class="m-b-5 counter text-primary">
                                <span class="set-color">
                                    <?= (int)(
                                        $user_totals['click_localstore_total'] +
                                        $user_totals['vendor_click_localstore_total'] +
                                        $user_totals['click_external_total'] +
                                        $user_totals['vendor_click_external_total'] +
                                        $user_totals['click_form_total'] 
                                    ) ?>
                                </span> /
                                <span class="set-color">
                                    <?= c_format(
                                        $user_totals['click_localstore_commission'] +
                                        $user_totals['click_integration_commission'] +
                                        $user_totals['click_external_commission'] +
                                        $user_totals['click_form_commission']
                                    ) ?>
                                </span>
                            </p>
                            <p class="mb-0 text-muted">Vendor pay 
                                <span class="set-color">
                                    <?= c_format(
                                        $user_totals['vendor_click_localstore_commission_pay'] +
                                        $user_totals['vendor_click_external_commission_pay']
                                    ) ?>
                                </span>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="new-card border mt-2 card-toggle shadow-sm m-0">
            <div class="card-header">
                <h6 class='card-title'>Wallet Statistics</h6>
                <div class="card-options">
                    <button class="open-close-button"></button>
                </div>
            </div>
            <div class="card-container">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span>Hold</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['wallet_unpaid_amounton_hold_count'] ?> / <span class="set-color"><?= c_format($user_totals['wallet_on_hold_amount']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>Unpaid</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['wallet_unpaid_count'] ?> / <span class="set-color"><?= c_format($user_totals['wallet_unpaid_amount']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>Request</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['wallet_request_sent_count'] ?> / <span class="set-color"><?= c_format($user_totals['wallet_request_sent_amount']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>Paid</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['wallet_accept_count'] ?> / <span class="set-color"><?= c_format($user_totals['wallet_accept_amount']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>Cancel</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['wallet_cancel_count'] ?> / <span class="set-color"><?= c_format($user_totals['wallet_cancel_amount']) ?></span></span>  
                    </li>
                </ul>

                <div class="card-body">
                    <footer class="blockquote-footer font-14">
                        Check All Transactions <cite title="Source Title"><a href="<?= base_url('/usercontrol/mywallet/') ?>">Click Here</a></cite>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="new-card border mt-2 card-toggle shadow-sm m-0">
            <div class="card-header">
                <h6 class='card-title'>All Clicks</h6>
                <div class="card-options">
                    <button class="open-close-button"></button>
                </div>
            </div>
            <div class="card-container">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span>LocalStore</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['click_localstore_total'] ?> / <span class="set-color"><?= c_format($user_totals['click_localstore_commission']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>External</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['click_external_total'] ?> / <span class="set-color"><?= c_format($user_totals['click_external_commission']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>Forms</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['click_form_total'] ?> / <span class="set-color"><?= c_format($user_totals['click_form_commission']) ?></span></span>  
                    </li>


                    <li class="list-group-item">
                        <span>Vendor LocalStore</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['vendor_click_localstore_total'] ?> / <span class="set-color"><?= c_format($user_totals['vendor_click_localstore_commission_pay']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>Vendor External</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['vendor_click_external_total'] ?> / <span class="set-color"><?= c_format($user_totals['vendor_click_external_commission_pay']) ?></span></span>  
                    </li>
                </ul>
                <div class="card-body">
                    <footer class="blockquote-footer font-14">
                        All Clicks 
                        <cite title="">
                            <?= (int)(
                                $user_totals['click_localstore_total'] +
                                $user_totals['click_external_total'] +
                                $user_totals['click_form_total'] 
                            ) ?> /
                            <span class="set-color">
                                <?= c_format(
                                    $user_totals['click_localstore_commission'] +
                                    $user_totals['click_external_commission'] +
                                    $user_totals['click_form_commission']
                                ) ?>
                            </span>
                        </cite>
                    </footer>
                    <footer class="blockquote-footer font-14">
                        All Vendor Clicks
                        <cite title="">
                            <?= (int)(
                                $user_totals['vendor_click_localstore_total'] +
                                $user_totals['vendor_click_external_total'] 
                            ) ?> /
                            <span class="set-color">
                                <?= c_format(
                                    $user_totals['vendor_click_localstore_commission_pay'] +
                                    $user_totals['vendor_click_external_commission_pay']
                                ) ?>
                            </span>
                        </cite>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="new-card border mt-2 card-toggle shadow-sm m-0">
            <div class="card-header">
                <h6 class='card-title'>Order Commission</h6>
                <div class="card-options">
                    <button class="open-close-button"></button>
                </div>
            </div>
            <div class="card-container">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span>LocalStore</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['sale_localstore_count'] ?> / <span class="set-color"><?= c_format($user_totals['sale_localstore_commission']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>External</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['order_external_count'] ?> / <span class="set-color"><?= c_format($user_totals['order_external_commission']) ?></span></span>
                    </li>

                    <li class="list-group-item">
                        <span>Vendor Localstore</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['vendor_sale_localstore_count'] ?> / <span class="set-color"><?= c_format(-$user_totals['vendor_sale_localstore_commission_pay']) ?></span></span>  
                    </li>
                    <li class="list-group-item">
                        <span>Vendor External</span>
                        <span class="text-right pull-right text-primary font-weight-bold"><?= (int)$user_totals['vendor_order_external_count'] ?> / <span class="set-color"><?= c_format($user_totals['vendor_order_external_commission_pay']) ?></span></span>  
                    </li>
                </ul>
                <div class="card-body">
                    <footer class="blockquote-footer font-14">
                        All Orders 
                        <cite title="">
                            <?= (int)(
                                $user_totals['sale_localstore_count'] +
                                $user_totals['order_external_count'] 
                            ) ?> /
                            <span class="set-color">
                                <?= c_format(
                                    $user_totals['sale_localstore_commission'] +
                                    $user_totals['order_external_commission'] 
                                ) ?>
                            </span>
                        </cite>
                    </footer>

                    <footer class="blockquote-footer font-14">
                        All Vendor Orders 
                        <cite title="">
                            <?= (int)(
                                $user_totals['vendor_sale_localstore_count'] +
                                $user_totals['vendor_order_external_count'] 
                            ) ?> /
                            <span class="set-color">
                                <?= c_format(
                                    $user_totals['vendor_sale_localstore_commission_pay'] +
                                    (-$user_totals['vendor_order_external_commission_pay']) 
                                ) ?>
                            </span>
                        </cite>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <?php if($refer_status) { ?>
            <div class="new-card border mt-2 card-toggle shadow-sm m-0">
                <div class="card-header">
                    <h6 class="card-title">Refered Levels</h6>
                    <div class="card-options">
                        <button class="open-close-button"></button>
                    </div>
                </div>
                <div class="card-container">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span>Product Click</span>
                            <span class="text-right pull-right text-primary font-weight-bold">
                                <?= (int)$refer_total['total_product_click']['clicks'] ?> /
                                <span class="set-color"><?= c_format($refer_total['total_product_click']['amounts']) ?></span>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span>Sale</span>
                            <span class="text-right pull-right text-primary font-weight-bold">
                                <?= (int)$refer_total['total_product_sale']['counts'] ?> /
                                <span class="set-color"><?= c_format($refer_total['total_product_sale']['amounts']) ?></span>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span>General Click</span>
                            <span class="text-right pull-right text-primary font-weight-bold">
                                <?= (int)$refer_total['total_ganeral_click']['total_clicks'] ?> /
                                <span class="set-color"><?= c_format($refer_total['total_ganeral_click']['total_amount']) ?></span>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span>Action</span>
                            <span class="text-right pull-right text-primary font-weight-bold">
                                <?= (int)$refer_total['total_action']['click_count'] ?> /
                                <span class="set-color"><?= c_format($refer_total['total_action']['total_amount']) ?></span>
                            </span>
                        </li>
                    </ul> 
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
         <div class="new-card shadow-sm">
            <div class="card-header border-0">
                <h5 class="card-title"><?php echo __('user.user_overview') ?></h5>
                <div class="card-options">
                    <select onchange="loadDashboardChart()" class="renderChart chart-input form-control mr-1" name="group">
                        <option value="day" ><?= __('admin.day') ?></option>
                        <option value="week"><?= __('admin.week') ?></option>
                        <option value="month" selected=""><?= __('admin.month') ?></option>
                        <option value="year"><?= __('admin.year') ?></option>
                    </select>

                    <select onchange="loadDashboardChart()" class="yearSelection chart-input form-control" name='year'>
                        <?php for($i=2016; $i<= date("Y"); $i++){ ?>
                            <option value="<?= $i ?>" <?php echo $i==date("Y") ? "selected='selected'" : '' ?>><?= $i ?></option>
                        <?php  } ?>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                    <li class="list-inline-item d-block d-sm-inline-block m-auto">
                        <i class="mdi mdi-arrow-up-bold-circle-outline text-success"></i>
                        <h5 class="mb-0 ajax-weekly_balance"><?= $user_totals_week ?></h5>
                        <p class="font-14"><?php echo __('admin.weekly_earnings') ?></p>
                    </li>
                    <li class="list-inline-item d-block d-sm-inline-block m-auto">
                        <i class="mdi mdi-arrow-down-bold-circle-outline text-danger"></i>
                        <h5 class="mb-0 ajax-monthly_balance"><?= $user_totals_month ?></h5>
                        <p class="font-14"><?php echo __('admin.monthly_earnings') ?></p>
                    </li>
                    <li class="list-inline-item d-block d-sm-inline-block m-auto">
                        <i class="mdi mdi-arrow-up-bold-circle-outline text-success"></i>
                        <h5 class="mb-0 ajax-yearly_balance"><?= $user_totals_year ?></h5>
                        <p class="font-14"><?php echo __('admin.yearly_earnings') ?></p>
                    </li>
                </ul>

                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                <canvas style="height:600px" id="dashboard-chart" class="ct-chart ct-golden-section"></canvas>

                <div id="dashboard-chart-empty" class="ct-chart d-none ct-golden-section">
                    <div class="text-center">
                        <img class="img-responsive" src="<?php echo base_url(); ?>assets/vertical/assets/images/no-data-2.png" style="margin-top:10px;">
                        <h3 class="m-t-40 text-center"><?= __('admin.not_activity_yet') ?></h3>
                    </div>
                </div>

                <script type="text/javascript">
                    var ctx = document.getElementById('dashboard-chart').getContext('2d');
                    var chartData = <?= json_encode($chart) ?>;

                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {},
                        options: {
                            showLines: true,
                            tooltips: {
                                mode: 'index',
                                intersect: false
                            },
                            scales: {},
                            responsive: true,
                        }
                    });

                    function renderDashboardChart(chartData){
                        var t = ctx.createLinearGradient(0, 0, 0, 150);
                        t.addColorStop(0, Chart.helpers.color("#fd397a").alpha(.3).rgbString());
                        t.addColorStop(1, Chart.helpers.color("#fd397a").alpha(0).rgbString());

                        var g = ctx.createLinearGradient(0, 0, 0, 150);
                        g.addColorStop(0, Chart.helpers.color("#1dc9b7").alpha(.3).rgbString());
                        g.addColorStop(1, Chart.helpers.color("#1dc9b7").alpha(0).rgbString());
                        
                        chart.data = {
                            labels: Object.values(chartData['keys']),
                            datasets: [
                                {
                                    label: 'Action Count',
                                    backgroundColor: 'rgb(54, 162, 235)',
                                    borderColor: 'rgb(54, 162, 235)',
                                    data: Object.values(chartData['action_count']),
                                },
                                {

                                    label: 'Order Count',
                                    backgroundColor: 'rgb(255, 205, 86)',
                                    borderColor: 'rgb(255, 205, 86)',
                                    data: Object.values(chartData['order_count']),
                                },
                                {
                                    type: "line",
                                    borderWidth:2,
                                    label: 'Order Commission',
                                    backgroundColor: g,
                                    borderColor: "#1dc9b7",
                                    data: Object.values(chartData['order_commission']),
                                },
                                {
                                    label: 'Action Commission',
                                    backgroundColor: 'rgb(75, 192, 192)',
                                    borderColor: 'rgb(75, 192, 192)',
                                    data: Object.values(chartData['action_commission']),
                                },
                                
                                {
                                    type: "line",
                                    label: 'Order total',
                                    backgroundColor: t,
                                    borderColor: "#fd397a",
                                    borderWidth:2,
                                    data: Object.values(chartData['order_total']),
                                },
                            ]
                        }

                        chart.update();
                    }

                    function loadDashboardChart(){
                        $.ajax({
                            url:'<?= base_url("usercontrol/dashboard?getChartData=1") ?>',
                            type:'POST',
                            dataType:'json',
                            data:$(".chart-input"),
                            beforeSend:function(){},
                            complete:function(){},
                            success:function(json){
                               renderDashboardChart(json['chart']);
                            },
                        })
                    }

                    loadDashboardChart()
                </script>
            </div>
        </div>
        
        <div class="new-card market-tool-card shadow-sm">
            <div class="card-header border-0">
                <h5 class="card-title"><?= __('user.affiliates_links...') ?></h5>
                <div class="card-options">
                    <label class="checkbox">
                        <input type="checkbox" <?= isset($_GET['dvl']) ? 'checked' : '' ?> class="display-vendor-links"> Display Vendor Links
                    </label>
                </div>
            </div>
            <script type="text/javascript">
                $(".display-vendor-links").change(function(){
                    getMarketTools()
                })

                function getMarketTools() {
                    $this = $(this);
                    $.ajax({
                        url:'<?= base_url('usercontrol/dashboard') ?>',
                        type:'POST',
                        dataType:'json',
                        data:{
                            dvl:$(".display-vendor-links").prop("checked")
                        },
                        beforeSend:function(){
                            $(".market-tool-card .card-body").html("<p class='text-center py-5'>LOADING....</p>")
                        },
                        complete:function(){
                            
                        },
                        success:function(json){
                            if (json['html']) {
                                $(".market-tool-card .card-body").html(json['html'])
                            }
                        },
                    })
                }

                getMarketTools()
            </script>
            <div class="card-body p-0 h-100">
               
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <?php if($MembershipSetting['status']){ ?>
        <div class="new-card pb-3 shadow-sm m-0">
            <div class="card-header">
                <h5 class="card-title">Membership Plan</small></h5>
            </div>
            
            <?php if ((isset($is_lifetime_plan) && $is_lifetime_plan) || !$isMembershipAccess) { ?>
                <div class="card-body">
                    <h4 class="text-center text-success">Lifetime free membership</h4>
                    <p class="text-center text-muted">You have a lifetime free membership. you can access all functions of script lifetime</p>
                </div>
            <?php } ?>
            <?php if (isset($plan) && $plan) { ?>
                <?php 
                    $checkDay = max((int)$MembershipSetting['notificationbefore'],1);
                ?>
                <?php if($plan->remainDay() != 'lifetime' && $plan->remainDay() <= $checkDay && !$plan->is_lifetime){ ?>
                    <div class="alert bg-danger text-white border-radius-0 alert-danger">Your account will expire in <span data-time-remains="<?= $plan->strToTimeRemains(); ?>"><?= $plan->remainDay() ?></span> <a class="text-white font-weight-bold" href="<?= base_url('/usercontrol/purchase_plan/') ?>">click here</a> to renew plan</div>
                <?php } ?>
                <div class="card-body">
                    <?php if($isMembershipAccess) { ?>
                    <h4 class="text-success"><span class="text-muted">Plan: </span><?= $plan->plan ? $plan->plan->name : '' ?></h4>
                    <?php } ?>
                </div>
                <?php if($isMembershipAccess) { ?>
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
                        <span>Plan Status</span>
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
                <?php } ?>
            <?php } ?>
        </div>
        <?php if($isMembershipAccess) { ?>
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
        <?php } ?>
        <?php } ?>

        <div class="new-card pb-3 shadow-sm">
            <div class="card-header">
                <h5 class="card-title"><small class="text-muted">Your Affiliate ID : <?= $userdetails['id'] ?></small></h5>
                <div class="card-options">
                    <?php if(($store['status'] || $refer_status)){ ?>
                    <label class="m-0">
                        <input type="checkbox" id="show_my_id"> Show My ID
                    </label>
                <?php } ?>
                </div>
            </div>
            <div class="card-body">
                <?php if($refer_status){ ?>
                
                <?php if($register_slug){ ?>
                <?php $share_url = base_url($register_slug); ?>
                <?php }else{ ?>
                <?php $share_url = base_url('register/' . base64_encode($userdetails['id'])); ?>
                <?php } ?>

                <h6>Your Unique Reseller link</h6>
                <div class="row">
                <div class="col-11 p-0 pr-1">
                    <div class="form-group show-tiny-link">
                        <div class="copy-input input-group ">
                            <input type="text" readonly="readonly" value="<?= $share_url ?>" class="form-control input-register-url-0">
                            <button copyToClipboard="<?= $share_url ?>" class="input-group-addon"></button>
                            <button type="button" class="btn btn-sm btn-dark btn-model-slug" data-type="register" data-related-id="0" data-input-class="input-register-url-0"><i class="fa fa-cog"></i></button>
                        </div>
                    </div>
                    <div class="form-group show-mega-link d-none">
                        <div class="copy-input input-group ">
                            <input type="text" readonly="readonly" value="<?= $share_url ?>/?id=<?= $userdetails['id'] ?>" class="form-control input-register-url-0" data-addition-url="/?id=<?= $userdetails['id'] ?>">
                            <button copyToClipboard="<?= $share_url ?>/?id=<?= $userdetails['id'] ?>" class="input-group-addon"></button>
                            <button type="button" class="btn btn-sm btn-dark btn-model-slug" data-type="register" data-related-id="0" data-input-class="input-register-url-0"><i class="fa fa-cog"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                <span class="btn btn-md btn-primary" data-social-share data-share-url="<?= $share_url; ?>?id=<?= $userdetails['id'] ?>" data-share-title="" data-share-desc=""><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                </div>
                </div>
        
                <div><hr></div>
                <?php } ?>


                <?php if(($store['status'])){ ?>
                
                <?php if($store_slug){ ?>
                <?php $share_url = base_url($store_slug); ?>
                <?php }else{ ?>
                <?php $share_url = base_url('store/' . base64_encode($userdetails['id'])); ?>
                <?php } ?>

                <h6>Affiliate Store URL</h6>

                <div class="row">
                <div class="col-11 p-0 pr-1">
                    <div class="form-group show-tiny-link">
                        <div class="copy-input input-group ">
                            <input type="text" readonly="readonly" value="<?= $share_url ?>" class="form-control input-store-url-0">
                            <button copyToClipboard="<?= $share_url ?>" class="input-group-addon"></button>
                            <button type="button" class="btn btn-sm btn-dark btn-model-slug" data-type="store" data-related-id="0" data-input-class="input-store-url-0"><i class="fa fa-cog"></i></button>
                        </div>
                    </div>
                    <div class="form-group show-mega-link d-none">
                        <div class="copy-input input-group ">
                            <input type="text" readonly="readonly" value="<?= $share_url ?>/?id=<?= $userdetails['id'] ?>" class="form-control input-store-url-0" data-addition-url="/?id=<?= $userdetails['id'] ?>">
                            <button copyToClipboard="<?= $share_url ?>/?id=<?= $userdetails['id'] ?>" class="input-group-addon"></button>
                            <button type="button" class="btn btn-sm btn-dark btn-model-slug" data-type="store" data-related-id="0" data-input-class="input-store-url-0"><i class="fa fa-cog"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                <span class="btn btn-md btn-primary" data-social-share data-share-url="<?= $share_url; ?>?id=<?= $userdetails['id'] ?>" data-share-title="" data-share-desc=""><i class="fa fa-share-alt" aria-hidden="true"></i></span>
                </div>
                </div>
            <?php } ?>
            </div>
        </div>
        
                <script type="text/javascript">
                    $("#show_my_id").change(function(){
                        if($(this).prop("checked")){
                            $(".show-mega-link").removeClass("d-none");
                            $(".show-tiny-link").addClass("d-none");
                        } else {
                            $(".show-mega-link").addClass("d-none");
                            $(".show-tiny-link").removeClass("d-none");
                        }
                    })
                </script>


        <div class="new-card mt-4 shadow-sm">
            <div class="card-header border-0">
                <h5 class="card-title"><?= __('admin.popular_affiliates') ?></h5>
            </div>
            <div class="card-body p-0">
                <div role="tabpanel" id="top-users-data">
                    <div class="data-here">
                        <table class="table-striped table responsive no-wrap">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Balance</th>
                                    <th>Commission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($populer_users as $key => $users) { ?>
                                    <tr>
                                        <?php
                                            $flag = '';
                                            if ($users['sortname'] != '') {
                                                $flag = base_url('assets/vertical/assets/images/flags/' . strtolower($users['sortname']) . '.png');
                                            }
                                        ?>
                                        <td><span class="user-avatar" style="background-image:url('<?= $products->getAvatar($users['avatar']) ?>')"></span></td>
                                        <td><?php echo $users['firstname']; ?> <?php echo $users['lastname']; ?></td>
                                        <td><?= strtoupper($users['sortname']) ?> <img class="country-flag" src="<?php echo $flag; ?>"></td>
                                        <td><?php echo c_format($users['amount']); ?></td>
                                        <td><?php echo c_format($users['all_commition']); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <script type="text/javascript">
                        var dataTableUser = $("#top-users-data table").dataTable({
                            "paging":   false,
                            "ordering": false,
                            "searching": false,
                            "info":     false
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!------AFFILIATE LINKS END--------->
<?= $social_share_modal ?>
<script type="text/javascript">

    $(function() {
        start_plan_expiration_timer();
    });

    function setColors() {
        $(".set-color").each(function(i,ele){
            var val =  parseInt($(ele).html().toString().replace(/[^0-9-.]/g, '') || 0);

            $(ele).removeClass("text-primary")
            $(ele).removeClass("text-danger")
            if(val >= 0){
                $(ele).addClass("text-primary");
            } else{
                $(ele).addClass("text-danger");
            }
        })
    }

    setColors();
</script>
<script type="text/javascript">
    $(".card-toggle .open-close-button").click(function(){
        $(this).parents(".card-toggle").toggleClass("open")
    })
</script>