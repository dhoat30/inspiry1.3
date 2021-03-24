import '../style.css';
let $ = jQuery;

import 'owl.carousel/dist/assets/owl.carousel.css';
import 'owl.carousel';

import WishlistAjax from './modules/WishlistAjax';
import Warranty from './modules/Warranty';
import WallpaperCalc from './modules/WallpaperCalc';
import LayBuy from './modules/LayBuy';
import TradeNav from './modules/TradeNav';
import DesignBoard from './modules/DesignBoard';
import DesignBoardSaveBtn from './modules/DesignBoardSaveBtn';
import DesignBoardAjax from './modules/DesignBoardAjax';
import WishlistAjaxBp from './modules/WishlistAjaxBp';
import FacetWp from './modules/FacetWp';
//import LogIn from './modules/LogIn';
import Overlay from './modules/overlay';
import LocationPage from './modules/LocationPage';
import TopNav from './modules/TopNav';
import GeoTradeSearch from './modules/GeoTradeSearch';
import ShopFav from './modules/ShopFav';
import ToolTip from './modules/ToolTip';
import SingleDesignBoard from './modules/SingleDesignBoard';

import WooAccount from './modules/WooAccount'; 
//image upload 
import ImageUpload from './modules/ImageUpload';
import PopUpCart from './modules/PopUpCart'; 


setTimeout(function(){
    $('.flex-control-thumbs').addClass('owl-carousel');
    $('.owl-carousel').owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:3
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
  }, 300);

window.onload = function() {
    //account 
    const wooAccount = new WooAccount(); 

    const imageUpload = new ImageUpload();
    const shopFav = new ShopFav();
    const geoTradeSearch = new GeoTradeSearch();
    const topnav = new TopNav();
    const locationPage = new LocationPage();
    const overlay = new Overlay();
    const designBoardSinglePage = new DesignBoard();
    const designBoardSaveBtn = new DesignBoardSaveBtn();
    const singleDesignBoard = new SingleDesignBoard();
    const popUpCart = new PopUpCart();

    //let designBoardAjax = new DesignBoardAjax(); 

    const tradeNav = new TradeNav();

    //Tool tip 
    const toolTip = new ToolTip();

    //price 
    let pricevalue = document.getElementsByClassName('bc-show-current-price');
    console.log($('.bc-show-current-price').text);
    //slogan 

    $('.logo-container .slogan').css('opacity', '1');


    //profile navbar


    let profileNavbar = {
        eventListener: function() {
            $('.profile-name-value').click(function(e) {
                let user = document.querySelector('.profile-name-value').innerHTML;
                console.log("click working");
                if (user.includes('LOGIN / REGISTER')) {
                    console.log('Log In');
                } 
                else {
                    e.preventDefault();
                    $('.my-account-nav').slideToggle(200, function() {
                        $('.arrow-icon').toggleClass('fa-chevron-up');
                    });
                }
            })
        }
    }

    profileNavbar.eventListener();
}


    $( document ).on( 'click', '.single_add_to_cart_button', function(e) {
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
                        $('.cart-popup-container').show();
                    },
                    success: function (response) {
                        console.log("these is a responses")
                       // $('.cart-popup-container').show();
                        //setTimeout(function(){  $('.cart-popup-container').slideUp('slow');}, 3000);
                              
                        if (response.error & response.product_url) {
                            window.location = response.product_url;
                            return;
                        } else {
                            console.log(  response.fragments);  
                          
                            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, thisbutton]);
                        }
                    },
                });
    });

//log in 
//const logIn = new LogIn();
//facet wp
const facetWp = new FacetWp();

//const wishlistAjaxBp = new WishlistAjaxBp();
const wishlistAjax = new WishlistAjax();
const warranty = new Warranty();
const wallpaperCalc = new WallpaperCalc();
const laybuy = new LayBuy();