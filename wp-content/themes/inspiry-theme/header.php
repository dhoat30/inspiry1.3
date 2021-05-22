<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PS7XFHN');</script>
<!-- End Google Tag Manager -->

    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <?php wp_head(); ?>
    
  
    <!-- magnifying --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnify/2.3.3/css/magnify.css" integrity="sha512-JxBFHHd+xyHl++SdVJYCCgxGPJKCTTaqndOl/n12qI73hgj7PuGuYDUcCgtdSHTeXSHCtW4us4Qmv+xwPqKVjQ==" crossorigin="anonymous" />

       
</head>
<?php 
    global $template;
    //check the template 
    if(is_post_type_archive()) {
        $archive = 'product-archive'; 
    }

?>
<body id="header"<?php body_class( );?> data-archive='<?php echo $archive ?>'>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PS7XFHN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <section class="header" >
       
        <div class="top-banner beige-color-bc">
           <!-- wishlist -->
            <div class="wishlist">
               <a href="<?php echo get_home_url().'/wishlist' ?>"   class="text-decoration-none dark-grey">
                    <i class="fas fa-heart"></i>
                    <span>Wishlist</span>
               </a> 
              
            </div>
              
            <!-- login area -->
            <div class="login-area playfair-fonts font-s-regular profile-trigger ">
               
                    <?php 
                        if(is_user_logged_in()){
                            global $current_user; wp_get_current_user();  
                            ?> <a href="" class="profile-name-value text-decoration-none dark-grey">
                                <i class="fas fa-user"></i> 
                                <span>  
                                     <?php echo  $current_user->display_name;?>
                                    <i class="fas fa-chevron-down regular arrow-icon"></i>
                                </span>
                               
                                <nav>
                                <?php
                                    wp_nav_menu( array( 
                                        'theme_location' => 'my-account-nav-top', 
                                        'container_class' => "my-account-nav"
                                    )); 
                                ?>
                                </nav>  
                                </a>       
                            <?php
                        }
                        else{
                            ?><a href="<?php echo get_site_url(); ?>/account-profile/" class="text-decoration-none dark-grey regular" data-root-url='<?php echo get_home_url()?>/account-profile'>
                                <i class="fas fa-user"></i>
                                <span>Login/Register</span> 
                        </a>
                            <?php
                        }
                    ?>
                
            </div>
            
            <!-- shopping cart -->
            <div class="shopping-cart playfair-fonts font-s-regular desktop-visible">
                <a href="#" class="text-decoration-none dark-grey regular cart-items-header">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-item-count">Cart (<?php echo WC()->cart->get_cart_contents_count(); ?>)</span>
                </a>
            </div>
            
            <div class="search-code playfair-fonts font-s-regular dark-grey">
               <?php  echo  do_shortcode('[ivory-search id="7686" title="Default Search Form"]');?>
            </div>
        </div>

        <!--logo -->
        <div class="logo-container">
            <a href="<?php echo get_site_url(); ?>">
                <img class="logo" src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/11/Inspiry_Logo-transparent-1.png" alt="Inspiry Logo">
            </a>
            <?php 
             global $post;
             $post_slug = $post->post_name;
                if($post_slug == 'inspiry-blogs'){ 
                    ?>
                    <img class="slogan" src="<?php echo  get_site_url();?>/wp-content/uploads/2020/11/Inspiry_Slogan.jpg" alt="Slogan">
                    <?php
                }
                
            ?>
        </div>

        <!--top navbar --> 
        <nav class="navbar top-navbar">
            <?php
               wp_nav_menu(
                    array(
                        'theme_location' => 'top-navbar', 
                        'container_id' => 'top-navbar'
                    ));
            ?>
           

            
            
        </nav>

        <!--Shop  navbar--> 
        <nav class="navbar">
            <?php
               wp_nav_menu(
                    array(
                        'theme_location' => 'inspiry_main_menu', 
                        'container_id' => 'cssmenu'
                    ));
            ?>
        </nav>
                 
        <div class="login-overlay"> 
            <i class="fal fa-times"></i>   
            <div class="form-content">
                
            </div>      
        </div>

    </section>


<?php 

