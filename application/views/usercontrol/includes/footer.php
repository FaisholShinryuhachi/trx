<?php 
	$db =& get_instance(); 
	$userdetails =$db->Product_model->userdetails('user'); 
	$SiteSetting =$db->Product_model->getSiteSetting();
?>
</div> <!-- content -->


<?php 
	$global_script_status = (array)json_decode($SiteSetting['global_script_status'],1);
	if(in_array('affiliate', $global_script_status)){
		echo $SiteSetting['global_script'];
	}
?>
<footer class="footer"><?= $SiteSetting['footer'] ?></footer>
</div>
<!-- End Right content here -->
</div>

<script src="<?php echo base_url('assets/js/jquery-confirm.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/detect.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/fastclick.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.slimscroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.blockUI.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/waves.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.nicescroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vertical/assets/plugins/skycons/skycons.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vertical/assets/plugins/raphael/raphael-min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vertical/assets/plugins/morris/morris.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/dashborad.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jssocials-1.4.0/jssocials.min.js'); ?>"></script>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/js/jssocials-1.4.0/jssocials.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/js/jssocials-1.4.0/jssocials-theme-flat.css'); ?>" />

<link href="<?php echo base_url('assets/js/summernote-0.8.12-dist/summernote-bs4.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/js/summernote-0.8.12-dist/summernote-bs4.js'); ?>"></script>

<link href="<?php echo base_url('assets/vertical/assets/css/style.css'); ?>?v=<?= av() ?>" rel="stylesheet" type="text/css">

