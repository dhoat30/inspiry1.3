<?php 
get_header(); 

  while(have_posts()){
    the_post(); 
    ?>

    <!-- <div class="trade-proffesional-page">
        <div class="row-container trade-cards-section">
            <h1>hello</h1>
            <div class="sidebar row-container">
                 
                 <?php //echo do_shortcode('[ivory-search id="7686" title="Default Search Form"]');?>

                <div class="roboto-font font-s-medium">Category</div>
                <?php //echo do_shortcode('[facetwp facet="trade_proffesional_category"]');?>
                <button onclick="FWP.reset()" class="facet-reset-btn">Reset</button>
        </div>
        <div class="flex">
        <?php //echo do_shortcode('[facetwp template="trade_professional"]');?>

        <?php //echo do_shortcode('[facetwp facet="pager_"]'); ?>
        </div>

        </div>
    </div> -->

    <div class="row-container main-content">
        <div class="sidebar">
            this is a sidebar
        </div>

        <div class="flex-cards">
            <?php 
                $argsTradeProfessional = array(
                    'post_type' => 'gd_place', 
                    'post_per_page' => -1
                );
                $tradeProfessional = new WP_Query( $argsTradeProfessional );

                while($tradeProfessional->have_posts()){ 
                    $tradeProfessional->the_post(); 
                    ?>
                        <div class="card">
                            <a href="<?php the_permalink();?>">
                                <div class="trade-logo">
                                    <?php
                                    $variable =  do_shortcode('[gd_post_meta key="logo" show="value-raw" no_wrap="1" alignment="left"]');
                                    $variable = substr($variable, 0, strpos($variable, "|"));
                                    ?>
                                    <img src="<?php echo  $variable?>" alt="<?php the_title();?>">
                                </div>
                            </a>
                        </div>
                    <?php
                }
                    ?>
        </div>
    </div>
    


    <?php
}

get_footer();
?>