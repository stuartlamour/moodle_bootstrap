$(document).ready(function() {
	$('.dropdown-toggle').dropdown();
	$(document).scroll(function(){
	    // If has not activated (has no attribute "data-top"
	    if (!$('.stickynav').attr('data-top')) {
	        // If already fixed, then do nothing
	        if ($('.stickynav').hasClass('breadcrumb-fixed-top')) return;
	        // Remember top position
	        var offset = $('.stickynav').offset()
	        $('.stickynav').attr('data-top', offset.top);
	    }

	    if ($('.stickynav').attr('data-top') - $('.stickynav').outerHeight() <= $(this).scrollTop())
	        $('.stickynav').addClass('breadcrumb-fixed-top');
	    else
	        $('.stickynav').removeClass('breadcrumb-fixed-top');
	});

	
});