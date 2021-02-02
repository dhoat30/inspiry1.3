<?php

//gallery 

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
function mytheme_add_woocommerce_support(){
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 200,
        'gallery_thumbnail_image_width' => 100,
        'single_image_width' => 900
        ) );
}

//adding container on product archive page
add_action('add_filters', 'add_container', 1); 
function add_container($class){
echo '<div class="row-container container flex-row flex-space-between margin-row '.$class.'">';

}

//add closing div
add_action('woocommerce_after_main_content', 'add_container_closing_div'); 

function add_container_closing_div(){
echo '</div>';
}

function add_double_container_closing_div(){
    echo '</div></div>';
    }
    




add_action('add_filters', 'add_facetwp_filters', 1); 

function add_facetwp_filters(){
    echo '<div class="facet-wp-container">' ;
        echo do_shortcode('[facetwp facet="categories"]'); 
        echo do_shortcode('[facetwp facet="brand"]'); 
        echo do_shortcode('[facetwp facet="collection"]'); 
        echo do_shortcode('[facetwp facet="colour_family"]'); 
        echo do_shortcode('[facetwp facet="pattern"]'); 
        echo do_shortcode('[facetwp facet="composition"]'); 
        echo do_shortcode('[facetwp facet="sho"]'); 
        echo '<button class="facet-reset-btn" onclick="FWP.reset()">Reset All Filter</button>'; 
    echo '</div>';
}

//adding filter 
//add_action('woocommerce_before_main_content', 'add_facetwp_filters', 1); 

//archive page title filter
//remove ordering 
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar' );


//add div container for breadcrumbs and image on single product
//

add_action('breadcrumb_image_container', 'add_image_breadcrumb_container'); 
function add_image_breadcrumb_container(){
    if(is_single()){
        echo '<div class="img-container">';
    }
}

add_action('double_closing_div', 'add_double_container_closing_div' );
//add_action('woocommerce_single_product_summary', 'WC_Structured_Data::generate_product_data()', 7); 

//add short description 
add_action('double_closing_div', function(){
    global $post, $wp_query;
    $postID = $wp_query->post->ID;
    $product = wc_get_product( $postID );
    echo '<section class="bc-single-product__warranty desktop-warranty">' ; 
    echo $product->get_short_description();
    echo '</section>';

},1);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
//wrapping container for gallery and product summary 
$class= 'img-summary-container'; 


    add_action('woocommerce_breadcrumb', function() { global $class ; 
        if(is_single()){
            add_container($class);
        }   
    }, 0);




//single product summary layout
//add description 
add_action('woocommerce_single_product_summary', function(){
    echo '<h3 class="product-description">'.get_the_content().'</h3>';
}, 7);

//add details 
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 8); 

//remove woocommerce_data tab
//remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');

function tutsplus_remove_product_long_desc( $tabs ) {
 
    unset( $tabs['description'] ); //remove description 
    $tabs['additional_information']['title'] = __( 'Details' ); //change name to Details
    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'tutsplus_remove_product_long_desc', 98 );

//remove dimensions in additional information 
add_filter( 'wc_product_enable_dimensions_display', '__return_false' );

//add label infront of quantity
add_action('woocommerce_before_quantity_input_field', function(){
    echo '<h6 class="qty-text roboto-font regular">Quantity:</h6>';
});

//remove meta-data 
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


//remove tabs
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

//add availablity 
add_action('add_availability_share', function(){
    echo '<p class="availability roboto-font regular-text">Availability: <span class="days">7 - 10 Days</span></p>';
    echo '<p class="share-section roboto-font regular-text">Share: '. do_shortcode( "[Sassy_Social_Share]" ).'</p>'; 
}, 100);


//closing div for product container

add_action('woocommerce_after_single_product_summary', 'add_container_closing_div');

//add wallpaper calculator 
add_action('woocommerce_single_product_summary', function(){
    global $post, $product; 
    $category = wp_strip_all_tags($product->get_categories());
    if($category === 'Wallpaper'){
        echo '<div class="product-page-btn-container">
        <a class="sizing-calculator-button"><i class="far fa-calculator" aria-hidden="true"></i> Wallpaper Calculator</a>       
     </div>'; 

     //add calculator body 
     add_action('add_calculator_body', 'calculator_body');
    }
   
}, 40); 

