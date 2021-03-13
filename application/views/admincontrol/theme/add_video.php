<style>
.tooltip-inner {
	text-align:left;
    max-width: 100% !important;
}
</style>

<div class="row">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-header">
				<h4 class="card-title pull-left">Video</h4>
				<div class="pull-right">
					<a class="btn btn-primary" href="<?= base_url('themes/multiple_theme/')  ?>"><?= __('admin.cancel') ?></a>
				</div>
			</div>
			<div class="card-body">
				<form id="admin-form">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Video Title</label>
								<input placeholder="Enter title for video" name="video_title" value="" class="form-control" type="text">
							</div>
							<div class="form-group">
								<label class="control-label">Video Sub Title</label>
								<input placeholder="Enter sub title for video" name="video_sub_title" value="" class="form-control" type="text">
							</div>
							<div class="form-group">
								<label class="control-label">Video Link <span data-html="true"  data-placement="right" data-toggle="tooltip" data-container="body" title="<h6>we support all links like:</h6> <ul><li>https://www.youtube.com/watch?v=R1StjWM_LOE&feature=youtu.be</li><li>https://www.youtu.com/R1StjWM_LOE</li><li>https://www.youtube.com/embed/R1StjWM_LOE</li></ul>"></span></label>
								<input placeholder="Enter url/link of video" name="video_link" id="link" class="form-control" value="" type="text" >
								<span class="text-danger" id="linkError"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Status</label>
								<div>
									<input type="radio" <?php echo ($video->status == 1) ? "checked" : "" ?>  name="status" value="1">Active
									<input type="radio" <?php echo ($video->status == 0) ? "checked" : "" ?>  name="status" value="0">Inactive
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="ifrm_id"></iframe>
						</div>

					</div>
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-submit"> Submit </button>
						<span class="loading-submit"></span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script>
  $("#link").change(function(){
  	var url = $('#link').val();
	if(url.toLowerCase().includes("youtube") && !url.toLowerCase().includes("embed")){
		$id = url.split("v=");
		url = 'https://www.youtube.com/embed/'+$id[1];
	} else if(url.toLowerCase().includes("youtu") && !url.toLowerCase().includes("embed")){
		$id = url.split("/");
		url = 'https://www.youtube.com/embed/'+$id[3];
	}
  	loadIframe('ifrm_id',url);
});

  function loadIframe(iframeName, url) {
    var $iframe = $('#' + iframeName);
    if ( $iframe.length ) {
        $iframe.attr('src',url);   
        return false;
    }
    return true;
}
</script>


<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				jQuery('#blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	

	$(".btn-submit").on('click',function(evt){
	$("#linkError").empty();
$this = $("#admin-form");
$(".btn-submit").btn("loading");
		$('.loading-submit').show();
		var res = $('#link').val();
var result = res.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
if(result == null)
{
$("#linkError").append("Please enter valid link");
$(".btn-submit").btn("reset");
return false;
}
evt.preventDefault();
var formData = new FormData($("#admin-form")[0]);
formData = formDataFilter(formData);
$.ajax({
url:'<?= base_url('themes/save_video') ?>',
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