<style>

	#tab_settings table.table > tbody > tr > td, #tab_settings table.table > tfoot > tr > td, #tab_settings table.table > thead > tr > td {

		padding: 5px 12px !important;

		vertical-align: middle !important;

	}



	#tab_settings .home_sections_positions_loading {

		margin:0px !important;

		padding:0px !important;

	}



	.thead-tr-loader {

		display: block;

		position: relative;

		height: 0.5rem;

		width: 1.5rem;

		color: #467fcf;

		top: 15px;

	}



	.thead-tr-loader:before {

		border-radius: 50%;

		border: 3px solid currentColor;

		opacity: .15;

	}



	.thead-tr-loader:before, .thead-tr-loader:after {

		width: 1.5rem;

		height: 1.5rem;

		margin: -1.25rem 0 0 -1.25rem;

		position: absolute;

		content: '';

		top: 50%;

		left: 50%;

	}



	.thead-tr-loader:after {

		-webkit-animation: loader .6s linear;

		animation: loader .6s linear;

		-webkit-animation-iteration-count: infinite;

		animation-iteration-count: infinite;

		border-radius: 50%;

		border: 3px solid;

		border-color: transparent;

		border-top-color: currentColor;

		box-shadow: 0 0 0 1px transparent;

	}



</style>



<?php if($this->session->flashdata('success')){?>

<div class="alert alert-success alert-dismissable">

	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

<?php echo $this->session->flashdata('success'); ?> </div>

<?php } ?>

<?php if($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissable">

	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

<?php echo $this->session->flashdata('error'); ?> </div>

<?php } ?>

<style>

legend {

background-color: gray;

color: white;

padding: 5px 10px;

}

</style>

<span id="alertdiv_2">

	

</span>

