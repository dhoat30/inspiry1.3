import OwlCarousel from './OwlCarousel';

class EveryOwlCarousel {
    constructor() {
        this.events();
    }
    events() {
        this.trendingCarousel();
        this.brandLogoHomePageCarousel();
    }
    brandLogoHomePageCarousel() {

        // owl carousel 
        let className = '.brand-logo-section .owl-carousel';
        let args = {
            loop: true,
            margin: 20,
            lazyLoad: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsiveBaseElement: ".row-container",
            responsiveClass: true,
            rewind: true,
            responsive: {
                0: {
                    items: 1,

                    dots: true
                },
                600: {
                    items: 2,

                    dots: true
                },
                900: {
                    items: 3,

                    dots: true
                },
                1200: {
                    items: 3,
                    dots: true
                },
                1500: {
                    items: 4,
                    dots: true
                }
            }
        }
        const trendingNow = new OwlCarousel(args, className);
    }
    trendingCarousel() {

        // owl carousel 
        let className = '.trending-section .owl-carousel';
        let args = {
            loop: true,
            margin: 20,

            lazyLoad: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsiveBaseElement: ".row-container",
            responsiveClass: true,
            rewind: true,
            responsive: {
                0: {
                    items: 1,

                    dots: true
                },
                600: {
                    items: 2,

                    dots: true
                },
                900: {
                    items: 3,

                    dots: true
                },
                1200: {
                    items: 4,
                    dots: true
                }
            }
        }
        const trendingNow = new OwlCarousel(args, className);
    }
}
export default EveryOwlCarousel;