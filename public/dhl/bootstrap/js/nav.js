jQuery("document").ready(function($){

	var nav = $('.header');

	$(window).scroll(function () {
		if ($(this).scrollTop() > 136) {
			nav.addClass("f-nav");
			
		} else {
			nav.removeClass("f-nav");
		
		}
	});


});