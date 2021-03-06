	<div class="page-content-wrapper ">
	<div class="container">
		<h1><?= __('store.order_details') ?></h1>
		<div class="card m-t-30">
			<div class="card-body">
				<div class="row">
					<?php if($this->session->flashdata('success')){?>
						<div class="alert alert-success alert-dismissable my_alert_css">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $this->session->flashdata('success'); ?> </div>
					<?php } ?>
					<?php if($this->session->flashdata('error')){?>
						<div class="alert alert-danger alert-dismissable my_alert_css">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $this->session->flashdata('error'); ?> </div>
					<?php } ?>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class=" m-b-30">
							<div class="card-body">
								<h5 class="header-title pb-3 mt-0"><?= __('store.product_info') ?></h5>
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th colspan="2"><?= __('store.name') ?></th>
												<th><?= __('store.unit_price') ?></th>
												<th><?= __('store.quantity') ?></th>
												<th><?= __('store.total_discount') ?></th>
												<th><?= __('store.total') ?></th>
											</tr>
											<?php foreach ($products as $key => $product) { ?>
												<tr>
													<th><img src="<?= $product['image'] ?>" style="width: 50px;height: 50px"></th>
													<th>
														<?php echo $product['product_name'];?>
														<?php if($product['coupon_discount'] > 0){ ?>
							                                <p class="couopn-code-text">
							                                	Code : <span class="c-name"> <?= $product['coupon_code'] ?></span> Applied
							                                </p>
						                                <?php } ?>
						                               	<?php if($order['status'] == 1 && $product['product_type'] == 'downloadable' && $product['downloadable_files']) { ?>
															<div class="download">	
															<?php foreach ($product['downloadable_files'] as $downloadable_filess) { ?>
																<a href="<?php echo base_url('store/downloadable_file/'. $downloadable_filess['name'] . '/' . base64_encode($downloadable_filess['mask']) .'/'.$order['id']) ?>" class="btn btn-link btn-sm" target="_blank"><?php echo $downloadable_filess['mask'] ?></a>
															<?php } ?>
															</div>
														<?php } ?>
													</th>
													<th><?php echo c_format($product['price']); ?></th>
													<th><?php echo $product['quantity']; ?></th>
													<th><?php echo c_format($product['coupon_discount']);  ?></th>
													<th><?php echo c_format($product['total']); ?></th>
												</tr>
											<?php } ?>
											<?php foreach ($totals as $key => $total) { ?>
												<tr>
													<td colspan="5" class="text-right"><?= $total['text'] ?></td>
													<td><?php echo c_format($total['value']); ?></td>
												</tr>
											<?php } ?>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-8 col-md-8">
						<div class=" m-b-30">
							<div class="card-body">
								<h5 class="header-title pb-3 mt-0"><?= __('store.order_payment_info') ?></h5>
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<th class="border-top-0"><?= __('store.mode') ?></th>
											<th class="border-top-0"><?= __('store.transaction_id') ?></th>
											<th class="border-top-0"><?= __('store.payment_status') ?></th>
										</thead>
										<tbody>
											<?php if($order['status'] == 0){ ?>
												<tr>
													<td colspan="100%">
														<p class="text-muted text-center"><?= __('store.waiting_for_payment_status') ?></p>
													</td>
												</tr>
											<?php } ?>
											<?php foreach ($payment_history as $key => $value) { ?>
											<tr>
												<td><?php echo str_replace("_", " ", $value['payment_mode']) ?></td>
												<td><?php echo $order['txn_id'];?></td>
												<td><?php echo $value['paypal_status'] ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<?php if($order['payment_method'] == 'bank_transfer'){ ?>
									<div class="form-group">
										<label class="control-label"><b><?= __('store.bank_transfer_instruction') ?></b></label>
										<pre class="well"><?php echo $paymentsetting['bank_transfer_instruction'] ?></pre>
									</div>
								<?php } ?>

								<?php if($order['comment']){ ?>
									<div class="form-group">
										<label class="control-label"><b><?= __('store.order_view_comment') ?></b></label>
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<th class="border-top-0"><?= __('store.title') ?></th>
													<th class="border-top-0"><?= __('store.comment') ?></th>
												</thead>
												<tbody>
													<?php foreach ($order['comment'] as $key => $value) { ?>
													<tr>
														<td><?= $value['title'] ?></td>
														<td><?= $value['comment'] ?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								<?php } ?>

								<?php if($order['files']){ ?>
									<div class="form-group">
										<label class="control-label"><b><?= __('store.order_attechments_download') ?></b></label>
										<div><?php echo $order['files'] ?></div>
									</div>
								<?php } ?>

								<?php if($orderProof){ ?>
									<div class="form-group">
										<label class="control-label"><b><?= __('store.payment_proof') ?></b>
											: <a href="<?= $orderProof->downloadLink ?>" target='_blank'><?= __('store.download') ?></a>
										</label>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php if($order['allow_shipping']){ ?>
						<div class="col-lg-4 col-md-4">
							<div class=" m-b-30">
								<div class="card-body">
									<h5 class="header-title pb-3 mt-0"><?= __('store.shipping_details') ?></h5>
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th><?= __('store.address') ?></th>
													<td><?php echo $order['address'] ?></td>
												</tr>
												<tr>
													<th><?= __('store.country') ?></th>
													<td><?php echo $order['country_name'] ?></td>
												</tr>
												<tr>
													<th><?= __('store.state') ?></th>
													<td><?php echo $order['state_name'] ?></td>
												</tr>
												<tr>
													<th><?= __('store.city') ?></th>
													<td><?php echo $order['city'] ?></td>
												</tr>
												<tr>
													<th><?= __('store.postal_code') ?></th>
													<td><?php echo $order['zip_code'] ?></td>
												</tr>
											</thead>
										</table>
									</div>
									
								</div>
							</div>
						</div>
					<?php }  ?>
				</div>
				<div class="row">
					<div class="col-lg-12 col-sm-12 align-self-center">
						<div class=" m-b-30">
							<div class="card-body new-user">
								<h5 class="header-title mb-4 mt-0"><?= __('store.update_order_status') ?></h5>
								<table class="table table-striped">
									<thead>
										<tr>
											<th width="50px">#</th>
											<th width="150px"><?= __('store.status') ?></th>
											<th><?= __('store.comment') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php if(!$order_history){ ?>
											<tr>
												<td colspan="100%">
													<p class="text-muted text-center">No any order status </p>
												</td>
											</tr>
										<?php } ?>
										<?php foreach ($order_history as $key => $value) { ?>
										<tr>
											<td>#<?= $key ?></td>
											<td><?= $status[$value['order_status_id']] ?></td>
											<td><?= $value['comment'] ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>