<div class="modal fade" id="ip-flag_model">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">All IPs Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-create-slug">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?php echo base_url('/usercontrol/create_slug') ?>" method="post" id="form-create-slug">
	            <div class="modal-header">
	                <h6 class="modal-title m-0">Create Slug</h6>
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            </div>
	            <div class="modal-body">
	                <div class="form-group">
	                    <label class="control-label">Slug</label>
	                    <div>
	                        <input type="text" name="slug" class="form-control" placeholder="Enter Slug Here..." />
	                        <input type="hidden" name="type" />
	                        <input type="hidden" name="related_id" />
	                        <input type="hidden" name="target" />
	                    </div>
	                </div>
	                <div class="div-slug-url" style="display: none;">
	                	<div class="copy-input input-group">
	                    	<input type="text" readonly="readonly" class="form-control" />
	                        <button type="button" copytoclipboard="" class="input-group-addon"></button>
	                    </div>
	                </div>
	            </div>
	            <div class="modal-footer">
	            	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="submit" name="create_slug" class="btn btn-success">Create</button>
	                <button type="button" name="delete_slug" class="btn btn-danger btn-delete-slug">Delete</button>
	            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).delegate('[name="slug"]','keyup',function(){
		var slug = $(this).val();
		var base_url = "<?php echo base_url() ?>";
		$('#form-create-slug').find('.div-slug-url input').val(base_url+slug);
	});
	$(document).delegate('.btn-model-slug', 'click', function(){
	    $form = $('#form-create-slug');
	    $form[0].reset();
	    $form.find(".alert").remove();
	    $form.find(".has-error").removeClass("has-error");
	    $form.find("span.text-danger").remove();

	    var type = $(this).attr('data-type');
	    var related_id = $(this).attr('data-related-id');
	    var target = $(this).attr('data-input-class');

	    $this = $(this);
	    $.ajax({
	        url:"<?php echo base_url('usercontrol/get_slug') ?>",
	        type:'POST',
	        dataType:'json',
	        data:{
	            type: type,
	            related_id: related_id
	        },
	        beforeSend:function(){$this.btn("loading");},
	        complete:function(){$this.btn("reset");},
	        success:function(json){
	            $form.find('.div-slug-url').hide();
	            $form.find('.btn-delete-slug').hide();
	            
	            if(json['success']){
	            	$form.find('.div-slug-url button').attr('copytoclipboard',json.slug_url);
	            	$form.find('.div-slug-url input').val(json.slug_url);
	            	$form.find('.btn-delete-slug').show();
	            	$form.find('.div-slug-url').show();
	                $('#modal-create-slug').find('[name="slug"]').val(json['slug']);
	            }

	            $('#modal-create-slug').find('[name="type"]').val(type);
	            $('#modal-create-slug').find('[name="related_id"]').val(related_id);
	            $('#modal-create-slug').find('[name="target"]').val(target);
	            $('#modal-create-slug').modal({'keyboard':false, 'backdrop': 'static'});
	        },
	    })
	});
	$('#modal-create-slug').delegate('#form-create-slug', 'submit', function(e){
	    e.preventDefault();

	    $this = $(this);
	    $this_btn = $this.find('[name="create_slug"]');
	    $target = $this.find('[name="target"]').val();
	    
	    $.ajax({
	        url:$this.attr('action'),
	        type:'POST',
	        dataType:'json',
	        data:$this.serialize(),
	        beforeSend:function(){$this_btn.btn("loading");},
	        complete:function(){$this_btn.btn("reset");},
	        success:function(json){
	            $container = $this;
	            $container.find(".has-error").removeClass("has-error");
	            $container.find("span.text-danger").remove();
	            $container.find(".alert").remove();
	            
	            if(json['errors']){
	                $.each(json['errors'], function(i,j){
	                    $ele = $container.find('[name="'+ i +'"]');
	                    if($ele){
	                        $ele.parents(".form-group").addClass("has-error");
	                        $ele.after("<span class='text-danger'>"+ j +"</span>");
	                    }
	                })
	                $this.find('.div-slug-url').hide();
	            }

	            if(json['error']){
	                $this.find('.modal-body').prepend('<div class="alert bg-danger text-white">'+json['error']+'</div>');
	            }

	            if(json['success']){
	            	$.each($('.'+$target), function(k,v){
	            		if($(v).attr('data-addition-url')){
	            			var addition_url = $(v).attr('data-addition-url');
	            			$(v).val(json.slug_url + addition_url);
	            			$(v).next('[copyToClipboard]').attr('copyToClipboard', json.slug_url + addition_url);
	            		}else{
	            			$(v).val(json.slug_url);
	            			$(v).next('[copyToClipboard]').attr('copyToClipboard', json.slug_url);
	            		}
	            	});

	            	$this.find('.div-slug-url').show();
	                $this.find('.div-slug-url button').attr('copytoclipboard',json.slug_url);
	                $this.find('.div-slug-url input').val(json.slug_url);
	                $this.find('.modal-body').prepend('<div class="alert alert-success">'+json['success']+'</div>');
	            }
	        },
	    })
	});

	$('#modal-create-slug').delegate('.btn-delete-slug', 'click', function(){
	    if(!confirm('Are you sure?')) return false;

	    $this = $('#form-create-slug');
	    $this_btn = $(this);
	    $target = $this.find('[name="target"]').val();
	    
	    $.ajax({
	        url: '<?php echo base_url('/usercontrol/delete_slug') ?>',
	        type:'POST',
	        dataType:'json',
	        data:$this.serialize(),
	        beforeSend:function(){$this_btn.btn("loading");},
	        complete:function(){$this_btn.btn("reset");},
	        success:function(json){
	            $container = $this;
	            $container.find(".alert").remove();
	            
	            if(json['error']){
	                $this.find('.modal-body').prepend('<div class="alert alert-danger">'+json['error']+'</div>');
	            }

	            if(json['success']){
	            	$.each($('.'+$target), function(k,v){
	            		if($(v).attr('data-addition-url')){
	            			var addition_url = $(v).attr('data-addition-url');
	            			$(v).val(json.url + addition_url);
	            			$(v).next('[copyToClipboard]').attr('copyToClipboard', json.url + addition_url);
	            		}else{
	            			$(v).val(json.url);
	            			$(v).next('[copyToClipboard]').attr('copyToClipboard', json.url);
	            		}
	            	});

	            	$this.find('.div-slug-url').hide();
	                $this.find('.div-slug-url input').val(json.url);
	                $this.find('[name="slug"]').val('');
	                $this_btn.hide();
	                $this.find('.modal-body').prepend('<div class="alert alert-success">'+json['success']+'</div>');
	                setTimeout(function(){
	                	$('#modal-create-slug').modal('hide');
	                }, 2000);
	            }
	        },
	    })
	});
</script>

<!-- App js -->
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>

