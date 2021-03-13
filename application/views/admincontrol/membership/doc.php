<link rel="stylesheet" type="text/css" href="<?= base_url('assets/integration/prism/css.css') ?>?v=<?= av() ?>">

<script type="text/javascript" src="<?= base_url('assets/integration/prism/js.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/plugins/html2canvas/html2canvas.js') ?>"></script>

<script type="text/javascript" src="<?= base_url('assets/plugins/html2canvas/jspdf.debug.js') ?>"></script>

<script type="text/javascript">

	function download(){

		$(".no-pdf").hide();

		$(".btn-export-pdf").btn("loading");



		var HTML_Width = $("#doc-html").width();

		var HTML_Height = $("#doc-html").height();

		var top_left_margin = 15;

		var PDF_Width = HTML_Width+(top_left_margin*2);

		var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);

		var canvas_image_width = HTML_Width;

		var canvas_image_height = HTML_Height;

		

		var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;



		html2canvas($("#doc-html")[0],{allowTaint:true}).then(function(canvas) {

			canvas.getContext('2d');

			

			var imgData = canvas.toDataURL("image/jpeg", 1.0);

			var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);

		    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);

			

			for (var i = 1; i <= totalPDFPages; i++) { 

				pdf.addPage(PDF_Width, PDF_Height);

				pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);

			}

			

		    pdf.save("<?= __('admin.payment_api_documentation') ?>.pdf");



		    $(".no-pdf").show();

		    $(".btn-export-pdf").btn("reset");

        });

	}

</script>

<?php 

	function ___h($text,$lan){

		$text = implode("\n", $text);

		$text = htmlentities($text);

		$text = '<pre class="language-'.$lan.'"><code class="language-'.$lan.'">'.$text.'</code></pre>';

		return $text;

	}



	$base_url  = base_url();

?>

