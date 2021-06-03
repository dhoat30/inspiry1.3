<?php 
get_header(); 

?>

<section class="home-page">
    <div class="slider-container">


        <div class="slider">
           


            <?php 

                                        $args = array(
                                            'post_type' => 'sliders',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'slider-category',
                                                    'field'    => 'slug',
                                                    'terms'    => array( 'home-page-hero-slider'),
                                                )
                                                ), 
                                                'orderby' => 'date', 
                                                'order' => 'ASC'
                                        );
                                        $query = new WP_Query( $args );

                                        while($query->have_posts()){ 
                                            $query->the_post(); 
                                            $image = get_field('mobile_image'); 
                                            $imgUrl; 
                                            if($image['sizes']['medium_large']){
                                                $imgUrl = $image['sizes']['medium_large'];
                                            }
                                            else{
                                                $imgUrl = $image['url'];
                                            }
                                          
                                            ?>
                                            <div class="slide">
                                                <a  href="<?php echo  get_field('add_link'); ?>">
                                            <picture > 
                                                    <source media="(min-width:700px)" srcset="<?php echo get_the_post_thumbnail_url(null,"full"); ?>">
                                                    <source media="(min-width:465px)" srcset="<?php echo get_the_post_thumbnail_url(null,"large"); ?>">
                                                    <img   src="<?php echo esc_url($imgUrl);?>" alt="<?php echo get_the_title();?>">
                                                </picture>   

                                                    </a>   
                                                     </div>
                                                           
                                            <?php

                                       
                                        }
                                        wp_reset_postdata();

                                        ?>



        </div>


        <div class="buttons">
            <button id="prev"><i class="fas fa-arrow-left"></i></button>
            <button id="next"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</section>

<!--Trending section  ----->

<section class="trending-section  margin-row row-container">
    
    <div class="title-container flex-row flex-start align-end">
        <h1 class="section-font-size">Trending Now</h1>  
        <h2 class="roboto-font medium-font-size thin">What we’re covering most this season</h2>                                
    </div>                                   
    
    <div class="flex flex-row owl-carousel">

        <?php 

            $argsLoving = array(
                'post_type' => 'homepage-cards',
                'posts_per_page'=> 0,
                    'orderby' => 'date', 
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'home-page-card-category',
                            'field'    => 'slug',
                            'terms'    => array( 'trending-now-home-page'),
                        )
                        ), 
            );
            $loving = new WP_Query( $argsLoving );

            while($loving->have_posts()){ 
                $loving->the_post(); 

                ?>
        
            <a class="cards rm-txt-dec"  href="<?php echo get_field('category_link');?>">
            
         
                    <img loading="lazy" src="<?php echo get_the_post_thumbnail_url(null,"medium"); ?>"
                            alt="Khroma">
                    <div class="paragraph-font-size margin-top"  id="trending-now" ><?php echo get_the_title();?> </div>
              
            </a>
    
        <?php 

            }
            wp_reset_postdata();
            ?>




    </div>
</section>

<!--third section  ----->

<section class="third-section  margin-large-row ">
    
   
    <div class="image-container">

        <?php 

                $args = array(
                    'post_type' => 'sliders',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'slider-category',
                            'field'    => 'slug',
                            'terms'    => array( 'third-section-home-page'),
                        )
                        )
                );
                $query = new WP_Query( $args );

                while($query->have_posts()){ 
                    $query->the_post(); 
                    $image = get_field('mobile_image'); 
                                            $imgUrl; 
                                            if($image['sizes']['medium_large']){
                                                $imgUrl = $image['sizes']['medium_large'];
                                            }
                                            else{
                                                $imgUrl = $image['url'];
                                            }
                ?>
        
                <a  href="<?php echo  get_field('add_link'); ?>">                         
                    <picture>
                            <source media="(min-width:1366px)" srcset="<?php echo get_the_post_thumbnail_url(null,"full"); ?>">
                            <source media="(min-width:600px)" srcset="<?php echo get_the_post_thumbnail_url(null,"large"); ?>">
                            <img loading="lazy" src="<?php echo esc_url($imgUrl);?>"
                            alt="<?php echo get_the_title();?>">
              
                    </picture>
                </a>
        <?php 

            }
            wp_reset_postdata();
            ?>




    </div>
