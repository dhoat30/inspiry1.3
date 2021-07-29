<?php 

add_action('cart_modal', 'modal_html'); 

function modal_html(){
   
        
    echo '<div class="enquiry-form-section ">
    <div class="enquiry-modal-container">
        
        <div class="form-container">
            <i class="fal fa-times"></i>
            <div class="large-font-size regular center-align upper-case">
                Interested to know more? 
            </div>
            <div class="paragraph-font-size thin center-align roboto-font margin-elements">
                Please fill in the form and one of our design consultants will respond to your enquiry as quickly as possible.
            </div>
         
        </div>

        <div class="product-container beige-color-bc flex-center flex-column align-center">
           
        </div>
      
    </div>
   
</div>';
}