jQuery(document).ready(function ($) {
	
        $title = $('.home_widget').has( "h3.widget-title" ).css( "margin-top", "60px" );
        
        
        $(".items .sl_item").hover(function() {
		  $('.showedItem').css('display','none').removeClass('showedItem');
		  $('#slide-content .item1').fadeIn(300).stop(true,true).addClass('showedItem');
		  $('.items div').each(function() {
			  $(this).removeClass("item-selected");
		  });;
		  $(this).addClass('item-selected');
		  
	});
        
        // home top content slider
        //$("#slideshow > div:gt(0)").hide();
//        setInterval(function() { 
//          $('#slideshow > div:first')
//            .fadeOut(1000)
//            .next()
//            .fadeIn(1000)
//            .end()
//            .appendTo('#slideshow');
//        },  4000);
	
    
    jQuery('.dropdown-menu li, .dropdown').hover(function() {
        jQuery('> .sub-menu', this).fadeIn('fast');
        jQuery('> .dropdown-menu', this).fadeIn('fast');
    }, function() {
        jQuery('> .sub-menu', this).fadeOut('fast');
        jQuery('> .dropdown-menu', this).fadeOut('fast');
    });
    
    
    
   setInterval(function() { 
            $('#slideshow > div:first')
              .fadeOut(1000)
              .next()
              .fadeIn(1000)
              .end()
              .appendTo('#slideshow');
    },  4000);

   
});


