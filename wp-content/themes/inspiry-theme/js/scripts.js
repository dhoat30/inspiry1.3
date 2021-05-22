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

// trade directory
import TradeDirectory from './modules/TradeDirectory';

// footer 

// owl carousel 
setTimeout(function () {
  $('.flex-control-thumbs').addClass('owl-carousel');
  $('.owl-carousel').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    responsive: {
      0: {
        items: 3
      },
      600: {
        items: 3
      },
      1000: {
        items: 4
      }
    }
  });
}, 300);

window.onload = function () {
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

  //trade directory page 
  const tradeDirectory = new TradeDirectory();

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
    eventListener: function () {
      $('.profile-name-value').click(function (e) {
        let user = document.querySelector('.profile-name-value').innerHTML;
        console.log("click working");
        if (user.includes('LOGIN / REGISTER')) {
          console.log('Log In');
        }
        else {
          e.preventDefault();
          $('.my-account-nav').slideToggle(200, function () {
            $('.arrow-icon').toggleClass('fa-chevron-up');
          });
        }
      })
    }
  }

  profileNavbar.eventListener();
}




//log in 
//const logIn = new LogIn();
//facet wp
const facetWp = new FacetWp();

//const wishlistAjaxBp = new WishlistAjaxBp();
const wishlistAjax = new WishlistAjax();
const warranty = new Warranty();
const wallpaperCalc = new WallpaperCalc();
const laybuy = new LayBuy();


// typewriter effect
document.addEventListener('DOMContentLoaded', function (event) {
  // array with texts to type in typewriter
  // get json array from a title on a web page
  let jsonArray = $('.typewriter-query-container div').attr('data-title');
  let dataText = JSON.parse(jsonArray);


  // type one text in the typwriter
  // keeps calling itself until the text is finished
  function typeWriter(text, i, fnCallback) {
    // chekc if text isn't finished yet
    if (i < (text.length)) {
      // add next character to h1
      document.querySelector("h1").innerHTML = text.substring(0, i + 1) + '<span aria-hidden="true"></span>';

      // wait for a while and call this function again for next character
      setTimeout(function () {
        typeWriter(text, i + 1, fnCallback)
      }, 100);
    }
    // text finished, call callback if there is a callback function
    else if (typeof fnCallback == 'function') {
      // call callback after timeout
      setTimeout(fnCallback, 700);
    }
  }
  // start a typewriter animation for a text in the dataText array
  function StartTextAnimation(i) {
    if (typeof dataText[i] == 'undefined') {
      setTimeout(function () {
        StartTextAnimation(0);
      }, 1000);
    }
    // check if dataText[i] exists
    if (i < dataText[i].length) {
      // text exists! start typewriter animation
      typeWriter(dataText[i], 0, function () {
        // after callback (and whole text has been animated), start next text
        StartTextAnimation(i + 1);
      });
    }
  }
  // start the text animation
  StartTextAnimation(0);
});


let myID = document.getElementById("go-to-header");

var myScrollFunc = function () {
  console.log('hello tis is a scroll ')
  var y = window.scrollY;
  if (y >= 1200) {
    console.log('scrolled to 800')
    myID.classList.add("show");
  } else if (y <= 1200) {
    myID.classList.remove("show");
  }
};

window.addEventListener("scroll", myScrollFunc);