</section>

<!--fourth section  ----->

<section class="fourth-section  margin-row row-container">
    <div class="image-container flex-row flex-center">
        <?php 

                $args = array(
                    'post_type' => 'sliders',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'slider-category',
                            'field'    => 'slug',
                            'terms'    => array( 'fourth-section-home-page'),
                        )
                        )
                );
                $query = new WP_Query( $args );

                while($query->have_posts()){ 
                    $query->the_post(); 
                  
                ?>
        
                <a  href="<?php echo  get_field('add_link'); ?>">                         
                    <picture>
                            <source media="(min-width:1366px)" srcset="<?php echo get_the_post_thumbnail_url(null,"large"); ?>">
                            <source media="(min-width:600px)" srcset="<?php echo get_the_post_thumbnail_url(null,"large"); ?>">
                            <img loading="lazy" src="<?php echo get_the_post_thumbnail_url(null,"woocommerce_thumbnail"); ?>"
                            alt="<?php echo get_the_title();?>">
              
                    </picture>
                </a>
        <?php 

            }
            wp_reset_postdata();
            ?>




    </div>
</section>

<!--fifth section with third section styling ----->

<section class="third-section  margin-large-row">
    
   
    <div class="image-container">

        <?php 

                $args = array(
                    'post_type' => 'sliders',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'slider-category',
                            'field'    => 'slug',
                            'terms'    => array( 'fifth-section-home-page'),
                        )
                        )
                );
                $query = new WP_Query( $args );

                while($query->have_posts()){ 
                    $query->the_post(); 
                    $image = get_field('mobile_image'); 
                                            $imgUrl; 
                                            if($image['sizes']['medium_large']){
                                                $imgUrl = $image['sizes']['woocommerce_thumbnail'];
                                            }
                                            else{
                                                $imgUrl = $image['url'];
                                            }
                ?>
        
                <a  href="<?php echo  get_field('add_link'); ?>">                         
                    <picture>
                            <source media="(min-width:1366px)" srcset="<?php echo get_the_post_thumbnail_url(null,"full"); ?>">
                            <source media="(min-width:600px)" srcset="<?php echo get_the_post_thumbnail_url(null,"large"); ?>">
                            <img loading="lazy" src="<?php echo esc_url($imgUrl);?>"
                            alt="<?php echo get_the_title();?>">
              
                    </picture>
                </a>
        <?php 

            }
            wp_reset_postdata();
            ?>




    </div>
</section>


<!--sixth section with three photos ----->

<section class="sixth-section margin-large-row">
    <div class="sixth-container row-container">

        <?php 

                $args = array(
                    'post_type' => 'tri-images',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'tri-Images-category',
                            'field'    => 'slug',
                            'terms'    => array( 'sixth-section-home-page')
                        )
                        )
                );
                $query = new WP_Query( $args );

                while($query->have_posts()){ 
                    $query->the_post(); 
                    $largeImage = get_field('large_image'); 
                    $firstImage = get_field('first_small_image'); 
                    $secondImage = get_field('second_small_image'); 

                   
                ?>
        
                <div class="images-container flex-row flex-space-between">
                    <div class="first-image">
                        <a  href="<?php echo  get_field('large_image_link'); ?>">                         
                            <picture>
                                    <source media="(min-width:1366px)" srcset="<?php echo $largeImage['sizes']['full']; ?>">
                                    <source media="(min-width:600px)" srcset="<?php echo $largeImage['sizes']['large'];?>">
                                    <img loading="lazy" src="<?php echo $largeImage['sizes']['woocommerce_thumbnail'];?>"
                                    alt="<?php echo get_the_title();?>">
                    
                            </picture>
                        </a>
                    </div>
                   
                    <div class="second-image small-image">
                            <picture>
                                        <source media="(min-width:1366px)" srcset="<?php echo $firstImage['sizes']['full']; ?>">
                                        <source media="(min-width:600px)" srcset="<?php echo $firstImage['sizes']['large'];?>">
                                        <img loading="lazy" src="<?php echo $firstImage['sizes']['woocommerce_thumbnail'];?>"
                                        alt="<?php echo get_field('first_image_title');?>">
                    
                            </picture>
                            <a class="anchor-overlay rm-txt-dec center-align" href="<?php echo  get_field('first_small_image_link'); ?>"><?php echo get_field('first_image_title'); ?></a>
                    </div>
                    <div class="third-image small-image">
                            <picture>
                                        <source media="(min-width:1366px)" srcset="<?php echo $secondImage['sizes']['full']; ?>">
                                        <source media="(min-width:600px)" srcset="<?php echo $secondImage['sizes']['large'];?>">
                                        <img loading="lazy" src="<?php echo $secondImage['sizes']['woocommerce_thumbnail'];?>"
                                        alt="<?php echo get_field('second_image_title');?>">
                    
                            </picture>
                            <a class="anchor-overlay rm-txt-dec center-align" href="<?php echo  get_field('second_small_image_link'); ?>"><?php echo get_field('second_image_title'); ?></a>
                    </div>
                    
                </div>
                <div class="title-container flex-row align-end">
                    <h6 class="column-font-size regular"><?php echo get_the_title();?></h6>
                    <p><?php echo get_the_content();?></p>
                </div>
        <?php 

            }
            wp_reset_postdata();
            ?>




    </div>