//add laybuy 
add_action('woocommerce_single_product_summary', function($price){
    global $post, $wp_query;
    $postID = $wp_query->post->ID;
    $product = wc_get_product( $postID );
    $layBuyPrice = round($product->get_price()/6, 2);
    echo '<h4>  
    <span class="lay-buy roboto-font">or 6 weekly interest-free payments from $'.$layBuyPrice.'</span> 
    <span class="lay-buy lay-buy-open information-overlay"> <img src="https://inspiry.co.nz/wp-content/uploads/2020/08/ico-laybuy.png"> What&#39;s this?</span>
</h4>'; 

//add laybuy body
    add_laybuy_body(); 
    
}, 15); 




//wallpaper calculator 
 

function calculator_body(){
    global $product; 
    echo '<div class="body-container">
       

    <!--sizing calculator-->
    <div class="overlay-background">
        <div class="calculator-overlay">
        <i class="fal fa-times close"></i>

            <div id="calculator-container">
                <div class="popup-modal wallpaper-calculator-modal is-open">
          
                  <h1>Wallpaper Calculator</h1>
          
          
              <form name="wallpaper_calculator" id="wallpaper-calculator">
                <section>
                  <div>
                    <label for="calc-roll-width">Roll Width<em>*</em> </label>
                    <select name="calc-roll-width" id="calc-roll-width"><option value="37.2">37.2 cm</option><option value="42">42 cm</option><option value="45">45 cm</option><option value="48.5">48.5 cm</option><option value="53">53 cm</option><option value="52">52 cm</option><option value="64">64 cm</option><option value="68">68 cm</option><option value="68.5">68.5 cm</option><option value="70">70 cm</option><option value="90">90 cm</option><option value="95">95 cm</option><option value="100">100 cm</option><option value="140">140 cm</option></select>
                    <label for="calc-roll-height">Roll Length<em>*</em> </label>
                    <select name="calc-roll-height" id="calc-roll-height"><option value="2.65">2.65 cm</option><option value="2.79">2.79 cm</option><option value="3">3 cm</option><option value="5.6">5.6 cm</option><option value="6">6 cm</option><option value="8.5">8.5 cm</option><option value="8.37">8.37 cm</option><option value="9">9 cm</option><option value="10">10 cm</option><option value="10.05">10.05 cm</option><option value="12">12 cm</option><option value="24">24 cm</option></select>
                  </div>
                  <aside>
                    <label for="last-name">Wall width<em>*</em></label>
                    <div class="input-group">
                      <input type="text" name="calc-wall-width1" value="" id="calc-wall-width1" class="form-control" placeholder="Wall 1 width">
                          <span class="input-group-addon">m</span>
                    </div>
                    <div class="input-group">
                      <input type="text" name="calc-wall-width2" value="" id="calc-wall-width2" class="form-control" placeholder="Wall 2 width">
                          <span class="input-group-addon">m</span>
                    </div>
                    <div class="input-group">
                      <input type="text" name="calc-wall-width" value="" id="calc-wall-width3" class="form-control" placeholder="Wall 3 width">
                          <span class="input-group-addon">m</span>
                    </div>
                    <div class="input-group">
                      <input type="text" name="calc-wall-width4" value="" id="calc-wall-width4" class="form-control" placeholder="Wall 4 width">
                          <span class="input-group-addon">m</span>
                      </div>
                  </aside>
                  <aside>
                    <label for="last-name">Wall height<em>*</em></label>
                    <div class="input-group">
                      <input type="text" name="calc-wall-height1" value="" id="calc-wall-height1" class="form-control" placeholder="Wall 1 length">
                          <span class="input-group-addon">m</span>
                    </div>
                    <div class="input-group">
                      <input type="text" name="calc-wall-height2" value="" id="calc-wall-height2" class="form-control" placeholder="Wall 3 length">
                          <span class="input-group-addon">m</span>
                    </div>
                    <div class="input-group">
                      <input type="text" name="calc-wall-height3" value="" id="calc-wall-height3" class="form-control" placeholder="Wall 3 length">
                          <span class="input-group-addon">m</span>
                    </div>
                    <div class="input-group">
                      <input type="text" name="calc-wall-height4" value="" id="calc-wall-height4" class="form-control" placeholder="Wall 4 length">
                          <span class="input-group-addon">m</span>
                      </div>
                  </aside>
                </section>
                <section>
                  <label for="address">Repeat<em>(optional)</em></label>
                  <div class="input-group">
                    <input type="text" name="calc-pattern-repeat" value="" id="calc-pattern-repeat" class="form-control">
                    <span class="input-group-addon">cm</span>
                  </div>
                </section>
                <section class="buttons">
                  <button id="estimate-roll" class="button btn-dk-green ">Calculate</button>
                </section>
                <section class="estimate-result margin-elements">
                      <h3>Result</h3>
                      <p>
                      
                              <span class="calc-round">0</span>&nbsp;
                              <span class="suffix-singular hidden" style="display: none;">roll</span>
                              <span class="suffix-plural">rolls</span>
                   
                      </p>
                </section>
            
                <section class="message margin-elements">
                  <p>Please check your measurements carefully. Inspiry is not responsible for overages or shortages based on this calculator.</p>
                </section>
            
              </form>
          
          
          
          
                </div>
              </div>
        </div>
      </div>
</div>';
}

