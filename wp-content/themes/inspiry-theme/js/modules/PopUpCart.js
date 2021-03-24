const $ = jQuery;

class PopUpCart {
    constructor(){
        
        this.events(); 
    }

    events(){
        $('.header .shopping-cart a').on('click', this.openCart)
        $('.cart-popup-container .fa-times').on('click', this.closeCart)
        $( document ).on( 'click', '.single_add_to_cart_button', this.ajaxAddToCart)
    }

    openCart(event){
        event.preventDefault();
        $('.cart-popup-container').slideToggle('slow');
        $('.header .shopping-cart a i').toggleClass('fa-chevron-up');
    }
    closeCart(){
        $('.cart-popup-container').slideUp('slow')
        $('.header .shopping-cart a i').removeClass('fa-chevron-up');
    }

    ajaxAddToCart(e){
        e.preventDefault();
        let thisbutton = $(this),
                    $form = thisbutton.closest('form.cart'),
                    id = thisbutton.val(),
                    product_qty = $form.find('input[name=quantity]').val() || 1,
                    product_id = $form.find('input[name=product_id]').val() || id,
                    variation_id = $form.find('input[name=variation_id]').val() || 0;
    
                    var data = {
                        action: 'woocommerce_ajax_add_to_cart',
                        product_id: product_id,
                        product_sku: '',
                        quantity: product_qty,
                        variation_id: variation_id,
                    };
    
                    $(document.body).trigger('adding_to_cart', [thisbutton, data]);
                    $.ajax({
                        type: 'post',
                        url: wc_add_to_cart_params.ajax_url,
                        data: data,
                        beforeSend: function (response) {
                            thisbutton.removeClass('added').addClass('loading');
                        },
                        complete: function (response) {
                            thisbutton.addClass('added').removeClass('loading');
                            
                        },
                        success: function (response) {
                            console.log("these is a responses")
                           $('.cart-popup-container').slideDown();
                           setTimeout(function(){  $('.cart-popup-container').slideUp('slow');}, 3000);
                                  
                            if (response.error & response.product_url) {
                                window.location = response.product_url;
                                return;
                            } else {
                                console.log(  response.fragments);  
                              
                                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, thisbutton]);
                            }
                        },
                    });
    }
}

export default PopUpCart; 