<div class="card">

	<div class="card-body">

		<form class="form-horizontal" autocomplete="off" method="post" enctype="multipart/form-data" action="" id="admin-form">

			<div class="row">

				<div class="col-sm-12">

					<ul class="nav nav-pills nav-stacked setting-nnnav" role="tablist">

					    

					    <li class="nav-item">

							<a class="nav-link active show" href="#tab_home" data-toggle="tab" role="tab">

							<?= __('admin.theme_home') ?></a>

						</li>

						<li class="nav-item">

							<a class="nav-link" href="#tab_sliders" data-toggle="tab" role="tab">

							<?= __('admin.theme_sliders') ?></a>

						</li>

						<li class="nav-item">

							<a class="nav-link"  href="#tab_home_content" data-toggle="tab" role="tab">

							<?= __('admin.theme_home_content') ?></a>

						</li>

						<li class="nav-item">

							<a class="nav-link" href="#tab_sections" data-toggle="tab" role="tab">

							<?= __('admin.theme_sections') ?></a>

						</li>

							<li class="nav-item">

							<a class="nav-link"  href="#tab_home_videos" data-toggle="tab" role="tab">

							<?= __('admin.theme_home_videos') ?></a>

						</li>

						<li class="nav-item">

							<a class="nav-link"  href="#tab_recommendation" data-toggle="tab" role="tab">

							<?= __('admin.theme_recommendation') ?></a>

						</li>

						<li class="nav-item">

							<a class="nav-link"  href="#tab_faq" data-toggle="tab" role="tab">

							<?= __('admin.theme_faq') ?></a>

						</li>

						<li class="nav-item">

							<a class="nav-link"  href="#tab_page_pages" data-toggle="tab" role="tab">Pages & Links</a>

						</li>

						<li class="nav-item">

							<a class="nav-link" href="#tab_settings" data-toggle="tab" role="tab"  >

							<?= __('admin.theme_settings') ?></a>

						</li>

						<li class="nav-item">

							<a class="nav-link" href="<?php echo base_url(); ?>"target=_blank>

							<?= __('admin.view_site') ?></a>

						</li>

					</ul>

				</div>

							</div>

								<div class="col-sm-12">

									<div class="tab-content">

									    

									    <div role="tabpanel" class="tab-pane p-3 active show" id="tab_home">

											<div class="row">

												<div class="col-12">

													<div class="card m-b-30">

														<div class="card-header">

															<h4 class="card-title pull-left">Theme Home</h4>

														</div>

														<div class="card-body">

														    <div class="row">

                                                                <div class="col-xl-9">

                                                                    <img class="img-thumbnail" src="<?php echo base_url("assets/images/themes/multiple_pages.png") ?>" height="550" width="1000" >

                                                                </div>

                                                                <div class="col-xl-3">

                                                                    <div class="mini-stat clearfix bg-white">

                                                                    <ul>

                                                                        <h5 class="counter mt-0 text-primary"><?php echo __( 'admin.theme_support_features') ?></h5>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_dynamic_slider') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_dynamic_sections') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_dynamic_recommendation') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_dynamic_content') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_dynamic_videos') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_dynamic_pages') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_drag_and_drop') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_terms_page') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_contact_us_page') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_faq_dynamic_page') ?></h6></li>

                                                                        <li><h6 class="counter mt-0 text-primary"><?php echo __( 'admin.support_dynamic_bottom_menus') ?></h6></li>

                                                                    </ul>

                                                                    </div>

                                                                </div>

                                                            </div>

														</div>

													</div> 

												</div> 

											</div>

										</div>

										

										<div role="tabpanel" class="tab-pane p-3" id="tab_sliders">

											<div class="row">

												<div class="col-12">

													<div class="card m-b-30">

														<div class="card-header">

															<h4 class="card-title pull-left">Update Slider</h4>

															<div class="pull-right">

																<a class="btn btn-primary" href="<?= base_url('themes/multiple_theme/')  ?>"><?= __('admin.cancel') ?></a>

															</div>

														</div>

														<div class="card-body">

															<form id="admin-form">

																<?php

																	foreach ($theme_settings as $settings) { 

																		$setting_id = $settings->settings_id;

																	}

																?>

																<input type="hidden" name="slider_id" value="<?= $theme_sliders->slider_id ?>">

																<input type="hidden" name="theme_id" value="<?= $setting_id; ?>">

																<input type="hidden" name="position" value="1">

																<input type="hidden" name="hidden_image" id="hidden_image" value="<?= $theme_sliders->image ?>">



																<div class="row">

																	<div class="col-sm-6">

																		<div class="form-group">

																			<label class="control-label">Title</label>

																			<input placeholder="Title" name="title" value="<?php echo $theme_sliders->title; ?>" class="form-control" type="text">

																		</div>

																	</div>	

																	<div class="col-sm-6">

																		<div class="form-group">

																			<label class="control-label">Link Type</label>

																			<?php

																			$registrationLink = base_url('register');

																			$loginLink = base_url('login');

																			?>

																			<select id="slider_link_type" class="form-control">

																				<option <?= ($theme_sliders->link != $registrationLink && $theme_sliders->link != $loginLink) ? 'selected' : ''; ?> value="">Custom</option>

																				<option <?= ($theme_sliders->link == $registrationLink) ? 'selected' : ''; ?> value="<?=$registrationLink?>">Registration</option>

																				<option <?= ($theme_sliders->link == $loginLink) ? 'selected' : ''; ?> value="<?=$loginLink?>">Login</option>

																			</select>

																		</div>

																	</div>

																	<div class="col-sm-12">

																		<div class="form-group">

																			<label class="control-label">Link</label>

																			<input placeholder="Link" name="link" id="slider-link" class="form-control" value="<?php echo $theme_sliders->link; ?>" type="text">

																			<span class="text-danger" id="linkError"></span>

																		</div>

																	</div>



																	<div class="col-sm-6">

																		<div class="form-group">

																			<label class="control-label">Description</label>

																			<textarea class="form-control" rows=5 name="description"><?php echo $theme_sliders->description; ?></textarea>

																		</div>

																	</div>

																	<div class="col-sm-6">			

																		<div class="form-group">

																			<label class="control-label">Button Text</label>

																			<input placeholder="Button Text" name="button_text" class="form-control" value="<?php echo $theme_sliders->button_text; ?>" type="text">

																		</div>

																	</div>

																	<input type="hidden" name="status" value="1" />

																	<!-- <div>

																		<div class="form-group">

																			<label class="control-label">Status</label>

																			<div>

																				<input type="radio" <?php //echo ($theme_sliders->status == 1) ? "checked" : "" ?>  name="status" value="1">Active

																				<input type="radio" <?php //echo ($theme_sliders->status == 0) ? "checked" : "" ?>  name="status" value="0">Inactive

																			</div>

																		</div>

																	</div> -->

																	

																</div>

																<div class="form-group">

																	<label class="control-label">Slider Image</label>

																	

																	<!--This is the new function to see image once upload-->

																	<div>

																		<div class="fileUpload btn btn-sm btn-primary">

																			<span><?= __('admin.choose_file') ?></span>

																			<input id="uploadBtn" name="avatar" class="upload" type="file" onchange="loadFile(event)">

																		</div>

																		<?php 
																			$avatar= 'assets/images/no-image-available.gif';
																			$theme_sliders_image_dlt = false;
																			if($theme_sliders->image !=''){
																				$avatar= '/assets/images/theme_images/'.$theme_sliders->image;
																				$theme_sliders_image_dlt = true;
																			}
																		?>

																		<img id="output" src="<?php echo base_url().$avatar;?>" class="thumbnail" border="0" width="220px" />

																		<?php if($theme_sliders_image_dlt) { ?>
																		<span class="btn btn-sm btn-danger btn-delete-image" data-img_input="hidden_image" data-img_ele="output" data-img_placeholder="<?php echo base_url();?>assets/images/no-image-available.gif"><i class="fa fa-trash"></i></span>
																		<?php } ?>
																	</div>

																</div>



																<div class="form-group">

																	<button type="button" class="btn btn-primary btn-slider-submit"> Update </button>

																	<span class="loading-submit"></span>

																</div>

															</form>

														</div>

													</div> 

												</div> 

											</div>

										</div>

										<div role="tabpanel" class="tab-pane p-1" id="tab_sections">

											<div class="col-12">

												<div class="card m-b-30">

													<div class="card-header">

														<h4 class="card-title pull-left">Section</h4>

														<div class="pull-right">

															<a class="btn btn-primary" href="<?= base_url('themes/add_new_section/')  ?>">Add New Section</a>

														</div>

													</div>

													<div class="card-body">

														<div class="table-responsive">

															<small class="text-muted">change position by simply drag and drop rows</small>

															<table class="table-hover table-striped table">

																<thead>

																	<tr>

																		<th>Title</th>

																		<th width="450">Description</th>

																		<th>Image</th>

																		<th>Link</th>

																		<th>Button Text</th>

																		<th>Status</th>

																		<th><?= __('admin.action')?></th>

																	</tr>

																</thead>

																<tbody data-whe_column="section_id" data-pos_column="position" data-table="theme_sections" class="sortable">

																	<?php if(empty($theme_sections)){ ?>

																	<tr style="background-color:#FFF!important;">

																		<td colspan="100%" class="text-center">No Sections Available</td>

																	</tr>

																	<?php } ?>

																	<?php foreach ($theme_sections as $key => $section) { ?>

																	<tr data-id="<?= $section->section_id ?>" style="background-color:#FFF!important; cursor: move;">

																		<td><?= $section->title ?></td>

																		<td width="450"><?= substr($section->description, 0, 100); ?><?= (strlen($section->description) > 100) ? "..." : "";?></td>

																		<td><img src="<?php echo base_url("assets/images/theme_images/".$section->image) ?>" height="50" width="auto"></td>

																		<td><?= $section->link ?></td>

																		<td><?= $section->button_text ?></td>

																		<td><?= ($section->status == 1) ?

																			'<lable class="badge badge-success">Active</lable>' :

																			'<lable class="badge badge-blue-grey">Inactive</lable>' ?>

																		</td>

																		<td>

																			<a class="btn btn-primary btn-sm" href="<?= base_url('themes/edit_section/'. $section->section_id) ?>"><i class="fa fa-edit"></i></a>

																			<a class="btn confirm btn-danger btn-sm" href="<?= base_url('themes/delete_section/'. $section->section_id) ?>"><i class="fa fa-trash"></i></a>

																		</td>

																	</tr>

																	<?php } ?>

																</tbody>

															</table>

														</div>

													</div>

												</div>

											</div>

										</div>

										<div role="tabpanel" class="tab-pane p-3" id="tab_recommendation">

											<div class="col-12">

												<div class="card m-b-30">

													<div class="card-header">

														<h4 class="card-title pull-left">Recommendations</h4>

														

														<div class="pull-right">

															<a class="btn btn-primary" href="<?= base_url('themes/add_new_recommendation/')  ?>">Add New Recommendation</a>

														</div>

													</div>

													<div class="card-body">

														<div class="table-responsive">

															<small class="text-muted">change position by simply drag and drop rows</small>

															<table class="table-hover table-striped table">

																<thead>

																	<tr>

																		<th>Title</th>

																		<th>Occupation</th>

																		<th>Description</th>

																		<th>Image</th>

																		<th>Status</th>

																		<th><?= __('admin.action')?></th>

																	</tr>

																</thead>

																<tbody class="sortable" data-whe_column="recommendation_id" data-pos_column="position" data-table="theme_recommendation">

																	<?php if(empty($theme_recommendation)){ ?>

																	<tr>

																		<td colspan="100%" class="text-center">No Recommendation Available</td>

																	</tr>

																	<?php } ?>

																	<?php foreach ($theme_recommendation as $key => $recommendation) { ?>

																	<tr data-id="<?= $recommendation->recommendation_id ?>" style="background-color:#FFF!important; cursor: move;">

																		<td><?= $recommendation->title ?></td>

																		<td><?= $recommendation->occupation ?></td>

																		<td width="450"><?= substr($recommendation->description, 0, 100); ?><?= (strlen($recommendation->description) > 100) ? "..." : "";?></td>

																		<td><img src="<?php echo base_url("assets/images/theme_images/".$recommendation->image) ?>" height="50" width="auto"></td>

																		<td><?= ($recommendation->status == 1) ?

																			'<lable class="badge badge-success">Active</lable>' :

																			'<lable class="badge badge-blue-grey">Inactive</lable>' ?>

																		</td>

																		<td>

																			<a class="btn btn-primary btn-sm" href="<?= base_url('themes/edit_recommendation/'. $recommendation->recommendation_id ) ?>"><i class="fa fa-edit"></i></a>

																			<a class="btn confirm btn-danger btn-sm" href="<?= base_url('themes/delete_recommendation/'. $recommendation->recommendation_id ) ?>"><i class="fa fa-trash"></i></a>

																		</td>

																	</tr>

																	<?php } ?>

																</tbody>

															</table>

														</div>

													</div>

												</div>

											</div>

										</div>

										

										<div role="tabpanel" class="tab-pane p-3" id="tab_faq">

											<div class="col-12">

												<div class="card m-b-30">

													<div class="card-header">

														<h4 class="card-title pull-left">FAQ</h4>

														

														<div class="pull-right">

															<a class="btn btn-primary" href="<?= base_url('themes/add_new_faq/')  ?>">Add New FAQ</a>

														</div>

													</div>

													<div class="card-body">

														<div class="table-responsive">

															<small class="text-muted">change position by simply drag and drop rows</small>

															<table class="table-hover table-striped table">

																<thead>

																	<tr>

																		<th>Question</th>

																		<th>Answer</th>

																		<th>Status</th>

																		<th>Action</th>

																	</tr>

																</thead>

																<tbody class="sortable" data-whe_column="faq_id" data-pos_column="position" data-table="theme_faq">

																	<?php if(empty($theme_faqs)){ ?>

																	<tr>

																		<td colspan="100%" class="text-center">No FAQ Available</td>

																	</tr>

																	<?php } ?>

																	<?php foreach ($theme_faqs as $key => $faq) { ?>

																	<tr data-pos="<?= $faq->position ?>" data-id="<?= $faq->faq_id ?>" style="background-color:#FFF!important; cursor: move;">

																		<td><?= $faq->faq_question ?></td>

																		<td width="450"><?= substr($faq->faq_answer, 0, 100); ?><?= (strlen($faq->faq_answer) > 100) ? "..." : "";?></td>

																		<td><?= ($faq->status == 1) ?

																			'<lable class="badge badge-success">Active</lable>' :

																			'<lable class="badge badge-blue-grey">Inactive</lable>' ?>

																		</td>

																		<td>

																			<a class="btn btn-primary btn-sm" href="<?= base_url('themes/edit_faq/'. $faq->faq_id ) ?>"><i class="fa fa-edit"></i></a>

																			<a class="btn confirm btn-danger btn-sm" href="<?= base_url('themes/delete_faq/'. $faq->faq_id ) ?>"><i class="fa fa-trash"></i></a>

																		</td>

																	</tr>

																	<?php } ?>

																</tbody>

															</table>

														</div>

													</div>

												</div>

											</div>

										</div>

										

										<div role="tabpanel" class="tab-pane p-3" id="tab_home_content">

											<div class="col-12">

												<div class="card m-b-30">

													<div class="card-header">

														<h4 class="card-title pull-left">Home Content</h4>

														

														<div class="pull-right">

															<a class="btn btn-primary" href="<?= base_url('themes/add_new_homecontent/')  ?>">Add Home Content</a>

														</div>

													</div>

													<div class="card-body">

														<div class="table-responsive">

															<small class="text-muted">change position by simply drag and drop rows</small>

															<table class="table-hover table-striped table">

																<thead>

																	<tr>

																		<th>Title</th>

																		<th>Description</th>

																		<th>Image</th>

																		<th>Status</th>

																		<th><?= __('admin.action')?></th>

																	</tr>

																</thead>

																<tbody class="sortable" data-whe_column="homecontent_id" data-pos_column="position" data-table="theme_homecontent">

																	<?php if(empty($theme_homecontent)){ ?>

																	<tr>

																		<td colspan="100%" class="text-center">No Content Available</td>

																	</tr>

																	<?php } ?>

																	<?php foreach ($theme_homecontent as $key => $homecontent) { ?>

																	<tr data-id="<?= $homecontent->homecontent_id ?>" style="background-color:#FFF!important; cursor: move;">

																		<td width="150"><?= $homecontent->title ?></td>

																		<td width="450"><?= substr($homecontent->description, 0, 100); ?><?= (strlen($homecontent->description) > 100) ? "..." : "";?></td>

																		<td><img src="<?php echo base_url("assets/images/theme_images/".$homecontent->image) ?>" height="50" width="100"></td>

																		<td><?= ($homecontent->status == 1) ?

																			'<lable class="badge badge-success">Active</lable>' :

																			'<lable class="badge badge-blue-grey">Inactive</lable>' ?>

																		</td>

																		<td>

																			<a class="btn btn-primary btn-sm" href="<?= base_url('themes/edit_homecontent/'. $homecontent->homecontent_id) ?>"><i class="fa fa-edit"></i></a>

																			<a class="btn confirm btn-danger btn-sm" href="<?= base_url('themes/delete_homecontent/'. $homecontent->homecontent_id) ?>"><i class="fa fa-trash"></i></a>

																		</td>

																	</tr>

																	<?php } ?>

																</tbody>

															</table>

														</div>

													</div>

												</div>

											</div>

										</div>

										<div role="tabpanel" class="tab-pane p-3" id="tab_home_videos">

											<div class="col-12">

												<div class="card m-b-30">

													<div class="card-header">

														<h4 class="card-title pull-left">Home Videos</h4>

														

														<div class="pull-right">

															<a class="btn btn-primary" href="<?= base_url('themes/add_new_video/')  ?>">Add New Video</a>

														</div>

													</div>

													<div class="card-body">

														<div class="table-responsive">

															<small class="text-muted">change position by simply drag and drop rows</small>

															<table class="table-hover table-striped table">

																<thead>

																	<tr>

																		<th>Video Title</th>

																		<th>Video Sub Title</th>

																		<th>Video Link</th>

																		<th>Watch video</th>

																		<th>Status</th>

																		<th><?= __('admin.action')?></th>

																	</tr>

																</thead>

																<tbody class="sortable" data-whe_column="video_id" data-pos_column="position" data-table="theme_videos">

																	<?php if(empty($theme_videos)){ ?>

																	<tr>

																		<td colspan="100%" class="text-center">No Data Available</td>

																	</tr>

																	<?php } ?>

																	<?php foreach ($theme_videos as $key => $video) { ?>

																	<tr data-id="<?= $video->video_id ?>" style="background-color:#FFF!important; cursor: move;">

																		<td><?= $video->video_title ?></td>

																		<td><?= $video->video_sub_title ?></td>

																		<td><?= $video->video_link ?>

																		</td>

																		<td>

																			<a class="btn btn-info btn-sm" href="<?= $video->video_link ?>" target="_blank" role="button">Watch video</a>

																		</td>

																		<td>

																			<?= ($video->status == 1) ?

																			'<lable class="badge badge-success">Active</lable>' :

																			'<lable class="badge badge-blue-grey">Inactive</lable>' ?>

																		</td>

																		<td>

																			<a class="btn btn-primary btn-sm" href="<?= base_url('themes/edit_video/'. $video->video_id) ?>"><i class="fa fa-edit"></i></a>

																			<a class="btn confirm btn-danger btn-sm" href="<?= base_url('themes/delete_video/'. $video->video_id) ?>"><i class="fa fa-trash"></i></a>

																		</td>

																	</tr>

																	<?php } ?>

																</tbody>

															</table>

														</div>

													</div>

												</div>

											</div>

										</div>

										<div role="tabpanel" class="tab-pane p-3" id="tab_page_pages">

											<div class="col-12">

												<div class="card m-b-30">

													<div class="card-header">

														<h4 class="card-title pull-left">Theme Pages</h4>

														<div class="pull-right">

															<a class="btn btn-primary" href="<?= base_url('themes/add_new_page/')  ?>">Add New Page</a>

														</div>

													</div>

													

													<div class="card-body">

														<div class="table-responsive">

															<table class="table-hover table-striped table">

																<thead>

																	<tr>

																		<th>Id</th>

																		<th>Page Name</th>

																		<th>Slug</th>

																		<th>Top Banner Title</th>

																		<th>Top Banner Sub Title</th>

																		<th>Page Content Title</th>

																		<!-- <th>Page Content</th> -->

																		<th>Status</th>

																		<th><?= __('admin.action')?></th>

																	</tr>

																</thead>

																<tbody>

																	<?php if(empty($theme_pages)){ ?>

																	<tr>

																		<td colspan="100%" class="text-center">No Page Available</td>

																	</tr>

																	<?php } ?>

																	<?php foreach ($theme_pages as $key => $page) { ?>

																	<tr class="deleterow-<?php echo $page->page_id ?>">

																		<td><?= $page->page_id ?></td>

																		<td><?= $page->page_name ?></td>

																		<td><?= $page->slug ?></td>

																		<td><?= $page->top_banner_title ?></td>

																		<td><?= $page->top_banner_sub_title ?></td>

																		<td><?= $page->page_content_title ?></td>

																		<!-- <td width="550"><?= $page->page_content ?></td> -->

																		<td>

																			<?php if ($page->status ==1) { ?>

																			<i class="fa fa-toggle-on" style="cursor: pointer;color: green;font-size: 35px;width:50px" onclick="change_page_status('<?= $page->page_id ?>');" id="page_status_active_<?= $page->page_id ?>"> 

																			<?php } else{ ?>

																				

																			<i class="fa fa-toggle-off" style="cursor: pointer;color: red;font-size: 35px;width:50px" onclick="change_page_status('<?= $page->page_id ?>');" id="page_status_active_<?= $page->page_id ?>"> 



																			<?php } ?>	

																			<input type="hidden" name="page_status" id="page_status_<?= $page->page_id ?>" value="<?php echo $page->status;?>">

																			</i>

																		</td>

																		

																		<td>

																			<a class="btn btn-primary btn-sm" href="<?= base_url('themes/edit_page/'. $page->page_id) ?>"><i class="fa fa-edit"></i></a>

																			<a class="btn btn-danger btn-sm delete_page" data-id="<?= $page->page_id; ?>" data-href="<?= base_url('themes/delete_page/'. $page->page_id) ?>"><i class="fa fa-trash"></i></a>

																		</td>

																	</tr>

																	<?php } ?>

																</tbody>

															</table>

														</div>

													</div>

												</div>

											</div>

											<div class="col-12">
												<div class="card m-b-30">
													<div class="card-header">
														<h4 class="card-title pull-left">Theme Links</h4>
														<div class="pull-right">
															<span id="add_new_link" class="btn btn-primary text-white">Add New Link</span>
														</div>
													</div>

													<div class="card-body">
														<div class="table-responsive">
															<table class="table-hover table-striped table">
																<thead>
																	<tr>
																		<th>Link title</th>
																		<th>Link URL</th>
																		<th class="text-center">Link Position</th>
																		<th>Status</th>
																		<th><?= __('admin.action')?></th>
																	</tr>
																</thead>

																<tbody id="links-tbody">

																	<?php if(empty($theme_links)){ ?>
																		<tr>
																			<td colspan="100%" class="text-center">No Links Available</td>
																		</tr>
																	<?php } ?>

																	<?php foreach ($theme_links as $link) { ?>
																	<tr data-tlink_id="<?= $link->tlink_id ?>" data-tlink_title="<?= $link->tlink_title ?>" data-tlink_url="<?= $link->tlink_url ?>" data-tlink_position="<?= $link->tlink_position ?>" data-tlink_status="<?= $link->tlink_status ?>" data-tlink_target_blank="<?= $link->tlink_target_blank ?>">
																		<td><?= $link->tlink_title ?></td>
																		<td><?= $link->tlink_url ?></td>
																		<td class="text-center"><?php 

																			switch ($link->tlink_position) {
																				case 1:
																					echo "Menu A";
																					break;
																				case 2:
																					echo "Menu B";
																					break;
																				case 3:
																					echo "Menu C";
																					break;
																				case 4:
																					echo "Menu D";
																					break;
																				default:
																					echo "None";
																					break;
																			}
																			 
																		?></td>
																		<td>
																			<i class="btn_tlink_status_toggle fa <?= ($link->tlink_status == 1) ? 'fa-toggle-on' : 'fa-toggle-off' ?>" style="cursor: pointer; color: <?= ($link->tlink_status == 1) ? 'green' : 'red' ?>; font-size: 35px; width:50px"></i>
																		</td>
																		<td>
																			<a class="btn btn-primary text-white btn-sm btn_edit_tlink"><i class="fa fa-edit"></i></a>
																			<a class="btn btn-danger text-white btn-sm btn_delete_tlink"><i class="fa fa-trash"></i></a>
																		</td>
																	</tr>
																	<?php } ?>

																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>

										</div>
																		
										<div role="tabpanel" class="tab-pane p-3" id="tab_settings">

											<div class="col-md-12">

												<div class="card m-b-30">

													<div class="card-header">

														<h4 class="card-title pull-left">Theme Settings</h4>

													</div>

													<div class="card-body">

														<fieldset class="mt-1">

															<legend>Homepage Section Management</legend>

															<div class="row">

																<div class="col-md-12">

																	<small class="text-muted">&nbsp;change position by simply drag and drop rows</small>

																		<table class="table-hover table">

																		<thead>

																			<tr>

																			<th style="verticle-align:middle;">Enable/Disable</th>

																			<th style="verticle-align:middle;">Section Name



																			<span class="home_sections_positions_loading float-right" style="display:none;">

																				<div class="thead-tr-loader"></div>

																			</span>



																			</th>

																			</tr>

																		</thead>

																		<tbody class="sortable2">

																			<?php foreach($home_sections_settings as $hs_setting) { ?>

																			<tr style="background-color:#FFF!important; cursor: move;">

																				<td style="width:100px; text-align:center;">

																				<?php if ($hs_setting->sec_is_enable == 1) { ?>

																					<i class="fa fa-toggle-on" style="cursor: pointer;color: green;font-size: 35px;width:50px" onclick="change_section_status(<?= $hs_setting->sec_id ?>);" id="section_status_active_<?= $hs_setting->sec_id ?>"></i> 

																				<?php } else{ ?>

																					<i class="fa fa-toggle-off" style="cursor: pointer;color: red;font-size: 35px;width:50px" onclick="change_section_status(<?= $hs_setting->sec_id ?>);" id="section_status_active_<?= $hs_setting->sec_id ?>"></i>

																				<?php } ?>	

																				<input type="hidden" name="sec_status[]" id="section_status_<?= $hs_setting->sec_id ?>" value="<?= $hs_setting->sec_is_enable ?>"/>

																				<input type="hidden" name="sec_id[]" value="<?= $hs_setting->sec_id ?>"/>

																				</td>

																				<td><?= $hs_setting->sec_title ?></td>

																			</tr>

																			<?php } ?>

																		</tbody>

																	</table>

																</div>

															</div>

														</fieldset>

														<fieldset class="mt-3">

															<legend>Top Banner Runner</legend>

															<div id="runners-section" class="row">

																<?php 

																foreach ($theme_settings as $settings) { 

																	$setting_id = $settings->settings_id;

																	$top_banner_slider = json_decode($settings->top_banner_slider);

																	

																} 

																?>

																<input type ="hidden" name="settings_id" value ="<?php echo @$setting_id;?>">

																<?php

																if(sizeof($top_banner_slider) > 0) {

																	foreach($top_banner_slider as $runner){

																?>

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="control-label">Runner 1</label>

																		<input name="top_banner_slider[]" class="form-control" type="text" value="<?= $runner; ?>">

																	</div>

																	<button type="button" class="btn btn-danger btn-md remove-runner-btn" style="position: absolute; top: 30px; right: 11px;"><i class="fa fa-trash"></i></button>

																</div>

																<?php

																	}

																} else {

																?>

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="control-label">Runner 1</label>

																		<input name="top_banner_slider[]" class="form-control" type="text">

																	</div>

																	<button type="button" class="btn btn-danger btn-md remove-runner-btn" style="position: absolute; top: 30px; right: 11px;"><i class="fa fa-trash"></i></button>

																</div>

																<?php

																}

																?>

																<div class="col-md-12">

																	<button id="add-more-runner-btn" type="button" class="btn btn-default btn-md"><i class="fa fa-plus"></i> Add More Runners</button>

																</div>



																<!-- <div class="col-md-9">

																	<div class="form-group">

																		<label class="control-label">Runner 2</label>

																		<input name="top_banner_slider" class="form-control" value="<?php //echo $settings->top_banner_slider; ?>" type="text">

																	</div>

																</div> -->

															</div>

														</fieldset>

														<fieldset class="mt-3">

															<legend>Home Section Title & Sub Title</legend>

															<div class="row">

																<?php foreach ($theme_settings as $settings) { $setting_id = $settings->settings_id; } ?>

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Top Title</label>

																		<input type ="hidden" name= "settings_id" value ="<?php echo @$setting_id;?>" >

																		<input name="home_section_title" value="<?php echo $settings->home_section_title; ?>" class="form-control" type="text">

																	</div>

																</div>

																

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Sub Title</label>

																		<input name="home_section_subtitle" class="form-control" value="<?php echo $settings->home_section_subtitle; ?>" type="text">

																	</div>

																</div>

															</div>

														</fieldset>

														<fieldset class="mt-3">

															<legend>Recommendation Section Title & Sub Title</legend>

															<div class="row">

																<?php foreach ($theme_settings as $settings) { $setting_id = $settings->settings_id; } ?>

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Top Title</label>

																		<input type ="hidden" name= "settings_id" value ="<?php echo @$setting_id;?>" >

																		<input name="recommendation_section_title" value="<?php echo $settings->recommendation_section_title; ?>" class="form-control" type="text">

																	</div>

																</div>

																

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Sub Title</label>

																		<input name="recommendation_section_subtitle" class="form-control" value="<?php echo $settings->recommendation_section_subtitle; ?>" type="text">

																	</div>

																</div>

															</div>

														</fieldset>		

														<fieldset class="mt-3">

															<legend>Membership Section Title & Sub Title</legend>

															<div class="row">

																<?php foreach ($theme_settings as $settings) { $setting_id = $settings->settings_id; } ?>

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Top Title</label>

																		<input type ="hidden" name= "settings_id" value ="<?php echo @$setting_id;?>" >

																		<input name="membership_top_title" value="<?php echo $settings->membership_top_title; ?>" class="form-control" type="text">

																	</div>

																</div>

																

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Sub Title</label>

																		<input name="membership_sub_title" class="form-control" value="<?php echo $settings->membership_sub_title; ?>" type="text">

																	</div>

																</div>

															</div>

														</fieldset>

														<fieldset class="mt-3">

															<legend>Videos Section Background</legend>

															<div class="row">

																<?php foreach ($theme_settings as $settings) { $setting_id = $settings->settings_id; } ?>

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="control-label">Backgound Image</label>

																		<div>

																			<div class="fileUpload btn btn-sm btn-primary">

																				<span><?= __('admin.choose_file') ?></span>

																				<input id="homepage_video_section_bg" name="homepage_video_section_bg" class="upload" type="file" >

																			</div>

																			<input type="hidden" name="hidden_homepage_video_section_bg" value="<?= $settings->homepage_video_section_bg ?>" />

																			<?php
																			$homepage_video_section_bg_dlt = false;
																			$avatar= 'assets/login/multiple_pages/img/video-section-bg.png';
																			if($settings->homepage_video_section_bg !=''){
																				$homepage_video_section_bg_dlt = true;
																				$avatar= '/assets/images/theme_images/'.$settings->homepage_video_section_bg;
																			}
																			?>

																			<img id="output_homepage_video_section_bg"  src="<?php echo base_url().$avatar;?>" class="thumbnail" border="0" width="220px" />

																			<?php if($homepage_video_section_bg_dlt) { ?>
																			<span class="btn btn-sm btn-danger btn-delete-image" data-img_input="hidden_homepage_video_section_bg" data-img_ele="output_homepage_video_section_bg" data-img_placeholder="<?php echo base_url();?>assets/login/multiple_pages/img/video-section-bg.png"><i class="fa fa-trash"></i></span>
																			<?php } ?>																			

																		</div>

																	</div>

																</div>

															</div>

														</fieldset>

														<fieldset class="mt-3">

															<legend>FAQ Page</legend>

															<div class="row">

																<?php foreach ($theme_settings as $settings) { $setting_id = $settings->settings_id; } ?>

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Banner Title</label>

																		<input type ="hidden" name= "settings_id" value ="<?php echo @$setting_id;?>" >

																		<input name="faq_banner_title" value="<?php echo $settings->faq_banner_title; ?>" class="form-control" type="text">

																	</div>

																</div>

																

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Section Title</label>

																		<input name="faq_section_title" class="form-control" value="<?php echo $settings->faq_section_title; ?>" type="text">

																	</div>

																</div>



																<div class="col-md-12">

																	<div class="form-group">

																		<label class="control-label">Section Sub Title</label>

																		<input name="faq_section_subtitle" class="form-control" value="<?php echo $settings->faq_section_subtitle; ?>" type="text">

																	</div>

																</div>



																<div class="col-md-12">

																	<div class="form-group">

																		<label class="control-label">Banner Image</label>

																		<div>

																			<div class="fileUpload btn btn-sm btn-primary">

																				<span><?= __('admin.choose_file') ?></span>

																				<input id="faq_banner_image" name="faq_banner_image" class="upload" type="file" >

																			</div>

																			<input type="hidden" name="hidden_faq_banner_image" value="<?= $settings->faq_banner_image ?>" />

																			<?php
																				$faq_banner_image = false;
																				$avatar= 'assets/login/multiple_pages/img/bg-photo.jpg';
																				if($settings->faq_banner_image !=''){
																					$faq_banner_image = true;
																					$avatar= '/assets/images/theme_images/'.$settings->faq_banner_image;
																				}
																			?>
		
																			<img id="output_faq_banner_image"  src="<?php echo base_url().$avatar;?>" class="thumbnail" border="0" width="220px" />

																			<?php if($faq_banner_image) { ?>
																			<span class="btn btn-sm btn-danger btn-delete-image" data-img_input="hidden_faq_banner_image" data-img_ele="output_faq_banner_image" data-img_placeholder="<?php echo base_url();?>assets/login/multiple_pages/img/bg-photo.jpg"><i class="fa fa-trash"></i></span>
																			<?php } ?>	
																		</div>

																	</div>

																</div>

															</div>

														</fieldset>

														<fieldset class="mt-5">

															<legend>Contact us page</legend>

															<div class="row">

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Banner Title</label>

																		<input name="contact_us_t_title" value="<?php echo $settings->contact_us_t_title; ?>" class="form-control" type="text">

																	</div>

																</div>

																

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Banner Subtitle</label>

																		<input name="contact_us_slug_title" class="form-control" value="<?php echo $settings->contact_us_slug_title; ?>" type="text">

																	</div>

																</div>

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Section Title</label>

																		<input name="contact_sec_title" value="<?php echo $settings->contact_sec_title; ?>" class="form-control" type="text">

																	</div>

																</div>

																

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Section Subtitle</label>

																		<input name="contact_sec_subtitle" class="form-control" value="<?php echo $settings->contact_sec_subtitle; ?>" type="text">

																	</div>

																</div>

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Full Address</label>

																		<input name="contact_us_full_address" class="form-control" value="<?php echo $settings->contact_us_full_address; ?>" type="text">

																	</div>

																</div>

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Phone Number</label>

																		<input name="contact_us_phone" class="form-control" value="<?php echo $settings->contact_us_phone; ?>" type="text" maxlength="20">

																		<small>Type the + symbol before the number</small>

																		<span class="text-danger" id="contact_us_phone_error"></span>

																	</div>

																</div>

																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Email Address</label>
																		<input name="contact_us_email" class="form-control" value="<?php echo $settings->contact_us_email; ?>" type="email" />
																		<span class="text-danger" id="contact_us_email_error"></span>
																	</div>
																</div>

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="control-label">Google Map Iframe</label>

																		<textarea name="contact_us_iframe" class="form-control" type="text" rows=4><?php echo $settings->contact_us_iframe; ?></textarea>

																	</div>

																</div>

																<div class="col-sm-3">

																	<div class="form-group">

																		<label class="control-label">YouTube Link</label>

																		<input placeholder="Link" name="youtube_link" id="youtube_link" class="form-control" value="<?php echo $settings->youtube_link; ?>" type="text">

																		<span class="text-danger" id="youtube_link_error"></span>

																	</div>

																</div>

																<div class="col-sm-3">

																	<div class="form-group">

																		<label class="control-label">Facebook Link</label>

																		<input placeholder="Link" name="facebook_link" id="facebook_link" class="form-control" value="<?php echo $settings->facebook_link; ?>" type="text">

																		<span class="text-danger" id="facebook_link_error"></span>

																	</div>

																</div>

																<div class="col-sm-3">

																	<div class="form-group">

																		<label class="control-label">Twitter Link</label>

																		<input placeholder="Link" name="twitter_link" id="twitter_link" class="form-control" value="<?php echo $settings->twitter_link; ?>" type="text">

																		<span class="text-danger" id="twitter_link_error"></span>

																	</div>

																</div>

																<div class="col-sm-3">

																	<div class="form-group">

																		<label class="control-label">Instagram Link</label>

																		<input placeholder="Link" name="instegram_link" id="instegram_link" class="form-control" value="<?php echo $settings->instegram_link; ?>" type="text">

																		<span class="text-danger" id="instegram_link_error"></span>

																	</div>

																</div>

																<div class="col-sm-4">

																	<div class="form-group">

																		<label class="control-label">Whatsapp Number</label>

																		<input placeholder="Whatsapp Number" name="whatsapp_number" id="whatsapp_number" class="form-control" value="<?php echo $settings->whatsapp_number; ?>" type="text">

																		<span class="text-danger" id="whatsapp_number_error"></span>

																	</div>

																</div>

																<div class="col-sm-8">

																	<div class="form-group">

																		<label class="control-label">Default Message</label>

																		<input placeholder="Whatsapp Default Message" name="whatsapp_default_msg" id="whatsapp_default_msg" class="form-control" value="<?php echo $settings->whatsapp_default_msg; ?>" type="text">

																		<span class="text-danger" id="whatsapp_default_msg_error"></span>

																	</div>

																</div>
																

																<div class="col-md-12">

																	<div class="form-group">

																		<label class="control-label">Banner Image</label>

																		<div>

																			<div class="fileUpload btn btn-sm btn-primary">

																				<span><?= __('admin.choose_file') ?></span>

																				<input id="contact_banner_image" name="contact_banner_image" class="upload" type="file" >

																			</div>

																			<input type="hidden" name="hidden_contact_banner_image" value="<?= $settings->contact_banner_image ?>" />

																			<?php
																				$contact_banner_image = false;
																				$avatar= 'assets/login/multiple_pages/img/bg-photo.jpg';
																				if($settings->contact_banner_image !=''){
																					$contact_banner_image = true;
																					$avatar= '/assets/images/theme_images/'.$settings->contact_banner_image;
																				}
																			?>
		
																			<img id="output_contact_banner_image"  src="<?php echo base_url().$avatar;?>" class="thumbnail" border="0" width="220px" />

																			<?php if($contact_banner_image) { ?>
																			<span class="btn btn-sm btn-danger btn-delete-image" data-img_input="hidden_contact_banner_image" data-img_ele="output_contact_banner_image" data-img_placeholder="<?php echo base_url();?>assets/login/multiple_pages/img/bg-photo.jpg"><i class="fa fa-trash"></i></span>
																			<?php } ?>	
																		</div>

																	</div>

																</div>

															</div>

														</fieldset>

														

														<fieldset class="mt-5">

															<legend>Footer Edit Section</legend>

															<div class="row">

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Footer About Title</label>

																		<input name="footer_about_title" class="form-control" value="<?php echo $settings->footer_about_title; ?>" type="text">

																	</div>

																</div>

																

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Footer About Text</label>

																		

																		<textarea name="footer_about_text" class="form-control" type="text"><?php echo $settings->footer_about_text; ?></textarea>

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Menu A Title</label>

																		<input name="footer_menu_title_a" class="form-control" value="<?php echo $settings->footer_menu_title_a; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Menu B Title</label>

																		<input name="footer_menu_title_b" class="form-control" value="<?php echo $settings->footer_menu_title_b; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Menu C Title</label>

																		<input name="footer_menu_title_c" class="form-control" value="<?php echo $settings->footer_menu_title_c; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Menu D Title</label>

																		<input name="footer_menu_title_d" class="form-control" value="<?php echo $settings->footer_menu_title_d; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Video Title</label>

																		<input name="video_title" class="form-control" value="<?php echo $settings->video_title; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Video Sub Title</label>

																		<input name="video_sub_title" class="form-control" value="<?php echo $settings->video_sub_title; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-12">

																	<div class="form-group">

																		<label class="control-label">Copyright</label>

																		<input placeholder="Insert Your Copyright" name="copyright" class="form-control" value="<?php echo $settings->copyright; ?>" type="text">

																	</div>

																</div>

															</div>

														</fieldset>

														<fieldset class="mt-5">

															<legend>Bottom Banner Settings</legend>

															<div class="row">

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Banner bottom title</label>

																		<input placeholder="Banner bottom title" name="banner_bottom_title" class="form-control" value="<?php echo $settings->banner_bottom_title; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Banner bottom slug</label>

																		<input placeholder="Banner bottom slug" name="banner_bottom_slug" class="form-control" value="<?php echo $settings->banner_bottom_slug; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Button Text</label>

																		<input placeholder="Button Text" name="banner_button_text" class="form-control" value="<?php echo $settings->banner_button_text; ?>" type="text">

																	</div>

																</div>

																<div class="col-sm-6">

																	<div class="form-group">

																		<label class="control-label">Link</label>

																		<input placeholder="Link" name="banner_button_link" id="banner_button_link" class="form-control" value="<?php echo $settings->banner_button_link; ?>" type="text">

																		<span class="text-danger" id="banner_button_link_error"></span>

																	</div>

																</div>

															</div>

														</fieldset>



														<fieldset class="mt-5">

															<legend>Login & Registration & Terms</legend>

															<div class="row">

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Login Pgae - Text Area</label>

																		<textarea name="login_content" rows="10" class="form-control" type="text"><?php echo $settings->login_content; ?></textarea>

																		<small>Recommend max 1000 charters</small>

																	</div>

																</div>

																

																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label">Login Pgae - Background Image</label>
																		<div>
																			<div class="fileUpload btn btn-sm btn-primary">
																				<span><?= __('admin.choose_file') ?></span>
																				<input id="avatar_login" name="avatar_login" class="upload" type="file" >
																			</div>

																			<?php
																				$is_login_img = false;
																				$avatar= 'assets/login/multiple_pages/img/bg-photo.jpg';
																				if($settings->login_img !=''){
																					$is_login_img = true;
																					$avatar= '/assets/images/theme_images/'.$settings->login_img;
																				}
																			?>
																			<input type="hidden" name="hidden_login_img" value="<?= $settings->login_img ?>" />

																			<img id="output_login"  src="<?php echo base_url().$avatar;?>" class="thumbnail" border="0" width="220px" />

																			<?php if($is_login_img) { ?>
																			<span class="btn btn-sm btn-danger btn-delete-image" data-img_input="hidden_login_img" data-img_ele="output_login" data-img_placeholder="<?php echo base_url();?>assets/login/multiple_pages/img/bg-photo.jpg"><i class="fa fa-trash"></i></span>
																			<?php } ?>
																		</div>
																	</div>
																</div>



																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Registration Page - Text Area</label>

																		<textarea name="reg_content" rows="10" value="" class="form-control" type="text"><?php echo $settings->reg_content; ?></textarea>

																		<small>Recommend max 1000 charters</small>

																	</div>

																</div>

																

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Registration Page - Background Image</label>

																		

																		<div>
																			<div class="fileUpload btn btn-sm btn-primary">
																				<span><?= __('admin.choose_file') ?></span>
																				<input id="avatar_registration" name="avatar_registration" class="upload" type="file" >
																			</div>

																			<?php
																			$is_reg_img = false;
																			$avatar= 'assets/login/multiple_pages/img/bg-photo.jpg';
																			if($settings->reg_img !=''){
																				$is_reg_img = true;
																				$avatar= '/assets/images/theme_images/'.$settings->reg_img;
																			}
																			?>

																			<input type="hidden" name="hidden_reg_img" value="<?= $settings->reg_img ?>" />

																			<img id="output_registration"  src="<?php echo base_url().$avatar;?>" class="thumbnail" border="0" width="220px" />

																			<?php if($is_reg_img) { ?>
																			<span class="btn btn-sm btn-danger btn-delete-image" data-img_input="hidden_reg_img" data-img_ele="output_registration" data-img_placeholder="<?php echo base_url();?>assets/login/multiple_pages/img/bg-photo.jpg"><i class="fa fa-trash"></i></span>
																			<?php } ?>																		
																		</div>
																	</div>
																</div>



																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Terms Page - Text Area</label>

																		<textarea name="terms_content" rows="10" value="" class="form-control" type="text"><?php echo $settings->terms_content; ?></textarea>

																	</div>

																</div>

																

																<div class="col-md-6">

																	<div class="form-group">

																		<label class="control-label">Terms Page - Background Image</label>

																		

																		<div>
																			<div class="fileUpload btn btn-sm btn-primary">
																				<span><?= __('admin.choose_file') ?></span>
																				<input id="avatar_terms" name="avatar_terms" class="upload" type="file" >
																			</div>

																			<?php
																			$is_terms_img = false;
																			$avatar= 'assets/login/multiple_pages/img/bg-photo.jpg';
																			if($settings->terms_img !=''){
																				$is_terms_img = true;
																				$avatar= '/assets/images/theme_images/'.$settings->terms_img;
																			}
																			?>

																			<input type="hidden" name="hidden_terms_img" value="<?= $settings->terms_img ?>" />

																			<img id="output_terms"  src="<?php echo base_url().$avatar;?>" class="thumbnail" border="0" width="220px" />

																			<?php if($is_terms_img) { ?>
																			<span class="btn btn-sm btn-danger btn-delete-image" data-img_input="hidden_terms_img" data-img_ele="output_terms" data-img_placeholder="<?php echo base_url();?>assets/login/multiple_pages/img/bg-photo.jpg"><i class="fa fa-trash"></i></span>
																			<?php } ?>																		

																		</div>

																	</div>

																</div>





															</div>

														</fieldset>

														<br>



														<br>

														<div class="row">

															<button type="button" class="btn btn-primary btn-submit-theme"> Submit </button>

															<span class="loading-submit"></span>

														</div>

													</div>

													

													

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

						</form>

					</div>

				</div>

				<div id="link_form_modal" class="modal" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add New Link</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="link_form">
								<input name="tlink_id" type="hidden" value="0"/>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Link Title</label>
											<input name="tlink_title" type="text" class="form-control" placeholder="Link title to display">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Link Url</label>
											<input name="tlink_url" type="text" class="form-control" placeholder="Link url to open">
											<span class="text-danger tlink_url_error"></span>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label>Link Position</label>
											<select name="tlink_position" class="form-control">
												<option value="0">None</option>
												<option value="1">Footer Menu A</option>
												<option value="2">Footer Menu B</option>
												<option value="3">Footer Menu C</option>
												<option value="4">Footer Menu D</option>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label>Link Status</label>
											<select name="tlink_status" class="form-control">
												<option value="1">Enable</option>
												<option value="0">Disabled</option>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label>Is open in new tab</label>
											<select name="tlink_target_blank" class="form-control">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>
								</div>
								
								
							</form>
						</div>
						<div class="modal-footer">
							<button id="link_form_submit" type="button" class="btn btn-primary">Save changes</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
						</div>
					</div>
				</div>

					<script type="text/javascript">

						$("#link_form_submit").on('click',function(evt){

							$(".tlink_url_error").empty();

							$("#link_form_submit").btn("loading");

							var res = $('input[name="tlink_url"]').val();
							if(res != "") {
								var result = res.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
								if(result == null && !res.includes("http://localhost") && !res.includes("https://localhost")) {
									$(".tlink_url_error").text("Please enter valid link");
									$("#link_form_submit").btn("reset");
									return false;
								}
							}
							
							evt.preventDefault();

							$.ajax({
								url:'<?= base_url('themes/store_link') ?>',
								type:'POST',
								dataType:'json',
								data:$("#link_form").serializeArray(),
								complete:function(result){
									$("#link_form_submit").btn("reset");
									$('#link_form_modal').modal('hide');
								},
								success:function(response){
									let swalIcon = response.status ? 'success' : 'error';
									if(response.status) {
										let linksBody = "";

										if(response.data.length == 0) {
											linksBody = `<tr><td colspan="100%" class="text-center">No Links Available</td></tr>`;
										}

										for (let index = 0; index < response.data.length; index++) {
											const element = response.data[index];

											let link_pos = "None";
											switch (element['tlink_position']) {
												case "1":
													link_pos = "Menu A";
													break;
												case "2":
													link_pos = "Menu B";
													break;
												case "3":
													link_pos = "Menu C";
													break;
												case "4":
													link_pos = "Menu D";
													break;
												default:
													link_pos = "None";
													break;
											}

											console.log(link_pos, element['tlink_position'])

											let link_class = (element['tlink_status'] == 1) ? 'fa-toggle-on' : 'fa-toggle-off';
											let link_color = (element['tlink_status'] == 1) ? 'green' : 'red';

											linksBody += `<tr data-tlink_id="`+ element['tlink_id'] +`" data-tlink_title="`+ element['tlink_title'] +`" data-tlink_url="`+ element['tlink_url'] +`" data-tlink_position="`+ element['tlink_position'] +`" data-tlink_status="`+ element['tlink_status'] +`" data-tlink_target_blank="`+ element['tlink_target_blank'] +`">
												<td>`+ element['tlink_title'] +`</td>
												<td>`+ element['tlink_url'] +`</td>
												<td class="text-center">`+link_pos+`</td>
												<td><i class="btn_tlink_status_toggle fa `+ link_class +`" style="cursor: pointer; color: `+ link_color +`; font-size: 35px; width:50px"></i></td>
												<td>
													<a class="btn btn-primary text-white btn-sm btn_edit_tlink"><i class="fa fa-edit"></i></a>
													<a class="btn btn-danger text-white btn-sm btn_delete_tlink"><i class="fa fa-trash"></i></a>
												</td>
											</tr>`
										}
										$("#links-tbody").html(linksBody);
									}
									Swal.fire({
										icon: swalIcon,
										text: response.message,
									});
								}
							});
							return false;
						});

						$(document).on('click', '.btn_delete_tlink', function(){
							Swal.fire({
								title: 'Are you sure?',
								text: "You won't be able to revert this!",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Yes, delete it!'
							}).then((result) => {
								if (result.value) {
									let thatBtn = $(this);
									thatBtn.btn("loading");
									$.ajax({
										url:'<?= base_url('themes/delete_link') ?>',
										type:'POST',
										dataType:'json',
										data:{tlink_id:$(this).closest('tr').data('tlink_id')},
										complete:function(res){
											thatBtn.closest("tr").remove();
											Swal.fire('Deleted!', 'Your link has been deleted.', 'success');
										}
									});
								}
							});
						});

						$(document).on('click', '.btn_edit_tlink', function(){
							let dataRow = $(this).closest('tr');
							$('#link_form_modal input[name="tlink_id"]').val(dataRow.data('tlink_id'));
							$('#link_form_modal input[name="tlink_title"]').val(dataRow.data('tlink_title'));
							$('#link_form_modal input[name="tlink_url"]').val(dataRow.data('tlink_url'));
							$('#link_form_modal select[name="tlink_position"]').val(dataRow.data('tlink_position'));
							$('#link_form_modal select[name="tlink_status"]').val(dataRow.data('tlink_status'));
							$('#link_form_modal select[name="tlink_target_blank"]').val(dataRow.data('tlink_target_blank'));
							$('#link_form_modal').modal('show');
						});

						$(document).on('click', '#add_new_link', function(){
							$('#link_form_modal').modal('show');
						});

						$(document).on('change', '#slider_link_type', function(){

							$('#slider-link').val($(this).val());

						});

						$(document).on('click', ".btn_tlink_status_toggle", function(){
							let tlink_id = $(this).closest('tr').data('tlink_id');
							let tlink_status = $(this).hasClass('fa-toggle-off') ? 1 : 0;
							if(tlink_status) {
								$(this).addClass('fa-toggle-on').removeClass('fa-toggle-off');
								$(this).css("color", "green");
							} else {
								$(this).addClass('fa-toggle-off').removeClass('fa-toggle-on');
								$(this).css("color", "red");
							}

							$.ajax({
								url: "<?= base_url('themes/tlink_status_toggle') ?>",
								type: "POST",
								dataType: "json",
								data: {
									tlink_id:tlink_id,
									tlink_status:tlink_status,
								},
								success: function (response) {	
									// do nothing for now
								}
							});
						});	

						$(function() {

							$( ".sortable2" ).sortable({

								update: function( event, ui ) {

									update_homepage_sections_table();

								}

							});

							$( ".sortable2" ).disableSelection();

						});

						$(function() {

							$( ".sortable" ).sortable({

								update: function( event, ui ) {

									let positions = [];

									$(this).children('tr').each(function () {

										if($(this).data('id') != null) {

											positions.push($(this).data('id'));

										}

									});

									$.ajax({

										url: "<?= base_url('themes/change_positions')  ?>",

										type: "POST",

										dataType: "json",

										data: {table:$(this).data('table'), whe_column:$(this).data('whe_column'), pos_column:$(this).data('pos_column'),positions:JSON.stringify(positions)},

										success: function (response) {	

											console.log(response);

										}

									});

								}

							});

							$( ".sortable" ).disableSelection();

						});

					</script>



					<script type="text/javascript">

						

						var loadFile = function(event) {

							var image = document.getElementById('output');

							image.src = URL.createObjectURL(event.target.files[0]);

						};



						// 



						$(document).on('click', '.remove-runner-btn', function(){

							$(this).parent().remove();

							$('#runners-section .col-md-12').each(function( index ) {

								$(this).find('.control-label').text('Runner '+(index+1));

							});

							let count = $('#runners-section .col-md-12').length;

							if (count == 1) {

								$('#runners-section').prepend(`

								<div class="col-md-12">

									<div class="form-group">

										<label class="control-label">Runner `+count+`</label>

										<input name="top_banner_slider[]" class="form-control" type="text">

									</div>

									<button type="button" class="btn btn-danger btn-md remove-runner-btn" style="position: absolute; top: 30px; right: 11px;"><i class="fa fa-trash"></i></button>

								</div>`);

							}

						});





						$(document).on('click', '#add-more-runner-btn', function(){

							let count = $('#runners-section .col-md-12').length;

							$(this).parent().before(`

							<div class="col-md-12">

								<div class="form-group">

									<label class="control-label">Runner `+count+`</label>

									<input name="top_banner_slider[]" class="form-control" type="text">

								</div>

								<button type="button" class="btn btn-danger btn-md remove-runner-btn" style="position: absolute; top: 30px; right: 11px;"><i class="fa fa-trash"></i></button>

							</div>`);

						});



						$(".btn-slider-submit").on('click',function(evt){

							console.log('ok');

							$("#linkError").empty();

							$this = $("#admin-form");

							$(".btn-submit").btn("loading");

							$('.loading-submit').show();

							var res = $('#slider-link').val();

							if(res != "") {

								var result = res.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);

								if(result == null && !res.includes("http://localhost") && !res.includes("https://localhost"))

								{

									$("#linkError").append("Please enter valid link");

									$(".btn-submit").btn("reset");

									return false;

								}
							}

							

							evt.preventDefault();

							var formData = new FormData($("#admin-form")[0]);



							formData = formDataFilter(formData);

							

							$.ajax({

								url:'<?= base_url('themes/update_slider') ?>',

								type:'POST',

								dataType:'json',

								cache:false,

								contentType: false,

								processData: false,

								data:formData,

								xhr: function (){

									var jqXHR = null;



									if ( window.ActiveXObject ){

										jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );

									}else {

										jqXHR = new window.XMLHttpRequest();

									}

									

									jqXHR.upload.addEventListener( "progress", function ( evt ){

										if ( evt.lengthComputable ){

											var percentComplete = Math.round( (evt.loaded * 100) / evt.total );

											$('.loading-submit').text(percentComplete + "% Loading");

										}

									}, false );



									jqXHR.addEventListener( "progress", function ( evt ){

										if ( evt.lengthComputable ){

											var percentComplete = Math.round( (evt.loaded * 100) / evt.total );

											$('.loading-submit').text("Save");

										}

									}, false );

									return jqXHR;

								},

								complete:function(result){

									$(".btn-submit").btn("reset");

								},

								success:function(result){

									$('.loading-submit').hide();

									$this.find(".has-error").removeClass("has-error");

									$this.find("span.text-danger").remove();

									

									if(result['location']){

										window.location = result['location'];

									}

									console.log(result['errors']);

									if(result['errors']){

										$.each(result['errors'], function(i,j){

											$ele = $this.find('[name="'+ i +'"]');

											if($ele){

												$ele.parents(".form-group").addClass("has-error");

												$ele.after("<span class='text-danger'>"+ j +"</span>");

											}

										});

									}

								},

							})

							return false;

						});

					</script>