function add_laybuy_body(){
    echo '
    <section id="laybuy-popup">
        <div class="laybuy-popup-content box-shadow">
        <span class="dashicons dashicons-no-alt close-laybuy"></span>		
   
        <div class="popLogo">
            <svg id="Layer_1" class="laybuy-logo-overlay" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 433.65 97.39">
                <defs>
                    <style>
                        .cls-2 {
                            fill: #000;
                        }
                    </style>
                </defs>
                <title>consumer-logo</title>
                <path fill="#786DFF" d="M129,472.24,81.35,424.63a11.53,11.53,0,0,1,0-16.26h0a11.53,11.53,0,0,1,16.26,0l38.19,38.19a1.45,1.45,0,0,0,2.11,0L173,411.43l3.48-3.51a5.72,5.72,0,0,0,.05-8.21,5.94,5.94,0,0,0-8.4,0l-3.39,3.48-19.33,19.33a11.53,11.53,0,0,1-16.26,0h0l-23.1-23.1a11.53,11.53,0,0,1,0-16.26h0a11.53,11.53,0,0,1,16.26,0l13.92,14.17s1.06.78,1.84,0L149,386.45a28.83,28.83,0,1,1,40.78,40.78l-.47.47L145,472a11.53,11.53,0,0,1-16.26,0h0" transform="translate(-78 -377.99)"></path>
                <path class="cls-2" d="M231.76,415.23a1.69,1.69,0,0,1,3.38,0v41h25.42a1.56,1.56,0,1,1,0,3.12H233.45a1.72,1.72,0,0,1-1.69-1.69Z" transform="translate(-78 -377.99)"></path>
                <path class="cls-2" d="M272.38,457.09,291.82,415a2.38,2.38,0,0,1,2.27-1.62h.13A2.38,2.38,0,0,1,296.5,415l19.37,42a2.22,2.22,0,0,1,.26,1,1.6,1.6,0,0,1-1.62,1.56,2,2,0,0,1-1.69-1.3l-5.33-11.7H280.64l-5.33,11.77a1.72,1.72,0,0,1-1.62,1.23,1.52,1.52,0,0,1-1.56-1.43A2.42,2.42,0,0,1,272.38,457.09Zm33.67-13.59-12-26.33-12,26.33Z" transform="translate(-78 -377.99)"></path>
                <path class="cls-2" d="M337.52,441.3l-17.75-25a2.16,2.16,0,0,1-.33-1,1.78,1.78,0,0,1,1.76-1.69,1.81,1.81,0,0,1,1.56,1l16.51,23.73,16.58-23.73a1.85,1.85,0,0,1,1.5-1,1.76,1.76,0,0,1,1.69,1.63,2.51,2.51,0,0,1-.52,1.3L340.9,441.23v16.64a1.69,1.69,0,0,1-3.38,0Z" transform="translate(-78 -377.99)"></path>
                <path class="cls-2" d="M371.18,418.81a5,5,0,0,1,5-5h16.12c5.2,0,9.3,1.43,11.9,4a10.44,10.44,0,0,1,3.12,7.74v.13c0,5.14-2.73,8-6,9.82,5.27,2,8.52,5.07,8.52,11.18v.13c0,8.32-6.76,12.48-17,12.48H376.19a5,5,0,0,1-5-5Zm19,13.39c4.42,0,7.22-1.43,7.22-4.81v-.13c0-3-2.34-4.68-6.57-4.68h-9.88v9.62Zm2.67,18.33c4.42,0,7.08-1.56,7.08-4.94v-.13c0-3.05-2.28-4.94-7.41-4.94H380.93v10Z" transform="translate(-78 -377.99)"></path>
                <path class="cls-2" d="M420.65,439.8V418.42a5,5,0,0,1,10,0v21.13c0,7.41,3.71,11.25,9.82,11.25s9.82-3.71,9.82-10.92V418.42a5,5,0,0,1,10,0v21.06c0,13.78-7.74,20.54-20,20.54S420.65,453.19,420.65,439.8Z" transform="translate(-78 -377.99)"></path>
                <path class="cls-2" d="M485.65,441.75,471,421.8a5.93,5.93,0,0,1-1.24-3.58,4.89,4.89,0,0,1,5-4.81c2.27,0,3.71,1.23,4.94,3.06l11.05,15.93L502,416.34c1.24-1.82,2.73-3,4.81-3a4.64,4.64,0,0,1,4.88,4.88,6.22,6.22,0,0,1-1.3,3.51l-14.69,19.83v13.13a5,5,0,0,1-10,0Z" transform="translate(-78 -377.99)"></path>
                <path fill="#786DFF" d="M129,472.24,81.35,424.63a11.53,11.53,0,0,1,0-16.26h0a11.53,11.53,0,0,1,16.26,0l38.19,38.19a1.45,1.45,0,0,0,2.11,0L173,411.43l3.48-3.51a5.72,5.72,0,0,0,.05-8.21,5.94,5.94,0,0,0-8.4,0l-3.39,3.48-19.33,19.33a11.53,11.53,0,0,1-16.26,0h0l-23.1-23.1a11.53,11.53,0,0,1,0-16.26h0a11.53,11.53,0,0,1,16.26,0l13.92,14.17s1.06.78,1.84,0L149,386.45a28.83,28.83,0,1,1,40.78,40.78l-.47.47L145,472a11.53,11.53,0,0,1-16.26,0h0" transform="translate(-78 -377.99)"></path>
            </svg>
        </div>

   
        <h2 class="g-heading2 roboto-font regular">Receive your purchase now, spread the total cost over 6 weekly automatic payments. Interest free!</h2>
        <ul class="laybuySteps roboto-font">
            <li class="roboto-font">
                <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/laybuy-cart.png" alt="">
                <div class="desc roboto-font" >
                    Simply select <strong>Laybuy</strong> as your payment method at checkout
                </div>
            </li>
            <li>
                <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/laybuy-login.png" alt="">
                <div class="desc roboto-font">
                    Login or Register for Laybuy and complete your order in seconds
                </div>
            </li>
            <li>
                <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/laybuy-mobile.png" alt="">
                <div class="desc roboto-font">
                    Complete your purchase using an existing debit or credit card
                </div>
            </li>
            <li>
                <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/download.png" alt="">
                <div class="desc roboto-font">
                    Pay over 6 weeks and receive your purchase now
                </div>
            </li>
        </ul>


                </div>
            </section>';
}; 





