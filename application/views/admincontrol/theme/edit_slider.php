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
					<input type="hidden" name="slider_id" value="<?= $slider->slider_id ?>">
					<input type="hidden" name="hidden_image" id="hidden_image" value="<?= $slider->image ?>">

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Title</label>
								<input placeholder="Title" name="title" value="<?php echo $slider->title; ?>" class="form-control" type="text">
							</div>

							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea class="form-control" rows=5 name="description"><?php echo $slider->description; ?></textarea>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Link</label>
								<input placeholder="Link" name="link" id="link" class="form-control" value="<?php echo $slider->link; ?>" type="text">
								<span class="text-danger" id="linkError"></span>
							</div>
							<div class="form-group">
								<label class="control-label">Button Text</label>
								<input placeholder="Button Text" name="button_text" class="form-control" value="<?php echo $slider->button_text; ?>" type="text">
							</div>
						</div>
						<div>
        				    <div class="form-group">
								<label class="control-label">Status</label>
								<div>
									<input type="radio" <?php echo ($slider->status == 1) ? "checked" : "" ?>  name="status" value="1">Active
									<input type="radio" <?php echo ($slider->status == 0) ? "checked" : "" ?>  name="status" value="0">Inactive
								</div>
							</div>
        				</div>
        				
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
									
									
									if($slider->image !=''){
									   $avatar= '/assets/images/theme_images/'.$slider->image;
									}else{
									    $avatar= 'assets/images/no-image-available.gif';
									}
									?>
						
						<img id="output"  src="<?php echo base_url().$avatar;?>" class="thumbnail" border="0" width="220px" />
						
								</div>
					</div>

					<div class="form-group">
						<button type="button" class="btn btn-primary btn-submit"> Update </button>
						<span class="loading-submit"></span>
					</div>
				</form>
			</div>
		</div> 
	</div> 
</div>

<script type="text/javascript">
	
	var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};



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