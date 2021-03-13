<span id="alertdiv" style="display: none">
<div class="alert alert-danger alert-dismissable" >
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<span id="alert_msg"></span>
</div>
</span>
<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-header">
				<h4 class="card-title pull-left">Page Content</h4>
				<div class="pull-right">
					<a class="btn btn-primary" href="<?= base_url('themes/multiple_theme/')  ?>"><?= __('admin.cancel') ?></a>
				</div>
			</div>
			<div class="card-body">
				<form id="form" action='#' method='post' name='process' class="" name="add_page">
					<input type="hidden" name="page_id" value="<?= (int)$page->id ?>">
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Page Name</label>
										<input id="page_name"  placeholder="Page Name" name="page_name" value="<?php echo $page->page_name; ?>" class="form-control" type="text">
										<span id="er_page_name" style="color: red;display: none">Page name required</span>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Content Title</label>
										<input id="page_content_title"  placeholder="Title" name="page_content_title" value="<?php echo $page->page_content_title; ?>" class="form-control" type="text">
										<span id="er_page_content_title" style="color: red;display: none">Content Title Required</span>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Top Banner Title</label>
										<input id="top_banner_title"  placeholder="Title" name="top_banner_title" value="<?php echo $page->top_banner_title; ?>" class="form-control" type="text">
										<span id="er_top_banner_title" style="color: red;display: none">Top Banner Title required</span>
									</div>

								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Top Banner Sub Title</label>
										<input id="top_banner_sub_title"  placeholder="Title" name="top_banner_sub_title" value="<?php echo $page->top_banner_sub_title; ?>" class="form-control" type="text">
										<span id="er_top_banner_sub_title" style="color: red;display: none">Top Banner Sub Title required</span>
									</div>
								</div>
								
								
								<div class="col-sm-12">
									<div class="form-group">
										<label class="control-label">Page Content</label>
										<br/>
										<span id="er_page_content" style="color: red;display: none">Page Content required</span>
										<textarea id="summernote" class="form-control" name="page_content">
										<?php echo $page->page_content; ?>
										</textarea>
									</div>
								</div>
								<div class="col-md-3">
									<fieldset>
										<legend>Active Your Page</legend>
										<div class="form-group">
											<label class="control-label">Status</label>
											<div>
												<input type="radio"<?php echo ($page->status == 1) ? "checked" : "" ?>  name="status" value="1">Active
												<input type="radio"<?php echo ($page->status == 0) ? "checked" : "" ?>  name="status" value="0">Inactive
											</div>
										</div>
									</fieldset>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="link_footer_section">Footer Section To Display Page Link</label>
										<select class="form-control" id="link_footer_section">
											<option value="1">Menu A</option>
											<option value="2">Menu B</option>
											<option value="3">Menu C</option>
											<option value="4">Menu D</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-3 mt-3">
								<button type="button"class="btn btn-primary btn-user btn-block submit_btn">Save Page</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	
$('#summernote').summernote({
minHeight: 300,
toolbar: [
['style', ['style']],
['font', ['bold', 'underline', 'clear']],
['fontname', ['fontname']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
['table', ['table']],
['insert', ['link', 'picture', 'video']],
['view', ['fullscreen', 'codeview', 'help']],
],
});
});


//this is the save function using ajax function
$("button").click(function(e) {
	e.preventDefault();

	$(".alert").hide();
	var show_error = null;
	var link_footer_section = $("#link_footer_section").val(); 
	var page_name = $("#page_name").val(); 
	if (page_name == '' || page_name == null || !page_name.replace(/\s/g, '').length) {
		$('#er_page_name').show();
		show_error = true;
	}else{
		$('#er_page_name').hide();
	}
	var page_content_title = $("#page_content_title").val();
	if (page_content_title == '' || page_content_title == null || !page_content_title.replace(/\s/g, '').length) {
		$('#er_page_content_title').show();
		show_error = true;
	}else{
		$('#er_page_content_title').hide();
	}
	var top_banner_title = $("#top_banner_title").val();
	if (top_banner_title == '' || page_content_title == null || !top_banner_title.replace(/\s/g, '').length) {
		$('#er_top_banner_title').show();
		show_error = true;
	}else{
		$('#er_top_banner_title').hide();
	}
	var top_banner_sub_title = $("#top_banner_sub_title").val();
	if (top_banner_sub_title == '' || page_content_title == null || !top_banner_sub_title.replace(/\s/g, '').length) {
		$('#er_top_banner_sub_title').show();
		show_error = true;
	}else{
		$('#er_top_banner_sub_title').hide();
	}
	var status = $("input[name='status']:checked").val();
	
	var summernote = $('#summernote').summernote('code');
	if (summernote == '' || summernote == null || !summernote.replace(/\s/g, '').length) {
		$('#er_page_content').show();
		show_error = true;
	}else{
		$('#er_page_content').hide();
	}
	if (show_error == true) {
		return false;
	}

$.ajax({
url: "<?php echo base_url();?>themes/save_page",
type: "POST",
data: {page_name:page_name,page_content_title:page_content_title,top_banner_title:top_banner_title,top_banner_sub_title:top_banner_sub_title,status:status,page_content:summernote,link_footer_section:link_footer_section},
success: function(data){
data = JSON.parse(data);
if(data.status == "success"){
window.location.href= "<?php echo base_url();?>themes/multiple_theme";
}
else
{
	$("#alertdiv").html(data.message);
}
}
});
});


$('input').on('keypress', function (event) {
var regex = new RegExp("^[a-zA-Z0-9 ]+$");
var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
if (!regex.test(key)) {
event.preventDefault();
return false;
}
});
</script>