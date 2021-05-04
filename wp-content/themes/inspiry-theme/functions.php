<?php 
/**
 * Inspiry functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package inspiry

 */
require get_theme_file_path('/inc/woocommerce.php');

require get_theme_file_path('/inc/buddypress-design-boards.php');

require get_theme_file_path('/inc/boards-route.php');
require get_theme_file_path('/inc/custom-post-type.php');

require get_theme_file_path('/inc/nav-registeration.php');




 //enqueue scripts

 function inspiry_scripts(){ 
   wp_enqueue_script("jQuery");
   wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/f3cb7ab01f.js', NULL, '1.0', false);
   wp_enqueue_style("google-fonts", "https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,900&display=swap", false);
  
   if (strstr($_SERVER['SERVER_NAME'], 'localhost')) {
      wp_enqueue_script('main', 'http://localhost:3000/bundled.js',  array( 'jquery' ), '1.0', true);
    } else {
      wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.aebecbb789db7969773b.js'),  array( 'jquery' ), '1.0', true);
      wp_enqueue_script('main', get_theme_file_uri('/bundled-assets/scripts.4c341e6c03082b4678f0.js'), NULL, '1.0', true);
      wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.4c341e6c03082b4678f0.css'));      
      wp_enqueue_style('our-vendor-styles', get_theme_file_uri('/bundled-assets/styles.aebecbb789db7969773b.css'));

    }
    wp_localize_script("main", "inspiryData", array(
      "root_url" => get_site_url(),
      "nonce" => wp_create_nonce("wp_rest")
    ));
}
add_action( "wp_enqueue_scripts", "inspiry_scripts" ); 

  //admin bar
  if ( ! current_user_can( "manage_options" ) ) {
   show_admin_bar( false );
}
//sidebar


add_action( "widgets_init", "mat_widget_areas" );
function mat_widget_areas() {
    register_sidebar( array(
        "name" => "Theme Sidebar",
        "id" => "mat-sidebar",
        "description" => "The main sidebar shown on the right in our awesome theme",
        "before_widget" => '<li id="%1$s" class="widget %2$s">',
		"after_widget"  => "</li>",
		"before_title"  => '<h3 class="widget-title">',
		"after_title"   => "</h3>",
    ));
}



//custom post register

add_theme_support("post-thumbnails");
function register_custom_type(){ 
   register_post_type("boards", array(
     'show_in_rest' => true, 
      'has_archive' => true,
      "supports" => array("title", "page-attributes", 'editor'), 
      "public" => true, 
      "show_ui" => true, 
      "hierarchical" => true,
      "labels" => array(
         "name" => "Boards", 
         "add_new_item" => "Add New Board", 
         "edit_item" => "Edit Board", 
         "all_items" => "All Boards", 
         "singular_name" => "Board"
      ), 
      "menu_icon" => "dashicons-heart"
      
   )
   ); 
}

add_action("init", "register_custom_type"); 

 //make private page parent/child
 add_filter("page_attributes_dropdown_pages_args", "my_attributes_dropdown_pages_args", 1, 1);

function my_attributes_dropdown_pages_args($dropdown_args) {

    $dropdown_args["post_status"] = array("publish","draft", "private");

    return $dropdown_args;
}


// remove "Private: " from titles
function remove_private_prefix($title) {
	$title = str_replace("Private: ", "", $title);
	return $title;
}
add_filter("the_title", "remove_private_prefix");

//facet wp
function fwp_archive_per_page( $query ) {
   if ( is_tax( 'category' ) ) {
       $query->set( 'posts_per_page', 20 );
   }
}
add_filter( 'pre_get_posts', 'fwp_archive_per_page' );


function fwp_home_custom_query( $query ) {
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'post_type', [ 'post', 'product' ] );
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'ASC' );
    }
}
add_filter( 'pre_get_posts', 'fwp_home_custom_query' );

//navbar
class CSS_Menu_Walker extends Walker {

	var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');
	
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}
	
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	
		global $wp_query;
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		
		/* Add active class */
		if (in_array('current-menu-item', $classes)) {
			$classes[] = 'active';
			unset($classes['current-menu-item']);
		}
		
		/* Check for children */
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if (!empty($children)) {
			$classes[] = 'has-sub';
		}
		
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';
		
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		
		$attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
		$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
		$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
		$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;
		
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
	
	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}
}

//upload images 

function handle_my_file_upload() {
 

  // will return the attachment id of the image in the media library
  $attachment_id = media_handle_upload('my_file_field', 0);

  // test if upload succeeded
  if (is_wp_error($attachment_id)) {
      http_response_code(400);
      echo 'Failed to upload file.';
      return 'failed to upload file';
  }
  else {
      http_response_code(200);
      echo $attachment_id;
      return 'saved a file';
  }

  // done!
  die();
}

// allow uploads from users that are logged in
add_action('wp_ajax_my_file_upload', 'handle_my_file_upload');

// allow uploads from guests
//add_action('wp_ajax_nopriv_my_file_upload', 'handle_my_file_upload');