<script>

$(document).ready(function() {

// we will use single function for both images

function read_url(input,display_id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+display_id).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#faq_banner_image").change(function() {
  read_url(this,'output_faq_banner_image');
});

$("#contact_banner_image").change(function() {
  read_url(this,'output_contact_banner_image');
});

$("#homepage_video_section_bg").change(function() {
  read_url(this,'output_homepage_video_section_bg');
});

$("#avatar_login").change(function() {
  read_url(this,'output_login');
});

$("#avatar_registration").change(function() {
  read_url(this,'output_registration');
});

$("#avatar_terms").change(function() {
  read_url(this,'output_terms');
});

//delete page function
$(".delete_page").click(function(e){
	if(!confirm("Are your sure ?")) return false;
	var href = $(this).attr("data-href");
	var id = $(this).attr("data-id");
	$.ajax({
		url: href,
		type: "GET",
		success: function (data) {
			$(".deleterow-" + id).remove();
			var alert_div = '<div class="alert alert-success alert-dismissable" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
				'<span id="alert_msg_2">Item has been successfully deleted!</span></div>';
			// $(".alertdiv").removeClass("alert alert-danger alert-dismissable").addClass("alert alert-success alert-dismissable");
			$("#alertdiv_2").append(alert_div);
			$("#alertdiv_2").show();
			setTimeout( function(){
			$("#alertdiv_2").fadeOut();
			}  , 2000 );
		}
	});
});