</section>

<!--seventh section with third section styling ----->

<section class="third-section  margin-large-row">
    
   
    <div class="image-container">

        <?php 

                $args = array(
                    'post_type' => 'sliders',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'slider-category',
                            'field'    => 'slug',
                            'terms'    => array( 'seventh-section-home-page'),
                        )
                        )
                );
                $query = new WP_Query( $args );

                while($query->have_posts()){ 
                    $query->the_post(); 
                    $image = get_field('mobile_image'); 
                                            $imgUrl; 
                                            if($image['sizes']['medium_large']){
                                                $imgUrl = $image['sizes']['woocommerce_thumbnail'];
                                            }
                                            else{
                                                $imgUrl = $image['url'];
                                            }
                ?>
        
                <a  href="<?php echo  get_field('add_link'); ?>">                         
                    <picture>
                            <source media="(min-width:1366px)" srcset="<?php echo get_the_post_thumbnail_url(null,"full"); ?>">
                            <source media="(min-width:600px)" srcset="<?php echo get_the_post_thumbnail_url(null,"large"); ?>">
                            <img loading="lazy" src="<?php echo esc_url($imgUrl);?>"
                            alt="<?php echo get_the_title();?>">
              
                    </picture>
                </a>
        <?php 

            }
            wp_reset_postdata();
            ?>




    </div>
</section>

<!--Eighth section with three photos----->

