/**
 * If fixed header calculate the height add margin to content below 
*/
(function($) {

    var resizeTimer; // Set resizeTimer to empty so it resets on page load

    function resizeFunction() {
        // Are we using a fixed header?
        var fixedHeader = document.getElementById("wrapper-navbar").classList;
        if (fixedHeader.contains("header-p-n")) {
            return;
        }
        else if (fixedHeader.contains("fixed-top")) {
    
            // get height of header and adminbar
            var fixedHeight = jQuery('#wrapper-navbar.fixed-top').innerHeight();
            var AdjustedfixedHeight = fixedHeight - 1;
    
            // apply height to page as margin-top
            jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper').css({'margin-top' : AdjustedfixedHeight + 'px'});
        }
    };

    // On resize, run the function and reset the timeout
    // 250 is the delay in milliseconds. Change as you see fit.
    $(window).resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(resizeFunction, 250);
    });

})(jQuery);

/**
 * Toggle offcanvas mobile menu
*/
jQuery(function () {
    
    jQuery('[data-toggle="offcanvas"]').on('click', function () {
        // add open class to nav
        jQuery('.offcanvas-collapse').toggleClass('open');
        // set html and body overflow-x: hidden to prevent horizontal scrollbar
        jQuery('html').toggleClass('offcanvas-overflowx');
        jQuery('body').toggleClass('offcanvas-overflowx');
        // run size function
        OffresizeFunction();
    })

    function OffresizeFunction() {
        // get height of header and adminbar
        var offcanvasHeight = jQuery('#wrapper-navbar').innerHeight();
        var adminBarHeight = jQuery('#wpadminbar').innerHeight();
        
        // if adminbar is null lets not include it
        if (adminBarHeight == null) { var OAsum = offcanvasHeight - 3; }
        else { var OAsum = offcanvasHeight + adminBarHeight - 3; }

        // set offcanvas top position
        jQuery('.offcanvas-collapse.open').css({'top' : OAsum + 'px'});
        
        // Check if we are using a non-fixed header
        var offcanvasRHeader = document.getElementById("wrapper-navbar").classList;
        // If so lets toggle fixed while offcanvas is open
        if (offcanvasRHeader.contains("header-p-n")) {
            offcanvasRHeader.toggle("fixed-top");
            if (jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper')[0].hasAttribute('style')) {
                jQuery("#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper").removeAttr("style");
            }
            else {
                jQuery('#page-wrapper, #single-wrapper, #woocommerce-wrapper, #full-width-page-wrapper, #homepage-wrapper, #search-wrapper, #index-wrapper, #error-404-wrapper, #archive-wrapper, #author-wrapper').css({'margin-top' : offcanvasHeight + 'px'});
            }
        }

    }

    var resizeTimer; // Set resizeTimer to empty so it resets on page load
    // On resize, run the function and reset the timeout
    // 200 is the delay in milliseconds.
    jQuery(window).resize(function() {
        if (jQuery('.offcanvas-collapse.open').length > 0) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(OffresizeFunction, 200);
        }
    });
   
});

/**
 * Hero youtube modal 
*/
jQuery(document).ready(function() {

    // Gets the video src from the data-src on each button
    var $videoSrc;  
    jQuery('.c-hero-video-btn').click(function() {
        $videoSrc = jQuery(this).data( "src" );
    });
    console.log($videoSrc);

    // when the modal is opened autoplay it  
    jQuery('#c-hero-modal').on('shown.bs.modal', function (e) {
        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        jQuery("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
    })

    // stop playing the youtube video when I close the modal
    jQuery('#c-hero-modal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        jQuery("#video").attr('src',$videoSrc); 
    }) 

// document ready  
});


  jQuery(document).ready(function(){
  jQuery('.c-clients__carousel').slick({
    arrows: true,
  dots: false,
  infinite: true,
  slidesToShow: 5,
  slidesToScroll: 5,
  responsive: [
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4,
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
      }
    },
    {
      breakpoint: 554,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
    


  });
});