//summernote editor
$('#summernote').summernote({
minHeight: 300,
toolbar: [
// [groupName, [list of button]]
['style', ['bold', 'italic', 'underline', 'clear']],
['font', ['strikethrough', 'superscript', 'subscript']],
['fontsize', ['fontsize']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['height', ['height']]
]
});
});

</script>

<script type="text/javascript">

$(".confirm").on('click',function(){

if(!confirm("Are your sure ?")) return false;

		return 1;

	})

</script>

<script type="text/javascript">

$('.setting-nnnav li a').on('shown.bs.tab', function(event){

var x = $(event.target).attr('href');

	$(".btn-submit").hide();

if(x != '#tab_sliders'){

	$(".btn-submit").show();

}

localStorage.setItem("last_pill", x);

});

$(document).on('ready',function() {

	var last_pill = localStorage.getItem("last_pill");

	if(last_pill){ $('[href="'+ last_pill +'"]').click() }

});

// this function is used for save theme setting

$(".btn-submit-theme").on('click',function(evt){

	evt.preventDefault();

	$this = $("#admin-form");

	$(".btn-submit").btn("loading");

	$('.loading-submit').show();

	

	let is_invalid_form = false;

	let links_array = ["youtube_link", "facebook_link", "twitter_link", "instegram_link", "banner_button_link"]

	$.each(links_array, function( index, value ) {

		$("#"+value+"_error").empty();

		let link = $('#'+value).val();

		if(link != "") {
			let is_valid = link.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);

			if(is_valid == null || !link.includes("http://localhost") || !link.includes("https://localhost")) {

				is_invalid_form = true;

				$("#"+value+"_error").append("Please enter valid link");

			}

		}

	});

	

	$("#whatsapp_number_error").empty();

	let whatsapp_number = $("input[name='whatsapp_number']").val();	

	if(whatsapp_number != "") {
		let whatsapp_number_is_valid = whatsapp_number.match(/^\+[1-9]{1}[0-9]{3,14}$/g);

		if(whatsapp_number_is_valid == null) {

			is_invalid_form = true;

			$("#whatsapp_number_error").append("Please enter valid mobile number.");

		}
	
	}


	$("#contact_us_phone_error").empty();

	let contact_us_phone_number = $("input[name='contact_us_phone']").val();	

	if(contact_us_phone_number != "") {
		let contact_us_phone_is_valid = contact_us_phone_number.match(/^\+[1-9]{1}[0-9]{3,14}$/g);

		if(contact_us_phone_is_valid == null) {

			is_invalid_form = true;

			$("#contact_us_phone_error").append("Please enter valid mobile number.");

		}
	}

	let contact_us_email = $("input[name='contact_us_email']").val();
	if(contact_us_email != "") {	
		if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($("input[name='contact_us_email']").val())) {
			is_invalid_form = true;
			$("#contact_us_email_error").append("Please enter valid email address.");
		}
	}


	if(is_invalid_form) {

		$(".btn-submit").btn("reset");

		return false;

	}



