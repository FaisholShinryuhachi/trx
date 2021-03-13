<?php include(APPPATH.'/views/usercontrol/login/multiple_pages/header.php'); ?>

<?php 
$terms_content = $theme_settings[0]->terms_content;
$terms_img = $theme_settings[0]->terms_img;
?>

<?php 
if ($terms_img != '' || !empty($terms_img)) { 
    $image_link =  base_url().'assets/images/theme_images/'.$terms_img;
}else{ 
    $image_link =  base_url('assets/login/multiple_pages/img/term-bg.png');
} 
?>

    <a href="<?= base_url('/'); ?>" class="btn-orage back-to-home">Back to Homepage</a>
	<div class="login-hero-area terms-area d-flex align-items-center" style="background: url('<?php echo  $image_link;?>') no-repeat scroll center center /   cover;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
					<div class="terms-content text-center" id="scrollbar">
                        <p><?= (!empty($terms_content)) ? $terms_content : "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";?></p>						
					</div>
                </div>
            </div>
        </div>
    </div>

<?php include(APPPATH.'/views/usercontrol/login/multiple_pages/footer.php'); ?>