<section class="eighth-section margin-large-row reverse-section">
    <div class="eighth-container row-container">

        <?php 

                $args = array(
                    'post_type' => 'tri-images',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'tri-Images-category',
                            'field'    => 'slug',
                            'terms'    => array( 'eighth-section-home-page')
                        )
                        )
                );
                $query = new WP_Query( $args );

                while($query->have_posts()){ 
                    $query->the_post(); 
                    $largeImage = get_field('large_image'); 
                    $firstImage = get_field('first_small_image'); 
                    $secondImage = get_field('second_small_image'); 

                   
                ?>
        
                <div class="images-container flex-row flex-space-between">
                    <div class="first-image">
                        <a  href="<?php echo  get_field('large_image_link'); ?>">                         
                            <picture>
                                    <source media="(min-width:1366px)" srcset="<?php echo $largeImage['sizes']['full']; ?>">
                                    <source media="(min-width:600px)" srcset="<?php echo $largeImage['sizes']['large'];?>">
                                    <img loading="lazy" src="<?php echo $largeImage['sizes']['woocommerce_thumbnail'];?>"
                                    alt="<?php echo get_the_title();?>">
                    
                            </picture>
                        </a>
                    </div>
                   
                    <div class="second-image small-image">
                            <picture>
                                        <source media="(min-width:1366px)" srcset="<?php echo $firstImage['sizes']['full']; ?>">
                                        <source media="(min-width:600px)" srcset="<?php echo $firstImage['sizes']['large'];?>">
                                        <img loading="lazy" src="<?php echo $firstImage['sizes']['woocommerce_thumbnail'];?>"
                                        alt="<?php echo get_field('first_image_title');?>">
                    
                            </picture>
                            <a class="anchor-overlay rm-txt-dec center-align" href="<?php echo  get_field('first_small_image_link'); ?>"><?php echo get_field('first_image_title'); ?></a>
                    </div>
                    <div class="third-image small-image">
                            <picture>
                                        <source media="(min-width:1366px)" srcset="<?php echo $secondImage['sizes']['full']; ?>">
                                        <source media="(min-width:600px)" srcset="<?php echo $secondImage['sizes']['large'];?>">
                                        <img loading="lazy" src="<?php echo $secondImage['sizes']['woocommerce_thumbnail'];?>"
                                        alt="<?php echo get_field('second_image_title');?>">
                    
                            </picture>
                            <a class="anchor-overlay rm-txt-dec center-align" href="<?php echo  get_field('second_small_image_link'); ?>"><?php echo get_field('second_image_title'); ?></a>
                    </div>
                    
                </div>
                <div class="title-container flex-row align-end">
                    <h6 class="column-font-size regular"><?php echo get_the_title();?></h6>
                    <p><?php echo get_the_content();?></p>
                </div>
        <?php 

            }
            wp_reset_postdata();
            ?>




    </div>
</section>

<!--Favourite - Ninth section  ----->

<section class="trending-section  margin-row row-container">
    
    <div class="title-container flex-row flex-start align-end">
        <h3 class="section-font-size">Our Favourites</h3>  
        <h4 class="roboto-font medium-font-size thin">What we’re covering most this season</h4>                                
    </div>                                   
    
    <div class="flex flex-row owl-carousel owl-theme">

        <?php 

            $argsFavourite = array(
                'post_type' => 'homepage-cards',
                'posts_per_page'=> -1,
                    'orderby' => 'date', 
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'home-page-card-category',
                            'field'    => 'slug',
                            'terms'    => array( 'our-favourites-home-page')
                        )
                        ), 
            );
            $favourite = new WP_Query( $argsFavourite );

            while($favourite->have_posts()){ 
                $favourite->the_post(); 

                ?>
        
            <a class="cards rm-txt-dec"  href="<?php echo get_field('category_link');?>">
            
         
                    <img loading="lazy" src="<?php echo get_the_post_thumbnail_url(null,"medium"); ?>"
                            alt="Khroma">
                    <div class="paragraph-font-size margin-top"  id="trending-now" ><?php echo get_the_title();?> </div>
              
            </a>
    
        <?php 

            }
            wp_reset_postdata();
            ?>




    </div>
</section>

<!-- our services - tenth section  -->
<section class="service-page">
                <?php 

                $argsFavourite = array(
                    'pagename' => 'our-services',
                    'posts_per_page'=> -1,
                        'orderby' => 'date', 
                        'order' => 'ASC',
                );
                $favourite = new WP_Query( $argsFavourite );

                while($favourite->have_posts()){ 
                    $favourite->the_post(); 
                      $desktopImage = get_the_post_thumbnail_url(null,"large");
                      $mobileImage = get_the_post_thumbnail_url(null,"woocommerce_thumbnail");
                      
                    ?>
    
        <div class="hero-section"  style='background: url("<?php echo $desktopImage; ?>") no-repeat center top/cover;'>
            <div class="hero-overlay"></div>
        </div>    
        <div class="stamp hero-content">
            <i class="fal fa-home-alt"></i>
            <div class="section-font-size">INSPIRY</div>
            <div class="medium-font-size">Interior Design Services</div>
            <a class="rm-txt-dec button btn-dk-green" href="<?php echo get_site_url();?>/consultation">MAKE AN APPOINTMENT</a>
        </div>
        <?php 

            }
            wp_reset_postdata();
            ?>
    </section>


