const $ = jQuery;

class PopUpCart {
    constructor(){
        
        this.events(); 
    }

    events(){
        $('.header .shopping-cart a').on('click', this.openCart)
        $('.cart-popup-container .fa-times').on('click', this.closeCart)
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
}

export default PopUpCart; 