var formData = new FormData($("#admin-form")[0]);

formData = formDataFilter(formData);

$.ajax({

url:'<?= base_url('themes/update_settings') ?>',

type:'POST',

dataType:'json',

cache:false,

contentType: false,

processData: false,

data:formData,

xhr: function (){

var jqXHR = null;

if ( window.ActiveXObject ){

jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );

}else {

jqXHR = new window.XMLHttpRequest();

}

jqXHR.upload.addEventListener( "progress", function ( evt ){

if ( evt.lengthComputable ){

var percentComplete = Math.round( (evt.loaded * 100) / evt.total );

$('.loading-submit').text(percentComplete + "% Loading");

}

}, false );

jqXHR.addEventListener( "progress", function ( evt ){

if ( evt.lengthComputable ){

var percentComplete = Math.round( (evt.loaded * 100) / evt.total );

$('.loading-submit').text("Save");

}

}, false );

return jqXHR;

},

complete:function(result){

$(".btn-submit-theme").btn("reset");

},

success:function(result){

$('.loading-submit').hide();

$this.find(".has-error").removeClass("has-error");

$this.find("span.text-danger").remove();

if(result['location']){

window.location = result['location'];

}

console.log(result['errors']);

if(result['errors']){

$.each(result['errors'], function(i,j){

$ele = $this.find('[name="'+ i +'"]');

if($ele){

$ele.parents(".form-group").addClass("has-error");

$ele.after("<span class='text-danger'>"+ j +"</span>");

}

});

}

},

})