<!-- Brand Cards - eleventh section -->
<section class="brand-logo-section beige-color-bc">
    
    <div class="title-container flex-row flex-start align-end row-container">
        <div class="column-font-size">Shop Our Family of Brands</div>  
    </div>                                   
    
    <div class="flex flex-row owl-carousel owl-theme row-container">

        <?php 

            $argsBrandLogo = array(
                'post_type' => 'shop_by_brand',
                'posts_per_page'=> -1,
                    'orderby' => 'date', 
                    'order' => 'ASC'
            );
            $brandLogo = new WP_Query( $argsBrandLogo );

            while($brandLogo->have_posts()){ 
                $brandLogo->the_post(); 
                $imageUrl = get_field('brand_logo');
                ?>

            <?php if($imageUrl['sizes']){
                ?>
                    <a class="cards rm-txt-dec"  href="<?php echo get_field('add_a_link');?>">
                            <img class="brand-image" loading="lazy" src="<?php echo get_the_post_thumbnail_url(null,"woocommerce_thumbnail"); ?>"
                                    alt="Khroma">    
                            <img class="brand-logo" loading="lazy" src="<?php echo $imageUrl['sizes']['medium']; ?>" alt="">
                                     
                    </a>
                <?php
            }
                ?>
        <?php 

            }
            wp_reset_postdata();
            ?>
    </div>
</section>

<!-- Be inspired Section - 12th section -->
<section class="be-inspired-section">
    <div class="container ">
        <?php 

            $argsBrandLogo = array(
                'post_type' => 'post',
                'posts_per_page'=> -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'slug',
                            'terms'    => array( 'be-inspired-section-home-page'),
                        )
                        )
            );
            $brandLogo = new WP_Query( $argsBrandLogo );

            while($brandLogo->have_posts()){ 
                $brandLogo->the_post(); 
                $firstImage = get_field('first_image');
                $secondImage = get_field('second_image');
                $thirdImage = get_field('third_image');
                $fourthImage = get_field('fourth_image');
                $fifthImage = get_field('fifth_image');
                $sixthImage = get_field('sixth_image');
                ?>
            <div class="first-image-container">
                <img loading="lazy" src="<?php echo $firstImage['sizes']['woocommerce_thumbnail'] ?>" alt="<?php echo get_the_title(); ?> First Image">
                <img loading="lazy" src="<?php echo $secondImage['sizes']['woocommerce_thumbnail'] ?>" alt="<?php echo get_the_title(); ?> second Image">
                <img loading="lazy" src="<?php echo $thirdImage['sizes']['woocommerce_thumbnail'] ?>" alt="<?php echo get_the_title(); ?> third Image">
                <img loading="lazy" src="<?php echo $fourthImage['sizes']['woocommerce_thumbnail'] ?>" alt="<?php echo get_the_title(); ?> fourth Image"> 
            </div>
            
            <!-- content box -->
            <div class="content-box beige-color-bc flex-column">
                <div class="title-container margin-elements">
                    <i class="fad fa-house-user center-align"></i>
                    <h6 class="center-align column-font-size regular"><?php echo get_the_title();?></h6>
                </div>
                <div class="paragraph center-align"><?php echo get_the_content();?></div>
                <div class="step-container">
                    <div class="step_1 roboto-font thin medium-font-size"><?php echo get_field('step_1'); ?></div>
                    <div class="step_2 roboto-font thin medium-font-size"><?php echo get_field('step_2'); ?></div>
                    <div class="step_3 roboto-font thin medium-font-size"><?php echo get_field('step_3'); ?></div>
                </div>
                <div class="button-container">
                    <a class="button btn-dk-green-border rm-txt-dec center-align" href="<?php echo get_field('enter_now_link');?>">ENTER NOW</a>
                </div>
            </div>


            <!-- second lot images  -->
            <div class="second-image-container">
                <img loading="lazy" src="<?php echo $fifthImage['sizes']['woocommerce_thumbnail'] ?>" alt="<?php echo get_the_title(); ?> fifth Image">
                <img loading="lazy" src="<?php echo $sixthImage['sizes']['woocommerce_thumbnail'] ?>" alt="<?php echo get_the_title(); ?> sixth Image">
            </div>
            
        <?php 

            }
            wp_reset_postdata();
            ?>
    </div>
                                    
    