//checkout 

add_action('woocommerce_checkout_before_order_review_heading', function(){
    echo '<div class="order-review-container">';
});
add_action('woocommerce_review_order_after_payment', 'add_container_closing_div');





//add sample functonality 

add_action( 'woocommerce_single_product_summary', 'bbloomer_add_free_sample_add_cart', 35 );
  
function bbloomer_add_free_sample_add_cart() {
   ?>
      <form class="cart" method="post" enctype='multipart/form-data'>
      <button type="submit" name="add-to-cart" value="14441" class="button btn-dk-green-border btn-full-width margin-top">ORDER FREE SAMPLE</button>
      <input type="hidden" name="free_sample" value="<?php the_ID(); ?>">
      </form>
   <?php
}
  
// -------------------------
// 2. Add the custom field to $cart_item
  
add_filter( 'woocommerce_add_cart_item_data', 'bbloomer_store_free_sample_id', 9999, 2 );
  
function bbloomer_store_free_sample_id( $cart_item, $product_id ) {
   if ( isset( $_POST['free_sample'] ) ) {
         $cart_item['free_sample'] = $_POST['free_sample'];
   }
   return $cart_item; 
}
  
// -------------------------
// 3. Concatenate "Free Sample" with product name (CART & CHECKOUT)
// Note: rename "Free Sample" to your free sample product name
  
add_filter( 'woocommerce_cart_item_name', 'bbloomer_alter_cart_item_name', 9999, 3 );
  
function bbloomer_alter_cart_item_name( $product_name, $cart_item, $cart_item_key ) {
   if ( $product_name == "Free Sample" ) {
      $product = wc_get_product( $cart_item["free_sample"] );
      $product_name .=  " (" . $product->get_name() . ")";
   }
   return $product_name;
}
  
// -------------------------
// 4. Add "Free Sample" product name to order meta
// Note: this will show on thank you page, emails and orders
  
add_action( 'woocommerce_add_order_item_meta', 'bbloomer_save_posted_field_into_order', 9999, 2 );
  
function bbloomer_save_posted_field_into_order( $itemID, $values ) {
    if ( ! empty( $values['free_sample'] ) ) {
      $product = wc_get_product( $values['free_sample'] );
      $product_name = $product->get_name();
      wc_add_order_item_meta( $itemID, 'Free sample for', $product_name );
    }
}