return false;

});

$(".alert").fadeTo(2000, 500).slideUp(500, function(){

$(".alert").alert('close');

});



function update_homepage_sections_table(){

	$('.home_sections_positions_loading').show();



	let sec_id = $('input[name="sec_id[]"]').map(function(){ 

		return this.value; 

	}).get();



	let sec_status = $('input[name="sec_status[]"]').map(function(){ 

		return this.value; 

	}).get();



	$.ajax({

		url: "<?= base_url('themes/change_home_sections_positions')  ?>",

		type: "POST",

		data: { 'sec_id[]': sec_id, 'sec_status[]': sec_status},

		xhr: function (){

			var jqXHR = null;

			if ( window.ActiveXObject ){

				jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );

			}else {

				jqXHR = new window.XMLHttpRequest();

			}

			jqXHR.upload.addEventListener( "progress", function ( evt ){

				if ( evt.lengthComputable ){

					var percentComplete = Math.round( (evt.loaded * 100) / evt.total );

					// $('.home_sections_positions_loading').text(percentComplete + "% completed");

				}

			}, false );

			jqXHR.addEventListener( "progress", function ( evt ){

				if ( evt.lengthComputable ){

					var percentComplete = Math.round( (evt.loaded * 100) / evt.total );

					// $('.home_sections_positions_loading').text(percentComplete + "% completed");

				}

			}, false );

			return jqXHR;

		},

		complete: function(){

			// $('.home_sections_positions_loading').text("Records Updated Successfully!");

			setTimeout(function(){ $('.home_sections_positions_loading').hide(); }, 500);

		}

	});

}