//hide join trade in navbar if the user is logged in 
    if ( is_user_logged_in() ) {
            ?>
                <style>
                     .mega-menu-item-13607{
                         display: none !important;
                     }
                </style>
            <?php 

    }

    ?>
      
        <div class="cart-popup-container box-shadow">
            
        <div class="cart-box">
                <div class="flex-card">
                        <?php

                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $product = $cart_item['data'];
                            $product_id = $cart_item['product_id'];
                            $quantity = $cart_item['quantity'];
                            $price = WC()->cart->get_product_price( $product );
                            $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
                            $link = $product->get_permalink( $cart_item );
                            // Anything related to $product, check $product tutorial
                            $meta = wc_get_formatted_cart_item_data( $cart_item );
                           
                            ?>
                    <!-- front end cart items cards -->
                    <div class="product-card">
                        <?php 

                                // condition to check if the product is simple
                        if($product->name == "Free Sample"){
                                    // pulling information of an original product in a form of an objec†
                        $originalProduct = wc_get_product( $cart_item["free_sample"] );
                        
                        ?>
                        <a href="<?php echo get_the_permalink($originalProduct->get_id()); ?>" class="rm-txt-dec">
                            
                            <div class="img-container">
                                <img src="<?php echo wp_get_attachment_image_url( $originalProduct->image_id, 'woocommerce_thumbnail' );?>" alt="<?php echo $originalProduct->get_name()?>">
                            </div>
                            <div class="title-container">
                                    <h5 class="font-s-regular regular"> <?php echo $quantity;?> X  Free Sample (<?php echo $originalProduct->get_name(); 
                                    ?> )
                                    </h5>
                            </div>
                            
                            <div class="price-container">
                            <h6 class="font-s-regular roboto-font bold">$<?php echo number_format($product->price * $quantity) ?></h6>
                            </div>
                            <i class="fal fa-times remove-cart-item-btn" data-productID="<?php echo $product_id;?>"></i>
                        </a>

                        <?php
                        }
                        else{
                            ?>
                            <a href="<?php echo $link?>" class="rm-txt-dec">
                                
                                <div class="img-container">
                                    <img src="<?php echo get_the_post_thumbnail_url($product_id, 'medium');?>" alt="<?php echo $product->name?>">
                                </div>
                                <div class="title-container">
                                        <h5 class="font-s-regular regular"> <?php echo $quantity;?> X  <?php echo $product->name
                                        ?> 
                                        </h5>
                                </div>
                                
                                <div class="price-container">
                                <h6 class="font-s-regular roboto-font bold">$<?php echo number_format($product->price * $quantity); ?></h6>
                                </div>
                                
                                <i class="fal fa-times remove-cart-item-btn" data-productID="<?php echo $product_id;?>"></i>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                
                    <?php
                    
                    }
                    
                    ?>
			    </div>
                <div class="pop-up-footer">
                    <div class="total-container">
                        
                        <div class="total roboto-font">
                            Total: $<?php 
                            $totalAmount = str_replace(".00", "", (string)number_format (WC()->cart->total, 2, ".", ""));
                            echo number_format($totalAmount); ?>
                        </div>
                    </div>
                    <div class="cont-shopping">
                            <a class="rm-txt-dec button btn-dk-green-border btn-full-width center-align" href="#">Continue Shopping</a>
                        </div>
                    <div class="checkout-btn">
                        <a class="rm-txt-dec button btn-dk-green btn-full-width center-align checkout-btn-header" href="<?php echo get_site_url();?>/cart">Checkout</a>
                    </div>
                </div>
            </div>
			
		</div>



    <!-- gtag manager data -->
    <script type="text/javascript">
console.log('it is working now')
var placeOrderBtn = document.getElementsByClassName("checkout-btn-header");

placeOrderBtn.addEventListener("click", function(event) {
   
    dataLayer.push({
        'event': 'checkout',
        'ecommerce': {
            'checkout': {
                'actionField': {'step': 1},
                'products': [
    <?php
      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
        $product_id = $cart_item['product_id'];
        $quantity = $cart_item['quantity'];
        $price = WC()->cart->get_product_price( $product );
        $subtotal = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
        $link = $product->get_permalink( $cart_item );
        // Anything related to $product, check $product tutorial
        $meta = wc_get_formatted_cart_item_data( $cart_item );
       
        ?>
                        {
                            'name': '<?php echo $product -> get_name()?>',                  
                            'id': '<?php echo $product -> get_id()?>',
                            'price': '<?php echo $product -> get_price()?>',
                            'brand': '<?php echo  $product->get_attribute('pa_brands')?>	',
                                        'category': '<?php $terms = get_the_terms( $product_id, 'product_cat' );
                                        foreach ($terms as $term) {
                                            $product_cat_id = $term->term_id;
                                            
                                            echo get_the_category_by_ID($product_cat_id).",";
                                         
                                            break;
                                        } ?>',
                            'variant': 'none',
                            'quantity': '<?php echo $quantity; ?>'  
                            },


                            <?php
                  }    
                           
                    ?>
                        ]
                    }
                    }
                        }
                })
        })
        }
        </script>	