</section>



<!-- Trade Professional - 13th section -->
<section class="trade-professional-section row-container">
    <div class="container margin-large-row">
        <?php 

            $argsBrandLogo = array(
                'post_type' => 'post',
                'posts_per_page'=> -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'slug',
                            'terms'    => array( 'trade-professional-section-home-page'),
                        )
                        )
            );
            $brandLogo = new WP_Query( $argsBrandLogo );

            while($brandLogo->have_posts()){ 
                $brandLogo->the_post(); 
                $tradeImage = get_field('trade_professional_profile_image');
                $projectImage = get_field('project_image');
              
                ?>
                <!-- content box -->
                <div class="content-box beige-color-bc">
                    <div class="title center-align section-font-size"><?php echo get_the_title();?></div>
                    <div class="paragraph center-align roboto-font regular"><?php echo get_the_content();?></div>
                    <a class="button btn-dk-green rm-txt-dec center-align" href="<?php echo get_site_url();?>/trade-professionals/">View Trade Professionals</a>
                    <a class="button btn-dk-green-border rm-txt-dec center-align" href="<?php echo get_site_url();?>/add-listing/?listing_type=gd_place">Join Trade Directory</a>

                </div>
                <!--  trade proffesional image-->
                <div class="trade-image">
                    <picture>
                                    <source media="(min-width:1366px)" srcset="<?php echo $tradeImage['sizes']['full']; ?>">
                                    <source media="(min-width:600px)" srcset="<?php echo $tradeImage['sizes']['large'];?>">
                                    <img loading="lazy" src="<?php echo $tradeImage['sizes']['woocommerce_thumbnail'] ?>" alt="<?php echo get_the_title(); ?>">
                    
                    </picture>
                </div>

                <!--  trade proffesional image-->
                <div class="project-image">
                    <picture>
                                    <source media="(min-width:1366px)" srcset="<?php echo $projectImage['sizes']['full']; ?>">
                                    <source media="(min-width:600px)" srcset="<?php echo $projectImage['sizes']['large'];?>">
                                    <img loading="lazy" src="<?php echo $projectImage['sizes']['woocommerce_thumbnail'] ?>" alt="<?php echo get_the_title(); ?>">
                    
                    </picture>
                </div>
            
            
            
                <?php 

                    }
                    wp_reset_postdata();
                    ?>
    </div>
                                    
    
</section>

<script>
    const slides = document.querySelectorAll('.slide');
    const next = document.querySelector('#next');
    const prev = document.querySelector('#prev');
    const auto = true; // Auto scroll
    const intervalTime = 3000;
    let slideInterval;
    slides[0].classList.add('current');

    const nextSlide = () => {
        // Get current class
        const current = document.querySelector('.current');
        // Remove current class
        current.classList.remove('current');
        // Check for next slide
        if (current.nextElementSibling) {
            // Add current to next sibling
            current.nextElementSibling.classList.add('current');
        } else {
            // Add current to start
            slides[0].classList.add('current');
        }
        setTimeout(() => current.classList.remove('current'));
    };

    const prevSlide = () => {
        // Get current class
        const current = document.querySelector('.current');
        // Remove current class
        current.classList.remove('current');
        // Check for prev slide
        if (current.previousElementSibling) {
            // Add current to prev sibling
            current.previousElementSibling.classList.add('current');
        } else {
            // Add current to last
            slides[slides.length - 1].classList.add('current');
        }
        setTimeout(() => current.classList.remove('current'));
    };

    // Button events
    next.addEventListener('click', e => {
        console.log('clicked');
        nextSlide();
        if (auto) {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, intervalTime);
        }
    });

    prev.addEventListener('click', e => {
        prevSlide();
        if (auto) {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, intervalTime);
        }
    });

    // Auto slide
    if (auto) {
        // Run next slide at interval time
        slideInterval = setInterval(nextSlide, intervalTime);
    }
</script>
<?php 

get_footer(); 
?>