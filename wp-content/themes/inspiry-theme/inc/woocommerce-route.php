<?php
//routes

add_action("rest_api_init", "woocommerce_product");

function woocommerce_product(){ 
   
  //update board 
  register_rest_route("inspiry/v1/", "product", array(
   "methods" => "POST",
   "callback" => "getProduct"
));
 //update board 
 register_rest_route("inspiry/v1/", "querySession", array(
   "methods" => "POST",
   "callback" => "querySession"
   ));
}
   
   
function querySession($data){
   $submitted = $data["submitted"]; 
   $obj = array(
      'price'=> 10
   );
   return true; 
   }
   

function getProduct($data){
   $postID = sanitize_text_field($data["id"] ); 
   if(is_user_logged_in()){
      $boards = new WP_Query(array(
         'post_type' => 'product',
         'p' => 15033
      )); 
      
      $boardsResult = array(); 
   
      while($boards->have_posts()){
         $boards->the_post(); 
         global $product; 
         array_push($boardsResult, array(
            'price' =>  $product->get_price()
         )); 
      }
      return $boardsResult; 

   }
   
  
}
?>