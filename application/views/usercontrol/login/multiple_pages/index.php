<?php include(APPPATH.'/views/usercontrol/login/multiple_pages/header.php'); ?>
    
    <?php
    if(!empty($theme_sliders)):
    for ($i=0; $i < sizeof($theme_sliders); $i++) { 
        if($theme_sliders[$i]->status == 1){
            $heroData = $theme_sliders[$i];
            break;
        }
    }
    endif;

    $heroImage = (isset($heroData) && !empty($heroData->image)) ? base_url('assets/images/theme_images/'.$heroData->image) : base_url('assets/login/multiple_pages/img/hero-bg.jpg');
    ?>

    <!--Hero-->
    <div class="wlc-hero-area d-flex align-items-center" style="background: url(<?= $heroImage ?>) no-repeat scroll center center / cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="wlc-hero-content">
                        <h1 class="display-3"><?= (isset($heroData) && !empty($heroData->title)) ? $heroData->title : "Lorem Ipsum <br>is Simply Dummy" ?></h1>
                        <p><?= (isset($heroData) && !empty($heroData->description)) ? $heroData->description : "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."; ?></p>
                        <a href="<?= (isset($heroData) && !empty($heroData->link)) ? $heroData->link : base_url('register'); ?>" target="_blank" class="btn-orage"><?= (isset($heroData) && !empty($heroData->button_text)) ? $heroData->button_text : "Join As Affiliate"; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Hero-->

    <?php 
        foreach ($theme_settings as $settings) { 
            $top_banner_slider = json_decode($settings->top_banner_slider);
        } 
    ?>
    <!--News Ticker-->
    <div class="news-ticker-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="news-ticker-slider owl-carousel">
                    <?php
                    $noRunners = true;
                    foreach($top_banner_slider as $runner){
                        if(!empty($runner)) {
                            $noRunners = false;
                        ?>
                        <!--Single News Ticker-->
                        <div class="single-news-ticker">
                            <div class="news-ticker-inner text-center">
                                <p><?= $runner; ?></p>
                            </div>
                        </div>
                        <!--Single News Ticker-->
                        <?php
                        }
                    }
                    if ($noRunners == true){
                    ?>
                    <!--Single News Ticker-->
                    <div class="single-news-ticker">
                        <div class="news-ticker-inner text-center">
                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled</p>
                        </div>
                    </div>
                    <!--Single News Ticker-->
                    <?php
                    }
                    ?>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <!--News Ticker-->

    
    <?php
        foreach($home_sections_settings as $hsSetting) {
            if($hsSetting->sec_is_enable){
                switch ($hsSetting->sec_title) {
                    case 'Membership Section':
                        ?>
                            <?php
                                $db =& get_instance();
                                $membership = $db->Product_model->getSettings('membership');
                                if($membership['status']) { 
                                ?>
                                <!-- Affiliate Plan-->
                                <div class="affiliate-plan-area">
                                    <?php if($this->session->flashdata('error')){?>
                                    <div class="col-sm-12 m-t-10 text-center">
                                        <div class="alert alert-warning"> <?php echo $this->session->flashdata('error'); ?> </div>
                                    </div>
                                    <?php } ?>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="section-title text-center">
                                                    <img src="<?= base_url('assets/login/multiple_pages') ?>/img/icon.png" alt="">
                                                    <?php foreach($theme_settings as $settings) { $membershipTitles = $settings; } ?>
                                                    <h2><?= (isset($membershipTitles) && !empty($membershipTitles->membership_top_title)) ? $membershipTitles->membership_top_title : "Best Affiliate Plan"; ?></h2>
                                                    <p><?= (isset($membershipTitles) && !empty($membershipTitles->membership_sub_title)) ? $membershipTitles->membership_sub_title : "Lorem Ipsum is simply dummy text of the printing and typesetting industry."; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                        <?php 
                                        $plans = App\MembershipPlan::where('status',1)->get()->toArray();
                                        foreach ($plans as $plan) { 
                                            $plansAvailable = true;
                                        ?>
                                            <div class="col-lg-4">
                                                <div class="single-price-table basic-saturn">
                                                    <?php 
                                                    if($plan['special']) {
                                                        $percentage = round((($plan['price'] - $plan['special']) * 100) / $plan['price']);
                                                        ?><div class="price-discount" style="background: <?= $plan['label_background'] ?>;color: <?= $plan['label_color'] ?>;">SAVE <?= $percentage ?>%</div><?php
                                                    } 
                                                    ?>
                                                    <div class="header-plan text-center">
                                                        <h4 style="color: <?= $plan['label_background'] ?>;"><?= $plan['name'] ?></h4>
                                                        <img src="<?= base_url('assets/login/multiple_pages') ?>/img/saturn.png" alt="saturn">
                                                    </div>
                                                    <div class="price text-center">
                                                    <h2 style="color: <?= $plan['label_background'] ?>;">
                                                    <?php  if($plan['price'] == 0){ ?> FREE <?php } else { ?>
                                                    <?php if($plan['special']) { ?> <?= c_format($plan['special'],true,0) ?> <?php }else{ ?>
                                                    <?= c_format($plan['price'],true,0) ?> <?php } ?> <?php } ?>
                                                    </h2>
                                                        <span><?php if($plan['special']){ ?> <del><?= c_format($plan['price'],true,0) ?></del> <?php }?> <span>/ <?= ($plan['billing_period'] == "lifetime_free") ? "Lifetime" : ucwords(strtolower($plan['billing_period'])); ?></span></span>
                                                    </div>

                                                    <?php if($plan['bonus']) { ?>
                                                        <h5 class="text-center" style="color: <?= $plan['label_background'] ?>; border-bottom: 1px solid #F1F1F1;">Bonus Rate <?= c_format($plan['bonus'],true,0) ?></h5>
                                                    <?php } ?>

                                                    <div class="price-content text-center">
                                                        <?php
                                                                if(!empty($plan['description'])) {
                                                                    echo $plan['description'];
                                                                } else {
                                                                    echo '<ul>
                                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                                        </ul>';
                                                                }
                                                        ?>
                                                    </div>
                                                    <div class="price-footer text-center">
                                                        <a href="<?= base_url('/register') ?>" style="background: <?= $plan['label_background'] ?>;color: <?= $plan['label_color'] ?>;"><?= $plan['label_text']?></a>
                                                    </div>
                                                </div>
                                            </div>   
                                        <?php
                                        }

                                        if(!isset($plansAvailable)) {
                                        ?>

                                            <div class="col-lg-4">
                                                <div class="single-price-table basic-saturn">
                                                    <div class="price-discount">SAVE 90%</div>
                                                    <div class="header-plan text-center">
                                                        <h4>30 DAYS</h4>
                                                        <img src="<?= base_url('assets/login/multiple_pages') ?>/img/saturn.png" alt="saturn">
                                                    </div>
                                                    <div class="price text-center">
                                                        <h2>$1</h2>
                                                        <span><del>$10</del> <span>/Per Monthly</span></span>
                                                    </div>
                                                    <div class="price-content">
                                                        <ul>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                        </ul>
                                                    </div>
                                                    <div class="price-footer text-center">
                                                        <a href="">Lorem Ipsum</a>
                                                    </div>
                                                </div>
                                            </div>                
                                            
                                            <div class="col-lg-4">
                                                <div class="single-price-table popular-uranus">
                                                    <div class="price-discount"><i class="fa fa-star"></i> <span>SAVE 90%</span></div>
                                                    <div class="header-plan text-center">
                                                        <h4>30 DAYS</h4>
                                                        <img src="<?= base_url('assets/login/multiple_pages') ?>/img/uranus.png" alt="uranus">
                                                    </div>
                                                    <div class="price text-center">
                                                        <h2>$1</h2>
                                                        <span><del>$10</del> <span>/Per Monthly</span></span>
                                                    </div>
                                                    <div class="price-content">
                                                        <ul>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                        </ul>
                                                    </div>
                                                    <div class="price-footer text-center">
                                                        <a href="">Lorem Ipsum</a>
                                                    </div>
                                                </div>
                                            </div>                
                                            
                                            <div class="col-lg-4">
                                                <div class="single-price-table business-asteroid">
                                                    <div class="price-discount">SAVE 90%</div>
                                                    <div class="header-plan text-center">
                                                        <h4>30 DAYS</h4>
                                                        <img src="<?= base_url('assets/login/multiple_pages') ?>/img/asteroid.png" alt="asteroid">
                                                    </div>
                                                    <div class="price text-center">
                                                        <h2>$1</h2>
                                                        <span><del>$10</del> <span>/Per Monthly</span></span>
                                                    </div>
                                                    <div class="price-content">
                                                        <ul>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                            <li>Lorem Ipsum is simply dummy text</li>
                                                        </ul>
                                                    </div>
                                                    <div class="price-footer text-center">
                                                        <a href="">Lorem Ipsum</a>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>             

                                        </div>
                                    </div>
                                </div><!-- Affiliate Plan-->
                                <?php
                                }
                            ?>
                        <?php
                        break;
                    case 'Home Content':
                        ?>
                            <!--Featured Area-->
                            <div class="featured-area gray-bg">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="featured-slider owl-carousel">
                                            <?php
                                            foreach($theme_homecontent as $homecontent){
                                            if ($homecontent->status == 1) {
                                                $homeContentAvailable = true;
                                            ?>

                                            <!--single slider item-->
                                                <div class="single-featured">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6">
                                                            <div class="featured-content">
                                                                <h2><?= $homecontent->title; ?></h2>
                                                                <p><?= $homecontent->description ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 offset-lg-1">
                                                            <div class="featured-image">
                                                                <?php
                                                                $image_url = (!empty($homecontent->image)) ? base_url('assets/images/theme_images/'.$homecontent->image) : base_url('assets/login/multiple_pages/img/featured-img.png');
                                                                ?>
                                                                <img src="<?= $image_url; ?>" alt="Login Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--single slider item-->
                                                <?php 
                                                }
                                            }

                                                if(!isset($homeContentAvailable)) {
                                                ?>
                                                
                                                <!--single slider item-->
                                                <div class="single-featured">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6">
                                                            <div class="featured-content">
                                                                <h2>What is Lorem Ipsum?</h2>
                                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                                                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 offset-lg-1">
                                                            <div class="featured-image">
                                                                <img src="<?= base_url('assets/login/multiple_pages') ?>/img/featured-img.png" alt="Featured Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--single slider item-->
                                                
                                                <!--single slider item-->
                                                <div class="single-featured">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6">
                                                            <div class="featured-content">
                                                                <h2>What is Lorem Ipsum?</h2>
                                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                                                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 offset-lg-1">
                                                            <div class="featured-image">
                                                                <img src="<?= base_url('assets/login/multiple_pages') ?>/img/featured-img.png" alt="Featured Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--single slider item-->
                                                
                                                <!--single slider item-->
                                                <div class="single-featured">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6">
                                                            <div class="featured-content">
                                                                <h2>What is Lorem Ipsum?</h2>
                                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                                                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 offset-lg-1">
                                                            <div class="featured-image">
                                                                <img src="<?= base_url('assets/login/multiple_pages') ?>/img/featured-img.png" alt="Featured Image" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--single slider item-->

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!--Featured Area-->
                        <?php
                    break;
                    case 'Home Section':
                        ?>
                            <!--Our Blog Area-->
                            <div class="our-blog-area">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="section-title text-center">
                                                <img src="<?= base_url('assets/login/multiple_pages') ?>/img/icon.png" alt="">
                                                <?php foreach($theme_settings as $settings) { $homeSecTitles = $settings; } ?>
                                                <h2><?= (isset($homeSecTitles) && !empty($homeSecTitles->home_section_title)) ? $homeSecTitles->home_section_title : "<h2>What is Lorem IpsumS?</h2>"; ?></h2>
                                                <p><?= (isset($homeSecTitles) && !empty($homeSecTitles->home_section_subtitle)) ? $homeSecTitles->home_section_subtitle : "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>"; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-center">
                                    <?php
                                    $i=0;
                                    foreach($theme_sections as $section) {
                                        if ($section->status == 1) {
                                        $isSectionsAvailanle = true;
                                        $image_url = (!empty($section->image)) ? base_url('assets/images/theme_images/'.$section->image) : base_url('assets/login/multiple_pages/img/blog-image'.($i+1).'.jpg');
                                        echo '<div class="col-lg-4 mt-5">
                                            <div class="single-blog">
                                                <img src="'.$image_url .'" alt="'.$section->title .'" class="img-fluid">
                                                <h3>'.$section->title .'</h3>
                                                <p>'.$section->description .'</p>
                                                <a href="'.$section->link .'" target="_blank" >'.$section->button_text .'</a>
                                            </div>
                                        </div>';
                                        $i++;
                                        }
                                    }
                                    ?>
                                    <?php
                                    if(!isset($isSectionsAvailanle)) {
                                    ?>
                        
                                        <div class="col-lg-4">
                                            <div class="single-blog">
                                                <img src="<?= base_url('assets/login/multiple_pages') ?>/img/blog-image.jpg" alt="Blog" class="img-fluid">
                                                <h3>Section 1</h3>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                <a href="">Lorem Ipsum</a>
                                            </div>
                                        </div>                
                                        
                                        <div class="col-lg-4">
                                            <div class="single-blog">
                                                <img src="<?= base_url('assets/login/multiple_pages') ?>/img/blog-image-2.jpg" alt="Blog" class="img-fluid">
                                                <h3>Section 2</h3>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                <a href="">Lorem Ipsum</a>
                                            </div>
                                        </div>                
                                        
                                        <div class="col-lg-4">
                                            <div class="single-blog">
                                                <img src="<?= base_url('assets/login/multiple_pages') ?>/img/blog-image-3.jpg" alt="Blog" class="img-fluid">
                                                <h3>Section 3</h3>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                <a href="">Lorem Ipsum</a>
                                            </div>
                                        </div>
                                    
                                    <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <!--Our Blog Area-->
                        <?php
                    break;
                    case 'Video Section':
                        ?>

                        <?php
                        
                        foreach($theme_settings as $settings) { $video_section = $settings; }
                        $video_bg = (isset($video_section) && !empty($video_section->homepage_video_section_bg)) ? base_url('assets/images/theme_images/'.$video_section->homepage_video_section_bg) : base_url('assets/login/multiple_pages/img/video-section-bg.png');

                        ?>
                            <!--Video Area-->
                            <div class="our-video-area d-flex align-items-center" style="background: url(<?= $video_bg; ?>) no-repeat scroll center center / cover;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6 offset-lg-6">
                                            <div class="our-video-wrapper">
                                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <?php 
                                                        $i = 0;
                                                        foreach ($theme_videos as $video) {
                                                            if($video->status == 1){
                                                        ?>
                                                        <div class="carousel-item <?= ($i==0)?"active":""; ?>">
                                                            <div class="our-video-header text-center">
                                                                <h2><?php echo ($video->video_title != "") ? $video->video_title : "Watch Our Videos"; ?></h2>
                                                                <?php echo ($video->video_sub_title != "") ? "<p>".$video->video_sub_title."</p>" : ""; ?>
                                                            </div>
                                                            <div class="our-video-slider">
                                                                <div class="single-video-slider">
                                                                    <div class="video-inner">

                                                                        <?php 
                                                                        if (strpos($video->video_link,'embed') !== false) {
                                                                            ?>
                                                                                <iframe width="100%" height="100%" src="<?=$video->video_link ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                            <?php
                                                                        } else {

                                                                            if(strpos(strtolower($video->video_link),'youtube') !== false){
                                                                                $id = explode("v=",$video->video_link);
                                                                                ?>
                                                                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?=$id[1] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                                <?php
                                                                            } else if(strpos(strtolower($video->video_link),'youtu') !== false) {
                                                                                $id = explode("/",$video->video_link);
                                                                                ?>
                                                                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?=$id[3] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                                <?php
                                                                            }

                                                                            ?>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $i++;
                                                            } 
                                                        } 
                                                        if($i == 0){
                                                        ?>
                                                        <div class="carousel-item active">
                                                            <div class="our-video-slider">
                                                                <div class="our-video-header text-center">
                                                                    <h2>Watch Our Videos</h2>
                                                                    <p>Subtitle goes here</p>
                                                                </div>
                                                                <div class="single-video-slider">
                                                                    <div class="video-inner">
                                                                        <img class="img-fluid video-thumb" src="<?= base_url('assets/login/multiple_pages') ?>/img/video-bg.jpg" alt="Video">
                                                                        <a href="#">play</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                        <i class="fa fa-angle-left"></i>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                    <i class="fa fa-angle-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Video Area-->
                        <?php
                    break;
                    case 'Recommendation Section':
                        ?>
                            <!--Client Testimonial Area-->
                            <div class="testimonial-area">
                                <div class="container mb-5">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="section-title text-center">
                                                <img src="<?= base_url('assets/login/multiple_pages') ?>/img/icon.png" alt="client">
                                                <?php foreach($theme_settings as $settings) { $recommendation_section = $settings; } ?>
                                                <h2><?= (isset($recommendation_section) && !empty($recommendation_section->recommendation_section_title)) ? $recommendation_section->recommendation_section_title : "What is Lorem IpsumS?" ?></h2>
                                                <p><?= (isset($recommendation_section) && !empty($recommendation_section->recommendation_section_subtitle)) ? $recommendation_section->recommendation_section_subtitle : "Lorem Ipsum is simply dummy text of the printing and typesetting industry." ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial-slider owl-carousel">
                                <?php 
                                foreach($theme_recommendation as $recommendation):
                                if ($recommendation->status==1) { 
                                $isRecommendationAvailable = true;
                                $image_url = (!empty($recommendation->image)) ? base_url('assets/images/theme_images/'.$recommendation->image) : base_url('assets/login/multiple_pages/img/client-1.png');
                                ?>
                                <!--single testimonial item-->
                                    <div class="single-testimonial">
                                        <div class="testimonial-inner">
                                            <div class="testmonial-header text-center">
                                                <div class="author-image">
                                                    <img class="profile" class="profile" src="<?= $image_url ?>" alt="<?= $recommendation->title ?>" height="200    ">
                                                </div>
                                                <h3><?= $recommendation->title ?></h3>
                                                <span class="designation"><?= $recommendation->occupation ?></span>
                                            </div>
                                            <div class="testmonial-content text-center">
                                                <p><?= $recommendation->description ?></p>
                                            </div>
                                        </div>
                                    </div><!--single testimonial item--> 
                                <?php } ?>          
                                <?php endforeach; ?>

                                <?php
                                    if(!isset($isRecommendationAvailable)) {
                                    ?>
                        
                                        <!--single testimonial item-->
                                        <div class="single-testimonial">
                                            <div class="testimonial-inner">
                                                <div class="testmonial-header text-center">
                                                    <div class="author-image">
                                                        <img class="profile" src="<?= base_url('assets/login/multiple_pages') ?>/img/client-1.png" alt="client">
                                                    </div>
                                                    <h3>Metehan</h3>
                                                    <span class="designation">Designer</span>
                                                </div>
                                                <div class="testmonial-content text-center">
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                            </div>
                                        </div><!--single testimonial item-->           
                                        
                                        <!--single testimonial item-->
                                        <div class="single-testimonial">
                                            <div class="testimonial-inner">
                                                <div class="testmonial-header text-center">
                                                    <div class="author-image">
                                                        <img class="profile" src="<?= base_url('assets/login/multiple_pages') ?>/img/client-2.png" alt="client">
                                                    </div>
                                                    <h3>Metehan</h3>
                                                    <span class="designation">Designer</span>
                                                </div>
                                                <div class="testmonial-content text-center">
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                            </div>
                                        </div><!--single testimonial item-->            
                                        
                                        <!--single testimonial item-->
                                        <div class="single-testimonial">
                                            <div class="testimonial-inner">
                                                <div class="testmonial-header text-center">
                                                    <div class="author-image">
                                                        <img class="profile" src="<?= base_url('assets/login/multiple_pages') ?>/img/client-2.png" alt="client">
                                                    </div>
                                                    <h3>Metehan</h3>
                                                    <span class="designation">Designer</span>
                                                </div>
                                                <div class="testmonial-content text-center">
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                            </div>
                                        </div><!--single testimonial item-->            
                                        
                                        <!--single testimonial item-->
                                        <div class="single-testimonial">
                                            <div class="testimonial-inner">
                                                <div class="testmonial-header text-center">
                                                    <div class="author-image">
                                                        <img class="profile" src="<?= base_url('assets/login/multiple_pages') ?>/img/client-3.png" alt="client">
                                                    </div>
                                                    <h3>Metehan</h3>
                                                    <span class="designation">Designer</span>
                                                </div>
                                                <div class="testmonial-content text-center">
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                            </div>
                                        </div><!--single testimonial item-->           
                                        
                                        <!--single testimonial item-->
                                        <div class="single-testimonial">
                                            <div class="testimonial-inner">
                                                <div class="testmonial-header text-center">
                                                    <div class="author-image">
                                                        <img class="profile" src="<?= base_url('assets/login/multiple_pages') ?>/img/client-3.png" alt="client">
                                                    </div>
                                                    <h3>Metehan</h3>
                                                    <span class="designation">Designer</span>
                                                </div>
                                                <div class="testmonial-content text-center">
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                            </div>
                                        </div><!--single testimonial item-->
                                        
                                        <!--single testimonial item-->
                                        <div class="single-testimonial">
                                            <div class="testimonial-inner">
                                                <div class="testmonial-header text-center">
                                                    <div class="author-image">
                                                        <img class="profile" src="<?= base_url('assets/login/multiple_pages') ?>/img/client-3.png" alt="client">
                                                    </div>
                                                    <h3>Metehan</h3>
                                                    <span class="designation">Designer</span>
                                                </div>
                                                <div class="testmonial-content text-center">
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                </div>
                                            </div>
                                        </div><!--single testimonial item-->
                                        
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div><!--Client Testimonial Area-->
                        <?php
                    break;
                }
            }
        }          
    ?>


<?php include(APPPATH.'/views/usercontrol/login/multiple_pages/footer.php'); ?>