<script type="text/javascript">
	$(".select2-input").select2();

	$(document).delegate(".only-number-allow","keypress",function (e) {
     	if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
       		return false;
    	}
   	});

	function readURL(input,placeholder) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $(placeholder).attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	function sumNote(element){
    	
        var height = $(element).attr("data-height") ? $(element).attr("data-height") : 500;
        $(element).summernote({
            disableDragAndDrop: true,
            height: height,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'image', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            buttons: {
                image: function() {
                    var ui = $.summernote.ui;
                    // create button
                    var button = ui.button({
                        contents: '<i class="fa fa-image" />',
                        tooltip: false,
                        click: function () {
                            $('#modal-image').remove();
                        
                            $.ajax({
                                url: '<?= base_url("filemanager") ?>',
                                dataType: 'html',
                                beforeSend: function() {
                                },complete: function() {
                                },success: function(html) {
                                    $('body').append('<div id="modal-image" class="modal fade">' + html + '</div>');
                                    $('#modal-image').modal('show');
                                    $('#modal-image').delegate('.image-box .thumbnail','click', function(e) {
                                        e.preventDefault();
                                        $(element).summernote('insertImage', $(this).attr('href'));
                                        $('#modal-image').modal('hide');
                                    });
                                }
                            });                     
                        }
                    });
                
                    return button.render();
                }
            }
        });
    }
	
	$(document).delegate(".view-all",'click',function(){
		var data = $(this).find("span").html();
		var html = '<table class="table table-hover">';
		data = JSON.parse(data);
		html += '<tr>';
		html += '	<th>IP</th>';
		html += '	<th width="30px">Country</th>';
		html += '</tr>';

		$.each(data, function(i,j){
			html += '<tr>';
			html += '	<td>'+ j['ip'] +'</td>';
			html += '	<td><img style="width: 20px;" src="<?= base_url('assets/vertical/assets/images/flags/') ?>'+ j['country_code'].toLowerCase() +'.png" ></td>';
			html += '</tr>';
		})
		html += '</table>';

		$("#ip-flag_model").modal("show");
		$("#ip-flag_model .modal-body").html(html);
	})
	$(document).delegate(".copy-input input",'click', function(){
		$(this).select();
	})
	$(document).delegate('[copyToClipboard]',"click", function(){
		$this = $(this);
	  	var $temp = $("<input>");
	  	$("body").append($temp);
	  	$temp.val($(this).attr('copyToClipboard')).select();
	  	document.execCommand("copy");
	  	$temp.remove();
	  	$this.tooltip('hide').attr('data-original-title', 'Copied!').tooltip('show');
	  	setTimeout(function() { $this.tooltip('hide'); }, 500);
	});
	$('[copyToClipboard]').tooltip({
	  trigger: 'click',
	  placement: 'bottom'
	});
</script>
<script>
	/* BEGIN SVG WEATHER ICON */
	if (typeof Skycons !== 'undefined'){
		var icons = new Skycons(
		{"color": "#fff"},
		{"resizeClear": true}
		),
		list  = [
		"clear-day", "clear-night", "partly-cloudy-day",
		"partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
		"fog"
		],
		i;
		
		for(i = list.length; i--; )
		icons.set(list[i], list[i]);
		icons.play();
	};
	
	// scroll
	
	$(document).on('ready',function() {
        if($("#boxscroll").length > 0){
			$("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#cecece",boxzoom:true});
		}
		if($("#boxscroll2").length > 0){
			$("#boxscroll2").niceScroll({cursorborder:"",cursorcolor:"#cecece",boxzoom:true}); 
		}
	});
	
	function shownofication(id,url){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>usercontrol/updatenotify",
			data:{'id':id},
			dataType:'json',
			success: function(data){
				window.location.href=data['location'];
			}
		});
	}
</script>
<!-- <script src="<?php echo base_url(); ?>assets/vertical/assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js" type="text/javascript"></script> -->

<?php 
	$usercontrol = true;
	require APPPATH . 'views/common/setting_widzard.php'; 
?>

<script>
function start_plan_expiration_timer() {
	if($('span[data-time-remains]').length) {
		let countdown = $('span[data-time-remains]').data('time-remains');
		if(countdown > 0) {
			Window.GlobaleCountDownDate = (new Date().getTime()) + (countdown * 1000);
			var GlobaleCountDownDateInterval = setInterval(function() {
				var now = new Date().getTime() + 1000;
				distance = ((Window.GlobaleCountDownDate - now) / 1000).toFixed(0);

				var days        = Math.floor(distance/24/60/60);
				var hoursLeft   = Math.floor((distance) - (days*86400));
				var hours       = Math.floor(hoursLeft/3600);
				var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
				var minutes     = Math.floor(minutesLeft/60);
				var remainingSeconds = distance % 60;

				let string = "";

				string += (days > 0) ? ('0'+days).slice(-2)+" days " : ""; 

				string += (hours > 0) ? ('0'+hours).slice(-2)+" Hours " : ""; 

				string += (minutes > 0) ? ('0'+minutes).slice(-2)+" Minutes " : ""; 

				string += (remainingSeconds > 0) ? ('0'+remainingSeconds).slice(-2)+" Seconds " : "00 Seconds"; 

				$('span[data-time-remains]').text(string);
				if (distance <= 0) {
					$('span[data-time-remains]').text('Plan Has Expired');
					window.location.reload();
					clearInterval(GlobaleCountDownDateInterval);
				}
			}, 1000);
		}
	}	
}
</script>
</body>
</html>
