<?php 
get_header(); 

  while(have_posts()){
    the_post(); 
    ?>


    <section class="trade-directory-page">
        <!--hero section  -->
        <section class="hero-section trade-directory-hero-section beige-color-bc row-padding">
            <div class="row-container hero-container">
                <h3 class="column-s-font dark-grey regular">Trade Directory</h3>
                <?php 
                    $argsTypewriter = array(
                        'post_type' => 'typewriter_effect', 
                        'posts_per_page' => -1
                    );
                    $typewriterEffect = new WP_Query( $argsTypewriter );
                       
                        $titleArray = array_map('get_the_title', $typewriterEffect->posts);
                        
                        ?>
                        <h1 class="dark-grey lg-font-sz" data-title='<?php  echo json_encode($titleArray);?>'>Hallo, Wij zijn Occhio!</h1>

                        <?php
                
                    wp_reset_postdata(); 
                ?>
            </div>
        </section>
        <!-- main content section  -->

        <section class="trade-directory row-container main-content margin-row">
            
            <div class="sidebar">
                    <div class="close-icon">
                        <i class="fal fa-times"></i>
                    </div>
                    <?php //echo do_shortcode('[gd_categories post_type="0" max_level="1" max_count="all" max_count_child="all" title_tag="h4" sort_by="count"]');?>
                    <div class="category">
                        <div class="facet-wp-code">
                            <div class="title">
                                <h2 class="regular column-s-font"> Professional Categories</h2>
                                <i class="fal fa-plus"></i>
                            </div>
                            
                          
                            <?php echo do_shortcode('[facetwp facet="trade_proffesional_category"]');?>
                            
                        </div>
                    </div>

                    <div class="location">
                        <div class="facet-wp-code">
                            <div class="title">
                                <h2 class="regular column-s-font"> Regions</h2>
                                <i class="fal fa-plus"></i>
                            </div>
                            <?php echo do_shortcode('[facetwp facet="location"]');?>
                        </div>
                    </div>

                    <div class="professionals">
                        <div class="facet-wp-code">
                            <div class="title">
                                <h2 class="regular column-s-font"> Professionals</h2>
                                
                                <i class="fal fa-plus"></i>
                            </div>
                            <?php echo do_shortcode('[facetwp facet="professionals"]'); ?>
                        </div>
                    </div>
                    
                
                    <button onclick="FWP.reset()" class="facet-reset-btn">Reset</button>
                    
            </div>
            <div class="main-cards">
                <!-- count the number of trade proffesionals  -->

                <?php 
                    $proffesionalARgs = array(
                        'post_type' => 'gd_place', 
                        'posts_per_page' => -1
                    );
                    $tradeProfessionals = new WP_Query($proffesionalARgs); 
                    
                ?>
                <h1 class="section-ft-size regular"><?php  //echo $tradeProfessionals->post_count;?> Trade Professionals </h1>
                <div class="refine-button">
                    <a class="btn button btn-dk-green-border rm-txt-dec"><i class="fal fa-filter"></i> Filters</a>
                </div>
                <div class="flex">
                    <!-- get the template from facet wp  -->
                    <?php echo do_shortcode('[facetwp template="trade_professional"]');?>
                    
                    
                
                </div>
                <?php echo do_shortcode('[facetwp facet="pager_"]'); ?>
            </div>
        </section>
    </section>

                    
                  

    <?php
}

get_footer();
?>