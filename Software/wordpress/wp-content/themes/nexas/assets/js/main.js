/* --------------------------------------
=========================================
Nexas
Version: 0.0.7
Designed By: Paragon Themes
=========================================
*/

(function ($) {
	"use strict";

    jQuery(document).ready(function($){
	    
		//carousel active
        $(".carousel-inner .item:first-child").addClass("active");
		
		//Fixed nav on scroll
		$(document).scroll(function(e){
			var scrollTop = $(document).scrollTop();
			if(scrollTop > $('header nav').height()){
				//console.log(scrollTop);
				$('header nav').addClass('navbar-fixed-top');
			}
			else {
				$('header nav').removeClass('navbar-fixed-top');
			}
		});
			
			 //Portfolio Popup
    $('.magnific-popup').magnificPopup({type:'image'});
			
      //Check to see if the window is top if not then display button
        jQuery(window).scroll(function($){
          if (jQuery(this).scrollTop() > 100) {
            jQuery('.go-to-top').addClass('gotop');
            jQuery('.go-to-top').fadeIn();
          } else {
            jQuery('.go-to-top').fadeOut();
          }
        });
      
      //Click event to scroll to top
      jQuery('.go-to-top').click(function($){
        jQuery('html, body').animate({scrollTop : 0},800);
        return false;
      });
        	
    
    });

   
//Wow js
	new WOW().init();
	 
}(jQuery));	


 jQuery(window).load(function(){

    //Portfolio container     
    var $container = jQuery('.portfolioContainer');
    $container.isotope({
      filter: '*',
      animationOptions: {
        duration: 750,
        easing: 'linear',
        queue: false
      }
    });
 
    jQuery('.portfolioFilter a').on('click', function(){
      jQuery('.portfolioFilter a').removeClass('current');
      jQuery(this).addClass('current');
   
      var selector = jQuery(this).attr('data-filter');
         $container.isotope({
        filter: selector,
        animationOptions: {
          duration: 750,
          easing: 'linear',
          queue: false
        }
       });
       return false;
    });

  });