function change_section_status(id){

	let status = $('#section_status_'+id).val();

	if ( status == 1 ) {

		$('#section_status_'+id).val(0);

		$('#section_status_active_'+id).addClass('fa-toggle-off');

		$('#section_status_active_'+id).removeClass('fa-toggle-on');

		$('#section_status_active_'+id).css("color", "red");

	} else {

		$('#section_status_'+id).val(1);

		$('#section_status_active_'+id).addClass('fa-toggle-on');

		$('#section_status_active_'+id).removeClass('fa-toggle-off');

		$('#section_status_active_'+id).css("color", "green");

	}

	update_homepage_sections_table();

}

function change_page_status(id){

	var page_status = $('#page_status_'+id).val();

	if (page_status== 1) {

		var status = 0;

		var msg = "Page Inactive successfully";

	}else{

		var status = 1;

		var msg = "Page Active successfully";

	}

	// call ajax

	$.ajax({

	url: "<?= base_url('themes/update_page_status/')  ?>",

	type: "POST",

	dataType: "json",

	data: {id:id,status:status},

	success: function (data)

	{	

		if (page_status == 1) {

			$('#page_status_active_'+id).addClass('fa-toggle-off');

			$('#page_status_active_'+id).removeClass('fa-toggle-on');

			$('#page_status_active_'+id).css("color", "red");

			$('#page_status_'+id).val(0);

		}

		if (page_status == 0) {

			// its mean current status is active 

			$('#page_status_active_'+id).addClass('fa-toggle-on');

			$('#page_status_active_'+id).removeClass('fa-toggle-off');

			$('#page_status_active_'+id).css("color", "green");

			$('#page_status_'+id).val(1);

		}

	}
	});
}


$(document).on('click', '.btn-delete-image', function(){
	let input_name = $(this).data('img_input');
	let image_ele_id = $(this).data('img_ele');
	let placeholder_image = $(this).data('img_placeholder');
	$('input[name="'+input_name+'"]').val('');
	$('#'+image_ele_id).attr('src', placeholder_image);
	$(this).remove()
});

</script>