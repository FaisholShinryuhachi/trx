<?php if($userdetails['reg_approved'] == 0) { ?>

<div class="container-fluid pt-4">
	<div class="alert bg-info text-white" role="alert">
	  Account approval is pending yet!
	</div>

	<div class="jumbotron">
	  <h1 class="display-4 mb-4">Hello, <?= $this->session->userdata['user']['firstname']; ?> <?= $this->session->userdata['user']['lastname']; ?>!</h1>
	  <p class="lead">Thank you for registering with us. your request is received and we will respond you soon!</p>
	  <p class="lead">If have any queries please contact us <a href="<?php echo base_url('usercontrol/contact-us');?>">here</a>.</p>
	</div>
</div>

<?php } else if($userdetails['reg_approved'] == 2) { ?>

<div class="container-fluid pt-4">
	<div class="alert bg-danger text-white" role="alert">
	  Your new user registration request is declined by admin!
	</div>

	<div class="jumbotron">
	  <h1 class="display-4 mb-4">Hello, <?= $this->session->userdata['user']['firstname']; ?> <?= $this->session->userdata['user']['lastname']; ?>!</h1>
	  <p class="lead">Your request has been declined by admin! If have any queries please contact us <a href="<?php echo base_url('usercontrol/contact-us');?>">here</a>.</p>
	</div>
</div>

<?php 
} else {
	header("Location: ".base_url('usercontrol/dashboard')); 
	die;
}
?>