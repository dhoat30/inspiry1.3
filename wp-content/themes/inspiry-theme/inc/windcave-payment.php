<?php




    if(class_exists('WC_Payment_Gateway')){
        class Inspiry_Payment_Gateway extends WC_Payment_Gateway {

            // constructor function 
            public function __construct()
            {   
                $this->seamlessHpp = ''; 
                $this->id = "inspiry_payment"; 
                // $this->icon = apply_filters( 'woocommerce_inspiry_icon', "http://localhost/inspiry/wp-content/uploads/2021/05/Inspiry_Logo-transparent-1-300x55-1.png" );
                $this->has_fields = false; 
                $this->method_title = __('Windcave Payment', 'inspiry-pay-woo'); 
                $this->method_description =  __('Pay with your Credit or Debit Card via Windcave.', 'inspiry-pay-woo'); 

                $this->title = $this->get_option( 'title' );
                $this->description = $this->get_option( 'description' );
                $this->instructions = $this->get_option( 'instructions', $this->description );

                // getting seamlessHpp url 
                $this->payment_scripts();

                // preparing windcave iFram
                // $this->windcave_iFrame(); 

                $this->payment_fields();

                $this->init_form_fields();
                $this->init_settings();
                $this->process_payments();
                // $this->place_order_button(); 

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

            // getting seamlessHpp url from windcave
            public function payment_scripts(){
       
              

            
            }

            // loading iFrame
            public function windcave_iFrame(){
              
            }
          
            //    payment fields - add iframe here
            public function payment_fields() {
                
                
            }

                // process payments 
                public function process_payments(){ 

                    // // rest route action
                    // add_action("rest_api_init", "woocommerce_transaction");

                    // // register rest route
                    // function woocommerce_transaction(){ 
                    
                    // //update board 
                    // register_rest_route("inspiry/v1/", "transaction", array(
                    // "methods" => "POST",
                    // "callback" => "query_session"
                    // ));
                    // }

                    function query_session($data){
                    $submitted = sanitize_text_field($data["submitted"] ); 
                    return "this is from a query session"; 
                    }
                    
                    
                    // global $woocommerce;
                    // $order = wc_get_order($order_id); 
                    // $order->update_status('on-hold', __('Awaiting Inspiry Payment', 'inspiry-pay-woo') );
                    // $order->reduce_order_stock(); 

                    // WC()->cart->empty_cart();

                    // return array(
                    //     'result'=>'success', 
                    //     'redirect' => $this->get_return_url($order)
                    // );
                } 

                
                public function thank_you_page(){
                    if( $this->instructions ){
                        echo wpautop( $this->instructions );
                    }
                }
          

        }

    }

add_filter('woocommerce_payment_gateways', 'add_to_inspiry_payment_gateway'); 

function add_to_inspiry_payment_gateway($gateways) {
    $gateways[]= 'Inspiry_Payment_Gateway';
    return $gateways; 
}