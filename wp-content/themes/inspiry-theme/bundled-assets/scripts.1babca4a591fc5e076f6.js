!function(e){function t(t){for(var a,n,i=t[0],c=t[1],l=t[2],u=0,h=[];u<i.length;u++)n=i[u],Object.prototype.hasOwnProperty.call(s,n)&&s[n]&&h.push(s[n][0]),s[n]=0;for(a in c)Object.prototype.hasOwnProperty.call(c,a)&&(e[a]=c[a]);for(d&&d(t);h.length;)h.shift()();return r.push.apply(r,l||[]),o()}function o(){for(var e,t=0;t<r.length;t++){for(var o=r[t],a=!0,i=1;i<o.length;i++){var c=o[i];0!==s[c]&&(a=!1)}a&&(r.splice(t--,1),e=n(n.s=o[0]))}return e}var a={},s={0:0},r=[];function n(t){if(a[t])return a[t].exports;var o=a[t]={i:t,l:!1,exports:{}};return e[t].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=a,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(o,a,function(t){return e[t]}.bind(null,a));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/wp-content/themes/inspiry-theme/bundled-assets/";var i=window.webpackJsonp=window.webpackJsonp||[],c=i.push.bind(i);i.push=t,i=i.slice();for(var l=0;l<i.length;l++)t(i[l]);var d=c;r.push([3,1]),o()}([function(e,t,o){},,,function(e,t,o){"use strict";o.r(t);o(0),o(1),o(2);let a=jQuery;var s=class{constructor(){this.aClick=document.querySelectorAll(".bc-wish-list-item-anchor"),this.createBtn=document.querySelector(".bc-wish-list-btn--new"),this.wishListIcon=document.querySelectorAll(".wish-list-icon-container .fa-heart"),this.closeIcon=a(".bc-pdp-wish-lists .fa-times"),this.events()}events(){this.aClick.forEach(e=>{e.addEventListener("click",this.runAjax.bind(this))}),a(document).on("click",".wish-list-icon-container .fa-heart",this.showListContainer),this.closeIcon.on("click",this.hideContainer)}hideContainer(e){a(e.target).closest(".overlay").hide(300)}showListContainer(e){console.log("whish list"),a(e.target).find(".overlay").show(300),a(e.target).find(".bc-pdp-wish-lists").show(300)}runAjax(e){e.preventDefault();let t=e.path[0].href;var o=new XMLHttpRequest;o.open("GET",t,!0),document.querySelector(".loader-icon").style.display="inline-block",o.onload=function(){document.querySelector(".loader-icon").style.display="none",document.querySelector(".loader-confirmation").style.display="block",console.log("success")},document.querySelector(".loader-confirmation").style.display="none",o.send()}};let r=jQuery;var n=class{constructor(){this.events()}events(){r(".bc-single-product__warranty h1").append('<i class="fal fa-plus"></i>'),r(document).on("click",".bc-single-product__warranty i",this.showContentIcon),r(document).on("click",".bc-single-product__warranty h1",this.showContent)}showContent(e){r(e.target).closest("h1").next().slideToggle(300),r(e.target).closest("h1").siblings("ul").slideToggle(300),r(e.target).find("i").toggleClass("fa-plus"),r(e.target).find("i").toggleClass("fa-minus")}showContentIcon(e){console.log("worked !"),r(e.target).toggleClass("fa-plus"),r(e.target).toggleClass("fa-minus")}};var i=class{constructor(){this.show(),this.calc()}show(){const e=document.querySelector(".sizing-calculator-button"),t=document.querySelector(".calculator-overlay"),o=document.querySelector(".overlay-background"),a=document.querySelector(".close");e&&e.addEventListener("click",()=>{o.classList.add("overlay-background--visible"),t.classList.add("calculator-overlay--visible")}),a&&a.addEventListener("click",()=>{o.classList.remove("overlay-background--visible"),t.classList.remove("calculator-overlay--visible")})}calc(){var e=jQuery.noConflict(),t=t||{};t.CALCULATORMODULE={calculateNumberOfRolls:function(e,t,o,a,s){var r=100*a,n=100*t,i=100*e;console.log("calculateNumberOfRolls widthMeter",e),console.log("calculateNumberOfRolls heightMeter",t),console.log("calculateNumberOfRolls rollWidthCentiMeter",o),console.log("calculateNumberOfRolls rollHeightMeter",a),console.log("calculateNumberOfRolls rollPatternRepeatCentiMeter",s);var c=r/(n+s),l=c<0?Math.ceil(c):Math.floor(c),d=l*o,u=Math.round(i/d*1e4)/1e4;console.log("strips",l),console.log("stripWidth",d),console.log("numRolls",u),Math.ceil(u),console.log("numRolls",u);var h={numberOfRolls:u,numberOfRollsRoundedUp:Math.ceil(u)};return console.log("WV.MODULES.calculateNumberOfRolls result",h),h}},e(document).ready((function(o){e("#estimate-roll").click((function(a){a.preventDefault();var s=function(t){var a=e(t);if(console.log(a),""==a.val())return 0;var s=a.val(),r=parseFloat(s.replace(",","."));return o.isNumeric(r)?(a.parent().addClass("has-success"),a.parent().removeClass("has-error")):(a.parent().removeClass("has-success"),a.parent().addClass("has-error")),r};let r=s("#calc-roll-width"),n=s("#calc-roll-height"),i=s("#calc-pattern-repeat"),c=0;for(let e=1;e<=4;e++){let o=s("#calc-wall-width"+e),a=s("#calc-wall-height"+e),l=t.CALCULATORMODULE.calculateNumberOfRolls(o,a,r,n,i);console.log("wall"+e+" "+l.numberOfRolls),c+=l.numberOfRolls,console.log("roll total "+e+" - "+c)}console.log("roll total "+c),c.numberOfRollsRoundedUp<=1?(e(".suffix-singular").show(),e(".suffix-plural").hide()):(e(".suffix-singular").hide(),e(".suffix-plural").show()),e(".calc-round").html(Math.ceil(c))}))}))}};var c=class{constructor(){this.laybuyBtn=document.querySelector(".lay-buy-open"),this.laybuyCloseBtn=document.querySelector(".close-laybuy"),this.events()}events(){this.laybuyBtn&&this.laybuyBtn.addEventListener("click",this.openLaybuy),this.laybuyCloseBtn&&this.laybuyCloseBtn.addEventListener("click",this.closeLaybuy)}openLaybuy(){console.log("laybuy clicked"),document.getElementById("laybuy-popup").style.display="flex"}closeLaybuy(){document.getElementById("laybuy-popup").style.display="none"}};let l=jQuery;var d=class{constructor(){this.header=document.querySelector(".trade-nav-container .nav"),this.listItems=document.getElementsByClassName("trade-nav-link"),this.current=document.getElementsByClassName("active-nav"),this.tradeNavLink=document.querySelectorAll(".trade-nav-link"),this.events()}events(){this.tradeNavLink.forEach(e=>{e.addEventListener("click",this.nav.bind(this))})}activeNav(){this.current[0].className=current[0].className.replace(" active-nav",""),this.className+=" active-nav"}nav(e){console.log(this.tradeNavLink),l(".trade-nav-link").removeClass("active-nav"),l(e.target).addClass("active-nav"),"Profile"==e.target.innerHTML?(document.querySelector(".trade-about-nav-content").style.display="block",document.querySelector(".trade-contact-nav-content").style.display="none",document.querySelector(".trade-project-nav-content").style.display="none",document.querySelector(".trade-gallery-nav-content").style.display="none"):"Contact"==e.target.innerHTML?(document.querySelector(".trade-about-nav-content").style.display="none",document.querySelector(".trade-project-nav-content").style.display="none",document.querySelector(".trade-contact-nav-content").style.display="block",document.querySelector(".trade-gallery-nav-content").style.display="none"):"Projects"==e.target.innerHTML?(document.querySelector(".trade-about-nav-content").style.display="none",document.querySelector(".trade-contact-nav-content").style.display="none",document.querySelector(".trade-project-nav-content").style.display="block",document.querySelector(".trade-gallery-nav-content").style.display="none"):"Gallery"==e.target.innerHTML&&(document.querySelector(".trade-about-nav-content").style.display="none",document.querySelector(".trade-contact-nav-content").style.display="none",document.querySelector(".trade-project-nav-content").style.display="none",document.querySelector(".trade-gallery-nav-content").style.display="block")}};let u=jQuery;var h=class{constructor(){this.events()}events(){u('.tgl input[type="checkbox"]').each((function(e){u(this).on("click",(function(){u(this).is(":checked")?(console.log("toggle working"),u(".toggle-status").html('<i class="fal fa-lock"></i>  Private'),u(".toggle-status-info").html("Private boards cannot be shared with the general public.")):(u(".toggle-status").html('<i class="fal fa-lock-open"></i> Public'),u(".toggle-status-info").html(" Public boards can be shared with the general public."))}))})),u(".board-card").mouseenter(this.showOptionIcon.bind(this)),u(".board-card").mouseleave(this.hideOptionIcon.bind(this)),u(".board-card .option-icon").on("click",this.showOptions.bind(this)),u(document).mouseup(this.hideOptionContainer.bind(this)),u(".board-card-archive .option-icon").on("click",this.showOptionsArchive.bind(this)),u(document).mouseup(this.hideOptionContainerArchive.bind(this)),u(".board-card-archive").mouseenter(this.showOptionIconArchive.bind(this)),u(".board-card-archive").mouseleave(this.hideOptionIconArchive.bind(this))}hideOptionContainer(e){var t=u(".pin-options-container");t.is(e.target)||0!==t.has(e.target).length||t.hide(300)}showOptions(e){u(e.target).closest(".board-card").find(".pin-options-container").show(300)}hideOptionContainerArchive(e){var t=u(".pin-options-container");t.is(e.target)||0!==t.has(e.target).length||t.hide(300)}showOptionsArchive(e){u(e.target).closest(".board-card-archive").find(".pin-options-container").show(300)}showOptionIcon(e){e.preventDefault(),u(e.target).closest(".board-card").find(".option-icon").show()}hideOptionIcon(e){e.preventDefault(),u(e.target).closest(".board-card").find(".option-icon").hide()}showOptionIconArchive(e){console.log("hover"),u(e.target).closest(".board-card-archive").find(".option-icon").show()}hideOptionIconArchive(e){e.preventDefault(),u(e.target).closest(".board-card-archive").find(".option-icon").hide()}};let p=jQuery;var v=class{constructor(){this.plusBtn=document.querySelectorAll(".design-board-save-btn-container .open-board-container"),this.boardListItems=p(".choose-board-container .board-list li"),this.checkboxInput=p('.tgl input[type="checkbox"]'),this.events()}events(){p(document).on("click",".design-board-save-btn-container .open-board-container",this.showChooseBoardContainer),p(document).on("click",".choose-board-container .close-icon",this.hideChooseBoardContainer),p(document).on("click",".choose-board-container .create-new-board",this.showForm),p(document).on("click",".project-save-form-section .cancel-btn",this.hideForm),p(document).on("click",".project-save-form-section .save-btn",this.createBoardFunc),p(document).on("click",".choose-board-container .board-list li",this.addToBoard),p(document).on("click",".board-card .delete-btn",this.deletePin),p(document).on("click",".board-card-archive .delete-board-btn",this.deleteBoard),p(document).on("click",".bc-quickview-trigger--hover-label",this.showIconQuickView),p(".bc-product-card").hover(this.showPinIconOnHover,this.hidePinIconOnMouseOut),p(document).on("click",".board-archive .create-board",this.showCreateBoardArchive),p(".board-archive .archive-save-btn").on("click",this.createBoardArchive),p(document).on("click",".board-archive .edit-board",this.showUpdateArchive),p(".archive-update-btn").on("click",this.updateBoardArchive)}showUpdateArchive(e){let t=p(e.target).attr("data-pinid");console.log(t),p(".project-update").attr("data-postid",t),p(".project-update").show(300),p(".project-update-overlay").show(300),p(document).on("click",".board-archive .cancel-btns",e=>{p(".board-archive  .project-update").hide(300),p(".board-archive .overlay").hide(300),p(".board-archive  .project-update input").val("Waiting..."),p("#update-board-description").val("Waiting...")}),p.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/board",type:"POST",data:{id:t},complete:()=>{p(".project-save-form-section .loader").hide()},success:e=>{console.log(e),p("#update-board-name").val(e[0].title),p("#update-board-description").val(e[0].description),"private"==e[0].status?(p("#update-status").prop("checked",!0),p(".toggle-status").html('<i class="fal fa-lock"></i>  Private'),p(".toggle-status-info").html("Private boards cannot be shared with the general public.")):(p("#update-status").prop("checked",!1),p(".toggle-status").html('<i class="fal fa-lock-open"></i> Public'),p(".toggle-status-info").html(" Public boards can be shared with the general public."))},error:e=>{console.log(e)}})}showCreateBoardArchive(e){p(".board-archive .project-save-form-section").show(300),p(".board-archive .board-overlay").show(300),p(document).on("click",".board-archive .cancel-btns",e=>{p(".board-archive  .project-save-form-section").hide(300),p(".board-archive .overlay").hide(300)})}updateBoardArchive(e){console.log("starting request");let t,o=p(".project-update").attr("data-postid"),a=p("#update-board-name").val(),s=p("#update-board-description").val();t=p('.project-update .tgl input[type="checkbox"]').is(":checked")?"private":"publish",console.log("this  is a status check"+t),console.log(a+s+t+o),e.preventDefault(),p(".project-save-form-section .loader").show(),p.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/updateBoard",type:"POST",data:{"board-id":o,"board-name":a,"board-description":s,status:t},complete:()=>{p(".project-save-form-section .loader").hide()},success:e=>{console.log(e),e&&(console.log(e),location.reload(),p(".project-save-form-section").hide())},error:e=>{console.log("this is a board error"),console.log(e),console.log(e.responseText),p("#new-board-form-update").before(` <div class="error-bg">${e.responseText}</div>`)}})}createBoardArchive(e){let t;console.log("sending a request"),t=p('.board-archive .tgl input[type="checkbox"]').is(":checked")?"private":"publish",console.log("this  is a status check"+t);let o,a=p(e.target).closest(".btn-container").siblings("#board-name-archive").val();p(e.target).closest(".btn-container").siblings("#board-description-archive").val()?o=p(e.target).closest(".btn-container").siblings("#board-description-archive").val():console.log("no description"),e.preventDefault(),p(".project-save-form-section .loader").show(),p.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/manageBoard",type:"POST",data:{"board-name":a,"board-description":o,status:t},complete:()=>{p(".project-save-form-section .loader").hide()},success:e=>{console.log(e),e&&(console.log(e),location.reload(),p(".board-archive  .project-save-form-section").hide(300),p(".board-archive .overlay").hide(300),p(".choose-board-container .board-list").append(`<li data-board-id=${e}>${a}</li>`),p(".project-save-form-section").hide())},error:e=>{console.log("this is a board error"),console.log(e),console.log(e.responseText),p("#new-board-form-archive").before(` <div class="error-bg">${e.responseText}</div>`)}})}toggleBtnProcessor(e){e.preventDefault(),console.log("this button is working"),console.log(p('.tgl input[type="checkbox"]').val())}showPinIconOnHover(e){p(e.target).closest(".bc-product-card").find(".design-board-save-btn-container").css("opacity",1)}hidePinIconOnMouseOut(e){p(e.target).closest(".bc-product-card").find(".design-board-save-btn-container").css("opacity",0)}showIconQuickView(e){console.log("working"),console.log(p(e.target).closest(".bc-quickview-trigger").siblings(".bc-product__meta").find(".open-board-container"));p(e.target).closest(".bc-quickview-trigger").siblings(".bc-product__meta").find(".design-board-save-btn-container")}showChooseBoardContainer(e){p(".bc-product__title").attr("data-archive");let t,o,a=p(e.target).closest(".design-board-save-btn-container").attr("data-tracking-data");a=JSON.parse(a),t=a.post_id,o=a.name,p(".choose-board-container").show(300),p(".board-overlay").show(300);p(".choose-board-container").attr("data-post-id",t),p(".choose-board-container").attr("data-post-title",o)}hideChooseBoardContainer(){p(".choose-board-container").hide(300),p(".overlay").hide(300)}showForm(){console.log("create form"),p(".project-save-form-section").show()}hideForm(){p(".project-save-form-section").hide()}addToBoard(e){let t=p(e.target).attr("data-boardid"),o=p(e.target).attr("data-postStatus"),a=p(".choose-board-container").attr("data-post-id"),s=p(".choose-board-container").attr("data-post-title");p(e.target).closest(".board-list-item").find(".loader").addClass("loader--visible"),p.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/addToBoard",type:"POST",data:{"board-id":t,"post-id":a,"post-title":s,status:o},complete:()=>{p(e.target).closest(".board-list-item").find(".loader").removeClass("loader--visible")},success:e=>{console.log("this is a success area"),e&&(console.log(e),p(".project-detail-page .design-board-save-btn-container i").attr("data-exists","yes"))},error:t=>{console.log("this is an error"),console.log(t),p(e.target).closest(".board-list-item").find(".loader").removeClass("loader--visible")}})}deleteBoard(e){let t=p(e.target).attr("data-pinid");console.log(t),p(e.target).html('<div class="loader" style="display:block;"></div> '),p.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/deleteBoard",data:{"board-id":t},type:"DELETE",success:t=>{console.log("this is a success area"),t&&(console.log(t),p(e.target).closest(".board-card-archive").remove())},error:e=>{console.log("this is an error"),console.log(e)}})}deletePin(e){console.log("delete is working");let t=p(e.target).attr("data-pinid");p(e.target).html('<div class="loader" style="display:block;"></div> '),p.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/manageBoard",data:{"pin-id":t},type:"DELETE",success:t=>{console.log("this is a success area"),t&&(console.log(t),p(e.target).closest(".board-card").remove())},error:e=>{console.log("this is an error"),console.log(e)}})}createBoardFunc(e){let t;t=p('.tgl input[type="checkbox"]').is(":checked")?"private":"publish",console.log("this  is a status check"+t);let o,a=p(e.target).closest(".btn-container").siblings("#board-name").val();p(e.target).closest(".btn-container").siblings("#board-description").val()?o=p(e.target).closest(".btn-container").siblings("#board-description").val():console.log("no description"),e.preventDefault(),p(".project-save-form-section .loader").show(),p.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/manageBoard",type:"POST",data:{"board-name":a,"board-description":o,status:t},complete:()=>{p(".project-save-form-section .loader").hide()},success:e=>{if(console.log(e),e){console.log(e),location.reload(),p(".choose-board-container .board-list").append(`<li data-board-id=${e}>${a}</li>`),p(".project-save-form-section").hide(),function(){let o=p(".choose-board-container").attr("data-post-id"),a=p(".choose-board-container").attr("data-post-title");p.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/addToBoard",type:"POST",data:{"board-id":e,"post-id":o,"post-title":a,status:t},success:e=>{console.log("this is a success area"),e&&"product-archive"==p("body").attr("data-archive")&&(p(".choose-board-container").hide(300),p(".overlay").hide(300),location.reload())},error:e=>{console.log(e)}})}()}},error:e=>{console.log("this is a board error"),console.log(e),console.log(e.responseText),p("#new-board-form").before(` <div class="error-bg">${e.responseText}</div>`)}})}};jQuery;jQuery;jQuery;var b=class{constructor(){this.events()}events(){}};let g=jQuery;var y=class{constructor(){this.events()}events(){g(".login-tag").on("click",this.showLogInForm)}showLogInForm(e){e.preventDefault();let t=g(e.target).attr("data-root-url")+"/ajax-log-in/";console.log(t);var o=new XMLHttpRequest;o.open("GET",t,!0),g(e.target).closest("a").html('<div class="loader-div" style="display:block"></div>'),e.target.querySelector(".loader-div").classList.add("loader-icon"),o.onload=function(){g(".login-overlay").show(300),g(e.target).closest("a").html("LOGIN / REGISTER"),g(".form-content").append(this.responseText),g(".login-overlay .fa-times").on("click",()=>{g(".login-overlay").hide(300),g(".form-content").html("")})},o.send()}};let m=jQuery;var f=class{constructor(){this.events()}events(){m(".featured-project-section .flex .card").hover(e=>{console.log("hover"),console.log(e.target),m(e.target).css("opacity","60%"),m(e.target).siblings(".featured-project-section .flex .column-s-font").show(300)},e=>{m(e.target).css("opacity","0"),m(e.target).siblings(".featured-project-section .flex .column-s-font").hide(300)})}};let w=jQuery;var k=class{constructor(){this.events()}events(){let e=[];w(".trade-directory .main-cards .flex .card").hover(this.showElements,this.hideElements),e=w(document).find(".trade-directory .main-cards .flex .card .logo img").attr("data-src")}showElements(e){w(e.target).closest(".card").find(".website-link").css("opacity","1"),w(e.target).closest(".card").find(".design-board-save-btn-container").css("opacity","1")}hideElements(e){w(e.target).closest(".card").find(".website-link").css("opacity","0"),w(e.target).closest(".card").find(".design-board-save-btn-container").css("opacity","0")}};let j=jQuery;var C=class{constructor(){this.events()}events(){j("#top-navbar a").mouseover(this.showSubNav)}showSubNav(e){"Design Services"==j(e.target).html()&&(j(".design-services").show(300),j("body > *").not(e.target).closest(".top-navbar").mouseout(()=>{j(".design-services").hide(1e3)}))}hideSubnav(e){j(".design-services").hide(1e3)}};let O=jQuery;var S=class{constructor(){this.events()}events(){O(document).on("submit",".trade-directory .geodir-listing-search",this.ajaxCall)}ajaxCall(e){var t=new XMLHttpRequest;t.open("GET","http://localhost/inspiry/search/?geodir_search=1&stype=gd_place&s=+&snear=&spost_category%5B%5D=118&sregions_covered%5B%5D=Auckland&spackage_id=&sgeo_lat=&sgeo_lon=",!0),t.onload=function(){},t.send()}};let x=jQuery;var q=class{constructor(){this.button=x(".inspiry-blogs .fourth-section .nav-buttons button"),this.events()}events(){this.button.on("click",this.showProducts)}showProducts(e){let t=x(e.target).html();console.log(t),"Furniture"==t?(x(e.target).siblings().removeClass("button-border"),x(e.target).addClass("button-border"),x(e.target).closest(".flex-container").find(".flex").removeClass("--visible-flex"),x(e.target).closest(".flex-container").find(".furniture").addClass("--visible-flex")):"Wallpaper"==t?(x(e.target).siblings().removeClass("button-border"),x(e.target).addClass("button-border"),x(e.target).closest(".flex-container").find(".flex").removeClass("--visible-flex"),x(e.target).closest(".flex-container").find(".wallpaper").addClass("--visible-flex")):"Homeware"==t&&(x(e.target).siblings().removeClass("button-border"),x(e.target).addClass("button-border"),x(e.target).closest(".flex-container").find(".flex").removeClass("--visible-flex"),x(e.target).closest(".flex-container").find(".homeware").addClass("--visible-flex"))}};let P=jQuery;var L=class{constructor(){P(".design-board-save-btn-container").append('\n                <div class="tooltips roboto-font font-s-regular box-shadow">\n                    Save to design board\n                </div>'),this.events()}events(){P(".design-board-save-btn-container i").hover(this.showTooltip,this.hideTooltip)}showTooltip(e){P(e.target).siblings(".tooltips").slideDown("200"),console.log(23)}hideTooltip(e){P(".tooltips").hide()}};let T=jQuery;var _=class{constructor(){this.events()}events(){T(".action-btn-container .share").on("click",()=>{T(".action-btn-container .share-icons").show()}),T(".action-btn-container .share-icons .fa-times").on("click",()=>{T(".action-btn-container .share-icons").hide()}),T(".single-board .board-card .share-btn").on("click",this.showCardShareContainer.bind(this))}showCardShareContainer(e){T(e.target).closest(".pin-options-container").siblings(".share-icon-container").show(),T(e.target).closest(".pin-options-container").siblings(".share-icon-container").find(".close-icon").on("click",()=>{T(".share-icon-container").hide()})}};jQuery;var E=class{constructor(){this.events()}events(){}};const N=jQuery;var D=class{constructor(){this.events()}events(){N(".img-upload").on("click",this.showContainer),N(".image-upload-container .cancel-btn").on("click",()=>{N(".image-upload-container .project-save-form-container").hide(),N(".overlay").hide()}),N("#upload-image").submit(this.imageProcessor)}showContainer(e){N(".image-upload-container .project-save-form-container").show(),N(".overlay").show()}imageProcessor(e){e.preventDefault();let t={action:N("#action").val(),my_file_field:N("#image").prop("files")[0]};console.log(t);var o=new FormData;o.append("my_file_field",t.my_file_field),o.append("action","my_file_upload"),jQuery.ajax({url:"http://localhost/inspiry/wp-admin/admin-ajax.php",type:"post",contentType:!1,processData:!1,data:o,success:function(t){console.log(t);let o=N(".image-upload-container").attr("data-parentid"),a=N(".single-board").attr("data-poststatus"),s=t.slice(0,-1);N(e.target).closest(".board-list-item").find(".loader").addClass("loader--visible"),N.ajax({beforeSend:e=>{e.setRequestHeader("X-WP-NONCE",inspiryData.nonce)},url:inspiryData.root_url+"/wp-json/inspiry/v1/addToBoard",type:"POST",data:{"board-id":o,"post-image-id":s,status:a},complete:()=>{N(e.target).closest(".board-list-item").find(".loader").removeClass("loader--visible")},success:e=>{console.log("this is a success area"),e&&(console.log(e),location.reload())},error:t=>{console.log("this is an error"),console.log(t),N(e.target).closest(".board-list-item").find(".loader").removeClass("loader--visible")}})},error:function(e){console.log(e)}})}};let B=jQuery;setTimeout((function(){B(".flex-control-thumbs").addClass("owl-carousel"),B(".owl-carousel").owlCarousel({loop:!1,margin:10,nav:!0,responsive:{0:{items:3},600:{items:3},1e3:{items:4}}})}),300),window.onload=function(){new E,new D,new q,new S,new C,new k,new f,new h,new v,new _,new d,new L;document.getElementsByClassName("bc-show-current-price");console.log(B(".bc-show-current-price").text),B(".logo-container .slogan").css("opacity","1"),B(".profile-name-value").click((function(e){let t=document.querySelector(".profile-name-value").innerHTML;console.log("click working"),t.includes("LOGIN / REGISTER")?console.log("Log In"):(e.preventDefault(),B(".my-account-nav").slideToggle(200,(function(){B(".arrow-icon").toggleClass("fa-chevron-up")})))}))};new y,new b,new s,new n,new i,new c}]);