(function($) {
    'use strict';

    $(document).ready(function() {
	    qodeInitQuickLinkPopup();
	    qodeInitQuickLinkPopupScroll();
    });

    $(document).on( "qodeAjaxPageLoad",function(){

    });

    function qodeInitQuickLinkPopup() {
        var holder = $('.qode-quick-links-holder'),
            button = $('.qode-quick-links-button');

        setTimeout(function(){
	        holder.addClass('qode-quick-links-loaded');
        }, 300);

	    button.on('click', function(){
		    if(holder.hasClass('qode-quick-links-pop-up-opened')){
			    holder.removeClass('qode-quick-links-pop-up-opened');
		    } else {
			    holder.addClass('qode-quick-links-pop-up-opened');

		    }
	    });

	    $('.content, .qode-quick-links-pop-up-close').on('click', function(){
		    if(holder.hasClass('qode-quick-links-pop-up-opened')){
			    holder.removeClass('qode-quick-links-pop-up-opened');
		    }
	    });
    };

	function qodeInitQuickLinkPopupScroll() {

		var holder = $('.qode-quick-links-items');
		holder.mCustomScrollbar();
    };




})(jQuery)