//preload css 
function add_rel_preload($html, $handle, $href, $media) {
    
  if (is_admin())
      return $html;

   $html = <<<EOT
<link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' />
EOT;
  return $html;
}
add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );

//redirect after login 
/**
* Redirect users to custom URL based on their role after login
*
* @param string $redirect
* @param object $user
* @return string
*/
function wc_custom_user_redirect( $redirect, $user ) {
  // Get the first of all the roles assigned to the user
  $role = $user->roles[0];
  $dashboard = admin_url();
  $myaccount = get_permalink( wc_get_page_id( 'shop' ) );
  if( $role == 'administrator' ) {
    //Redirect administrators to the dashboard
    $redirect = '/';
  }  elseif ( $role == 'customer' || $role == 'subscriber' ) {
    //Redirect customers and subscribers to the "My Account" page
    $redirect = '/';
  } else {
    //Redirect any other role to the previous visited page or, if not available, to the home
    $redirect = wp_get_referer() ? wp_get_referer() : home_url();
  }
  return $redirect;
}
add_filter( 'woocommerce_login_redirect', 'wc_custom_user_redirect', 10, 2 );


//yoast seo- add description if it doesn't exist 

add_filter( 'wpseo_metadesc', 'change_yoast_desc', 10, 2);

function change_yoast_desc ( $desc , $presentation ){
  global $product;
if(!$desc && $product){
  $desc = wp_trim_words($product->get_description(), 160);
}
  
	return $desc;
}

// ajax add to cart 
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
        
function woocommerce_ajax_add_to_cart() {

            $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
            $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
            $variation_id = absint($_POST['variation_id']);
            $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
            $product_status = get_post_status($product_id);

            if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

                do_action('woocommerce_ajax_added_to_cart', $product_id);

                if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
                    wc_add_to_cart_message(array($product_id => $quantity), true);
                }

                WC_AJAX :: get_refreshed_fragments();
            } else {
                $data = array(
                    'error' => true,
                    'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

                echo wp_send_json($data);
            }

            wp_die();
        }

        //add to cart ajax
       /**
 * Show cart contents / total Ajax
 */

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;

  ob_start();

  ?>
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

                            <!-- gtag manager data -->
                            <script type="text/javascript">

                            var placeOrderBtn = document.getElementsByClassName("checkout-btn-header")[0];

                            placeOrderBtn.addEventListener("click", function(event) {

                                dataLayer.push({
                                    'event': 'checkout',
                                    'ecommerce': {
                                        'checkout': {
                                            'actionField': {'step': 1},

                                            'products': [

                                            {
                                                'name': '<?php echo $product -> get_name()?>',                  
                                                'id': '<?php echo $product -> get_id()?>',
                                                'price': '<?php echo $product -> get_price()?>',
                                                'brand': '<?php echo  $product->get_attribute('pa_brands')?>	',
                                                            'category': '<?php $terms = get_the_terms( $product_id, 'product_cat' );
                                                            foreach ($terms as $term) {
                                                                $product_cat_id = $term->term_id;
                                                                
                                                                echo get_the_category_by_ID($product_cat_id);
                                                                echo ","; 
                                                                break;
                                                            } ?>',
                                                'variant': 'none',
                                                'quantity': '<?php echo $quantity; ?>'  
                                                },

                                            <?php
                                        
                                               
                                            ?>


                                            ]
                                        }
                                            }
                                    });
                            });

                            </script>	       

                    <!-- front end cart items cards -->
                    <div class="product-card">
                        <a href="<?php echo $link?>" class="rm-txt-dec">
                            
                            <div class="img-container">
                                <img src="<?php echo get_the_post_thumbnail_url($product_id, 'medium');?>" alt="<?php echo $product->name?>">
                            </div>
                            <div class="title-container">

                                <h5 class="font-s-regular regular"> <?php echo $quantity;?> X  <?php echo $product->name; 
                                
                                
                                ?> 
                                </h5>
                            </div>
                            
                            <div class="price-container">
                            <h6 class="font-s-regular roboto-font bold">$<?php echo $product->price * $quantity; ?></h6>
                            </div>
                            
                        </a>
                    </div>
                
                    <?php
                    
                    }
                    
                    ?>
			    </div>
                <div class="pop-up-footer">
                    <div class="total-container">
                        <div class="cart-btn">
                            <a class="rm-txt-dec button btn-dk-green-border btn-full-width center-align" href="<?php echo get_site_url();?>/cart">Cart</a>
                        </div>
                        <div class="total roboto-font">
                            Total: $<?php echo     str_replace(".00", "", (string)number_format (WC()->cart->total, 2, ".", ""));?>
                        </div>
                    </div>
                    <div class="checkout-btn">
                        <a class="rm-txt-dec button btn-dk-green btn-full-width center-align checkout-btn-header" href="<?php echo get_site_url();?>/checkout">Checkout</a>
                    </div>
                </div>
            </div>
 <?php
  $fragments['.cart-box'] = ob_get_clean();
  return $fragments;
}