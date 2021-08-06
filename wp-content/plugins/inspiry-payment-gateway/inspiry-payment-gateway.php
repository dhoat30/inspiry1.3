<?php
/**
 * Plugin Name: Inspiry Payment for Woocommerce
 * Plugin URI: https://webduel.co.nz
 * Author Name: Gurpreet Singh Dhoat
 * Author URI: https://webduel.co.nz
 * Description: This plugin allows for local content payment systems.
 * Version: 0.1.0
 * License: 0.1.0
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: inspiry-pay-woo
*/ 

   // Make sure WooCommerce is active
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

// link styledsheet

add_action( 'plugins_loaded', 'inspiry_payment_init', 11 );

function inspiry_payment_init() { 
    if(class_exists('WC_Payment_Gateway')){
        class Inspiry_Payment_Gateway extends WC_Payment_Gateway {

            // constructor function 
            public function __construct()
            {   
                $this->seamlessHpp = ''; 
                $this->id = "inspiry_payment"; 
                $this->icon = apply_filters( 'woocommerce_inspiry_icon', plugins_url('/assets/icon.png', __FILE__ ) );
                $this->has_fields = false; 
                $this->method_title = __('Windcave Payment', 'inspiry-pay-woo'); 
                $this->method_description =  __('Pay with your Credit or Debit Card via Windcave.', 'inspiry-pay-woo'); 

                $this->title = $this->get_option( 'title' );
                $this->description = $this->get_option( 'description' );
                $this->instructions = $this->get_option( 'instructions', $this->description );

                $this->windcave_iFrame(); 
                $this->payment_scripts();
           
                $this->init_form_fields();
                $this->init_settings();
                $this->place_order_button(); 

                add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
                
                // optional- redirects to thank you page 
                add_action( 'woocommerce_thank_you_' . $this->id, array( $this, 'thank_you_page' ) );
            }

            public function init_form_fields() { 
                $this->form_fields = apply_filters('woo_inspiry_pay_fields', array(
                    'enabled' => array(
                        'title' => __( 'Enable/Disable', 'inspiry-pay-woo'),
                        'type' => 'checkbox',
                        'label' => __( 'Enable or Disable Inspiry Payments', 'inspiry-pay-woo'),
                        'default' => 'no'
                    ),
                    'title' => array(
                        'title' => __( 'Inspiry Payments Gateway', 'inspiry-pay-woo'),
                        'type' => 'text',
                        'default' => __( 'Inspiry Payments Gateway', 'inspiry-pay-woo'),
                        'desc_tip' => true,
                        'description' => __( 'Add a new title for the Inspiry Payments Gateway that customers will see when they are in the checkout page.', 'inspiry-pay-woo')
                    ),
                    'description' => array(
                        'title' => __( 'Inspiry Payments Gateway Description', 'inspiry-pay-woo'),
                        'type' => 'textarea',
                        'default' => __( 'Please remit your payment to the shop to allow for the delivery to be made', 'inspiry-pay-woo'),
                        'desc_tip' => true,
                        'description' => __( 'Add a new title for the Inspiry Payments Gateway that customers will see when they are in the checkout page.', 'inspiry-pay-woo')
                    ),
                    'instructions' => array(
                        'title' => __( 'Instructions', 'inspiry-pay-woo'),
                        'type' => 'textarea',
                        'default' => __( 'Default instructions', 'inspiry-pay-woo'),
                        'desc_tip' => true,
                        'description' => __( 'Instructions that will be added to the thank you page and odrer email', 'inspiry-pay-woo')
                    ),
                ));
            }

            public function payment_scripts(){
                  // https request to windcave to create a session 
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, "https://uat.windcave.com/api/v1/sessions");
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  
                  curl_setopt($ch, CURLOPT_POST, TRUE);
  
                  curl_setopt($ch, CURLOPT_POSTFIELDS, "{
                  \"type\": \"purchase\",
                  \"methods\": [
                      \"card\"
                  ],
                  \"amount\": \"1.03\",
                  \"currency\": \"NZD\",
                  \"callbackUrls\": {
                      \"approved\": \"https://localhost/success\",
                      \"declined\": \"https://localhost/failure\"
                  }
                  }");
  
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                  "Content-Type: application/json",
                  "Authorization: Basic SW5zcGlyeV9SZXN0OmI0NGFiMjZmOWFkNzIwNDQ4OTc0MGQ1YWM3NmE5YzE2ZDgzNDJmODUwYTRlYjQ1NTc1NmRiNDgyYjFiYWVjMjk="
                  ));
  
                  $response = curl_exec($ch);
                  $obj = json_decode($response);
  
                  curl_close($ch);
        
                  // for each loop to get seamless_hpp url 
                  foreach ($obj->links as $obj) {
                      if($obj->rel=== "seamless_hpp"){
                        $this->seamlessHpp =  $obj->href;
                      }
                  }
                  wp_enqueue_style('payment-gateway-style', plugins_url('/style.css', __FILE__ ) );

                    // let's suppose it is our payment processor JavaScript that allows to obtain a token
                    wp_enqueue_script( 'windcave_js', 'https://dev.windcave.com/js/windcavepayments-seamless-v1.js' );

                    // and this is our custom JS in your plugin directory that works with token.js
                    wp_register_script( 'woocommerce_inspiry', plugins_url( 'iFrame.js', __FILE__ ), array( 'jquery', 'windcave_js' ) );

                    // in most payment processors you have to use PUBLIC KEY to obtain a token
                    wp_localize_script( 'woocommerce_inspiry', 'inspiry_params', array(
                        'seamlessHpp' => $this->seamlessHpp
                    ) );

                    wp_enqueue_script( 'woocommerce_inspiry' );
                    // prepare iFrame 
                  

            }
          
            //    payment fields - add iframe here
            public function payment_fields() {
              
                ?>
                <script>

WindcavePayments.Seamless.prepareIframe({
    url: "<?php echo $this->seamlessHpp; ?>",
    containerId: "payment-iframe-container",
    loadTimeout: 30,
    width: 400,
    height: 500,
    onProcessed: function () { console.log('iframes is loaded properly ') },
    onError: function (error) {
        console.log(error)
        console.log('this is and error event after loading ')
    }
});
</script> 
<?php 
            }

            // process payments 
            public function process_payments($order_id){ 
                ?>
               
                
                <?php 
                global $woocommerce;
                $order = wc_get_order($order_id); 
                $order->update_status('on-hold', __('Awaiting Inspiry Payment', 'inspiry-pay-woo') );
                $order->reduce_order_stock(); 

                WC()->cart->empty_cart();

                return array(
                    'result'=>'success', 
                    'redirect' => $this->get_return_url($order)
                );
            } 

             
            public function thank_you_page(){
                if( $this->instructions ){
                    echo wpautop( $this->instructions );
                }
            }
            public function windcave_iFrame(){
                  
            }
         

            public function place_order_button(){
                ?>
                
                <?php
                
            }

        }

    }
}

add_filter('woocommerce_payment_gateways', 'add_to_inspiry_payment_gateway'); 

function add_to_inspiry_payment_gateway($gateways) {
    $gateways[]= 'Inspiry_Payment_Gateway';
    return $gateways; 
}