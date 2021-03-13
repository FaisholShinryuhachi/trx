<div class="form-group">
	<label class="form-control-label">Enter Your Bank Details</label>
	<textarea class="form-control" name="bank_details" rows="8"></textarea>
</div>


<script type="text/javascript">
	$("#payment-form-bank_transfer").submit(function(){
		$this = $(this);
		$.ajax({
			url:'<?= base_url('payment/call_payment_function/bank_transfer/saveUserSubmit') ?>',
			type:'POST',
			dataType:'json',
			data:$("#payment-form-bank_transfer").serialize(),
			beforeSend:function(){
				$this.find('.btn-submit').btn("loading");
			},
			complete:function(){
				$this.find('.btn-submit').btn("reset");
			},
			success:function(json){
				$container = $this;
				$container.find(".is-invalid").removeClass("is-invalid");
				$container.find("span.invalid-feedback").remove();

				if (json['success']) {
					$("#withdrawal-payments").modal("hide");

					Swal.fire({
						title: 'Success',
						text: "Withdrwal Request Send Successfully..!",
						icon: 'success',
					}).then((result) => {
						window.location.reload();
					})
				}
				
				if(json['errors']){
				    $.each(json['errors'], function(i,j){
				        $ele = $container.find('[name="'+ i +'"]');
				        if($ele){
				            $ele.addClass("is-invalid");
				            if($ele.parent(".input-group").length){
				                $ele.parent(".input-group").after("<span class='invalid-feedback'>"+ j +"</span>");
				            } else{
				                $ele.after("<span class='invalid-feedback'>"+ j +"</span>");
				            }
				        }
				    })
				}
			},
		})
		return false;
	})
</script>