<div id="doc-html">

	<div class="row">

		<div class="col-sm-12">

		    <div class="card">

		    	<div class="card-header">

		    		<h4 class="card-title pull-left m-0">How to create payment method</h4>

		    		<div class="pull-right">

		    			<button type="button" onclick="download()" class="btn btn-export-pdf btn-primary btn-sm">Download As PDF</button>

		    		</div>

		    	</div>

		    	<div class="card-body payment-doc">

		    		<p>There are several payment methods available itself and. Although sometimes you'll find yourself in the situation where you need something different, either there is no method available for your choice of payment gateway or you want some different logic. In either case, you're left with the only option: To create a new payment method module.</p>



		    		<p>We'll assume that our custom payment method name is "custom". There are at least three or four files you need to create in order to set up the things. Let's check the same in detail.</p>



		    		<p>You need to create three file. each file are required. following are the folder structure.</p>

		    		<ol>

		    			<li>controllers -> custom.php</li>

		    			<li>admin_settings -> custom.php</li>

		    			<li>user_settings -> custom.php</li>

		    			<li>confirm_view -> custom.php</li>

		    			<li>logo  -> custom.png </li>

		    		</ol>



		    		<div id="wpg-doc">

		    			<div class="card">

		    				<div class="card-header"><h2 class="mb-0">#1 controllers folder</h2></div>

	    					<div class="card-body">

	    						In this folder contain custom.php file. in this file contain all logic of your payment gateway. some function are required in this file listed below.



	    						<h6>Example for custom.php</h6>

	    						<?php

									$code = array();

									$code[] = '<?php';

									$code[] = '	class custom {';

									$code[] = '		public $title = \'Custom Payment Gateway\';';

									$code[] = '		public $website = \'\';';

									$code[] = '		';

									$code[] = '		function __construct($api){ $this->api = $api; }';

									$code[] = '		';

									$code[] = '		public function onInstall() {}';

									$code[] = '		public function onUnInstall() {}';

									$code[] = '		public function doPayment($plan_id) {';

									$code[] = '			$plan = MembershipPlan::find($plan_id);';

									$code[] = '			$user = User::auth(\'user\');';

									$code[] = '			$membership = $plan->buy($user,$status_id=0, $comment = \'Wait till admin respond\',$payment_method=\'Bank Transfer\');';

									$code[] = '			if($membership){';

									$code[] = '				redirect(\'usercontrol/membership_purchase_details/\'. $membership->id);';

									$code[] = '			}';

									$code[] = '		}';

									$code[] = '	}';

									echo ___h($code,'php');

								?>



								<h6>Explanation of file:</h6>

								<div>

									<div>

										<b>Class Name</b> Class name must be file name

									</div>



									<div>

										<b>Public Property Title</b> Name of payment gateway

									</div>



									<div>

										<b>Constructor</b> Constructor must be as it is.. api variable contain this object of CI. you can used functionality of CI

									</div>



									<div>

										<b>Public Function onInstall</b> This function will call when plugin will be installed.

									</div>



									<div>

										<b>Public Function onUnInstall</b> This function will call when plugin will be un-install.

									</div>



									<div>

										<b>Custom function : doPayment</b> This is custom function. its optional. you can create as your need



										if you want to call your custom function than URL is like this 



										<code>/membership_callback/custome/doPayment</code>

									</div>

								</div>

	    					</div>

		    			</div>

		    			<div class="card">

		    				<div class="card-header"><h2 class="mb-0">#2 admin_settings folder</h2></div>

	    					<div class="card-body">

	    						In this folder contain custom.php file. custom.php file use for setting of admin. some time you need to ask information from admin for example credential of payment gateway or something else. you just need to create a input out system will auto create a setting page and save setting data. in this this contain $setting_data variable in this variable contain all saved setting of your payment gateway.



	    						<h6>Example for custom.php</h6>

	    						<?php

									$code = array();

									$code[] = '<div class="form-group">';

									$code[] = '	<label class="form-control-label">Some Setting</label>';

									$code[] = '	<input class="form-control" name="name" value="<?= $setting_data["name"] ?>" >';

									$code[] = '</div>';

									echo ___h($code,'php');

								?>

	    					</div>

		    			</div>



		    			<div class="card">

		    				<div class="card-header"><h2 class="mb-0">#3 user_settings folder</h2></div>

	    					<div class="card-body">

	    						In this folder contain custom.php file. custom.php file use for setting of user. some time you need to ask information from users for example paypal email, bank details or something else. you just need to create a input out system will auto create a setting page. you need to create a ajax function to submit data and validate like this



	    						<h6>Example for custom.php</h6>

	    						<?php

									$code = array();

									$code[] = '<div class="form-group">';

									$code[] = '	<label class="form-control-label">Note</label>';

									$code[] = '	<input class="form-control" name="note" >';

									$code[] = '</div>';

									$code[] = '<script type="text/javascript">';

									$code[] = '	$("#payment-form-custom").submit(function(){';

									$code[] = '		$this = $(this);';

									$code[] = '		$.ajax({';

									$code[] = '			url:\'<?= base_url("membership_callback/custom/doPayment") ?>\',';

									$code[] = '			type:\'POST\',';

									$code[] = '			dataType:\'json\',';

									$code[] = '			data:$("#payment-form-custom").serialize(),';

									$code[] = '			beforeSend:function(){';

									$code[] = '				$this.find(\'.btn-submit\').btn("loading");';

									$code[] = '			},';

									$code[] = '			complete:function(){';

									$code[] = '				$this.find(\'.btn-submit\').btn("reset");';

									$code[] = '			},';

									$code[] = '			success:function(json){';

									$code[] = '				$container = $this;';

									$code[] = '				$container.find(".is-invalid").removeClass("is-invalid");';

									$code[] = '				$container.find("span.invalid-feedback").remove();';

									$code[] = '				if(json[\'errors\']){';

									$code[] = '				    $.each(json[\'errors\'], function(i,j){';

									$code[] = '				        $ele = $container.find(\'[name="\'+ i +\'"]\');';

									$code[] = '				        if($ele){';

									$code[] = '				            $ele.addClass("is-invalid");';

									$code[] = '				            if($ele.parent(".input-group").length){';

									$code[] = '				                $ele.parent(".input-group").after("<span class=\'invalid-feedback\'>"+ j +"</span>");';

									$code[] = '				            } else{';

									$code[] = '				                $ele.after("<span class=\'invalid-feedback\'>"+ j +"</span>");';

									$code[] = '				            }';

									$code[] = '				        }';

									$code[] = '				    })';

									$code[] = '				}';

									$code[] = '			},';

									$code[] = '		})';

									$code[] = '		return false;';

									$code[] = '	})';

									$code[] = '</script>';

									echo ___h($code,'php');

								?>

	    					</div>

		    			</div>



		    			<div class="card">

		    				<div class="card-header"><h2 class="mb-0">#4 confirm_view folder</h2></div>

	    					<div class="card-body">

	    						In this folder contain custom.php file. custom.php file use for setting of admin. this view show on affiliate side. on buy plan detail page. you can start your payment proccess from here. this file is not required

	    					</div>

		    			</div>



		    			<div class="card">

		    				<div class="card-header"><h2 class="mb-0">#5 logo folder</h2></div>

	    					<div class="card-body">

	    						In this folder contain custom.png file. you can add your payment gateway logo

	    					</div>

		    			</div>



		    			<div class="card">

		    				<div class="card-header"><h2 class="mb-0">Model Functions (MembershipPlan)</h2></div>

	    					<div class="card-body">

	    						<code>buy($user, $order_status_id, $comment, 'Paypal', 1, $payment_details)</code>

	    						<p>You can add buy history using this function in payment_details you need to pass following</p>

	    						<ul>
									
									<li>transaction_id</li>
									
									<li>payment_status</li>

	    						</ul>


	    					</div>

		    			</div>



		    			<div class="card">

		    				<div class="card-header"><h2 class="mb-0">Status ID and Titles</h2></div>

	    					<div class="card-body">

	    						<table class="table-striped table table-sm">

									<tr><th width="90px">Status ID</th><th>Title</th></tr>

									<tr><td>0</td><td>Received</td></tr>

							        <tr><td>1</td><td>Complete</td></tr>

							        <tr><td>2</td><td>Total not match</td></tr>

							        <tr><td>3</td><td>Denied</td></tr>

							        <tr><td>4</td><td>Expired</td></tr>

							        <tr><td>5</td><td>Failed</td></tr>

							        <tr><td>7</td><td>Processed</td></tr>

							        <tr><td>8</td><td>Refunded</td></tr>

							        <tr><td>9</td><td>Reversed</td></tr>

							        <tr><td>10</td><td>Voided</td></tr>

							        <tr><td>11</td><td>Canceled Reversal</td></tr>

							        <tr><td>12</td><td>Waiting For Payment</td></tr>

							        <tr><td>13</td><td>Pending</td></tr>

								</table>

	    					</div>

		    			</div>



		    			<div class="card">

		    				<div class="card-header"><h2 class="mb-0">How to create zip file of module</h2></div>

	    					<div class="card-body">

	    						in zip file contain root folder as  "upload" in side upload folder all folder of modules file like this



	    						<br>

	    						<ul>

	    							<li>/upload/admin_settings/</li>

	    							<li>/upload/confirm_view/</li>

	    							<li>/upload/controllers/</li>

	    							<li>/upload/logo/</li>

	    							<li>/upload/user_settings/</li>

	    						</ul>

	    					</div>

		    			</div>

		    		</div>

		    	</div>

			</div>

	    </div>

	</div>



</div>	