(function($) {

    'use strict';

    $(document).ready(function() {


        /* 
        =============================
        = Init retina js  
        ================================
        */


        retinajs();


         /* 
        =============================
        = Init retina js  
        ================================
        */
        

        $('select').niceSelect();


        /* 
         =============================
         = Init primary navigation  
         ================================
         */


        var primary_nav = $('#main-menu');

        primary_nav.stellarNav({



            theme: 'plain',

            breakpoint: 1050,

            closeBtn: true,

            menuLabel: 'Menu',

            scrollbarFix: false,

            sticky: false,

            openingSpeed: 250,

            closingDelay: 0,

        });



        /* 

        =============================
        = Init toggle search event  
        ================================
        */

        $("body").on('click', '#search-toggle', function() {



            $("#header-search").toggle()



        });


        /* 
        =================================
        = Canvas aside bar
        ====================================
        */

        var $CanvasRevelBtn = $('#canvas-toggle');

        var $CanvasAside = $('#canvas-aside');

        var $SideCanvasMask = $('#canvas-aside-mask');



        $CanvasRevelBtn.on('click', function() {



            $CanvasAside.addClass('visible');

            $SideCanvasMask.addClass('visible');

        });



        $SideCanvasMask.on('click', function() {



            $CanvasAside.removeClass('visible');

            $SideCanvasMask.removeClass('visible');

        });


        /* 
        =============================
        = Init sticky header 
        ================================
        */

        $("#cb-stickhead").sticky({ topSpacing: 0 });;

        /* 
        =============================
        = Init sticky sidebar 
        =====================================
        */

        if (window.matchMedia("(max-width: 991px)").matches) {

          $(".en-col").removeClass("sticky-sidebar");

        } else {

            $('.sticky-sidebar').theiaStickySidebar({

                additionalMarginTop: 30

            });

        }


        /* 
        ===========================================
        = Configure lazyload ( lazysizes.js ) 
        ==================================================
        */

        var lazy = function lazy() {

            document.addEventListener('lazyloaded', function(e) {



                e.target.parentNode.classList.add('image-loaded');

                e.target.parentNode.classList.remove('lazyloading');

                // Init masonry inside lazyload event

                var maso = $('#masonry-grids-row');

                maso.imagesLoaded().progress(function() {

                    maso.masonry({

                        itemSelector: '.masonry-item',

                    });

                });

            });

        }

        lazy();

        window.lazySizesConfig = window.lazySizesConfig || {};

        lazySizesConfig.preloadAfterLoad = false;

        lazySizesConfig.expandChild = 370;


        /* 
        =================================================
        = Init News ticker
        ===========================================================
        */

        $('#news-ticker').owlCarousel({

            items: 1,

            loop: true,

            margin: 0,

            smartSpeed: 4000,

            nav: true,

            dots: false,

            autoplay: true,

            autoplayTimeout: 3000,

            autoplayHoverPause: true,

            mouseDrag: false,

            touchDrag: false,

            animateOut: 'slideOutUp',

            animateIn: 'slideInUp',

            navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],

        });


        /* 
        =================================================
        = Init carousel for banner
        ==========================================================
        */

        // Banner layout One

        $('#en-banner-lay-1').owlCarousel({

            items: 5,

            loop: true,

            lazyLoad: false,

            margin: 1.5,

            smartSpeed: 800,

            nav: true,

            dots: false,

            autoplay: true,

            autoplayTimeout: 5000,

            autoplayHoverPause: true,

            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

            responsive: {

                0: {

                    items: 1

                },

                550: {



                    items: 1

                },

                600: {

                    items: 2

                },

                768: {

                    items: 2

                },

                992: {

                    items: 3

                },

                1024: {

                    items: 3

                },

                1400: {



                    items: 4

                },

                1600: {

                    items: 4

                }

            },

        });

        // Banner layout two

        $('#en-banner-lay-2').owlCarousel({

            items: 1,

            loop: true,

            lazyLoad: false,

            margin: 0,

            smartSpeed: 900,

            nav: true,

            dots: false,

            autoplay: true,

            autoplayTimeout: 4000,

            autoplayHoverPause: true,

            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

        });


        // Banner layout four

        $('#en-banner-lay-4').owlCarousel({

            items: 1,

            loop: true,

            lazyLoad: false,

            margin: 0,

            smartSpeed: 900,

            nav: true,

            dots: false,

            autoplay: true,

            autoplayTimeout: 4000,

            autoplayHoverPause: true,

            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

        });


        /* 
        =================================================
        = Init carousel for fron page widgets
        ===========================================================
        */

        // Front page widget 6

        $('.en-front-widget-6-carousel').owlCarousel({

            items: 4,

            loop: true,

            lazyLoad: false,

            margin: 0,

            smartSpeed: 700,

            nav: true,

            dots: false,

            autoplay: true,

            autoplayTimeout: 4000,

            autoplayHoverPause: true,

            navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],

            responsive: {

                0: {

                    items: 1

                },

                550: {



                    items: 1

                },

                600: {

                    items: 2

                },

                768: {

                    items: 2

                },

                992: {

                    items: 3

                },

                1024: {

                    items: 3

                },

                1400: {



                    items: 4

                },

                1600: {

                    items: 4

                }

            },

        });



        /* 
        =================================================
        = Init carousel for gallery post format
        ===========================================================
        */

        // Gallery post format

        $('.owl-single-gallery').owlCarousel({



            items: 1,

            loop: true,

            lazyLoad: false,

            margin: 0,

            smartSpeed: 800,

            nav: true,

            dots: false,

            autoplay: true,

            autoplayTimeout: 5000,

            autoplayHoverPause: true,

            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

        });


        /* 
        =============================
        = Init widgets in tab
        =====================================
        */

        // Tabed widgets at front & sidebar

        $('ul.tabs li').click(function() {



            var current_tab = $(this);

            var tab_id = current_tab.attr('data-tab');

            var cont_ele = $('#' + tab_id);



            current_tab.siblings().removeClass('current');

            cont_ele.siblings().removeClass('current');



            current_tab.addClass('current');

            cont_ele.addClass('current');

        })


        /* 
        =============================
        = Append back to top btn 
        =====================================
        */

        $('body').append('<div id="toTop" class="btn-general"><i class="icon ion-ios-arrow-up"></i></div>');

        $(window).on('scroll', function() {

            if ($(this).scrollTop() != 0) {

                $('#toTop').fadeIn();

            } else {

                $('#toTop').fadeOut();

            }

        });



        $("body").on('click', '#toTop', function() {



            $("html, body").animate({ scrollTop: 0 }, 800);

            return false;



        });

    });


    // remove sticky sidebar in media less then 991px

    $(window).resize(function() {



        if (window.matchMedia("(max-width: 991px)").matches) {

          $(".en-col").removeClass("sticky-sidebar");

        }



        if ($(window).width() <= 1200) {



            $("body").removeClass("sticky-sidebar");



        }



    });



})(jQuery);