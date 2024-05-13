jQuery(document).ready(function($) {
	// Set the height of the slider to match its parent
    $('.gallery-slider').slick({
        dots: true,
        infinite: true,
		autoplay: true,
		autoplaySpeed: 3000,
		lazyLoad: 'progressive',
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: false,
		prevArrow: false,
		nextArrow: false,
		slickPause: true,
		slickPlay: true		
     });
	
	// Get all button elements inside the ul with the class slick-dots
	var buttons = document.querySelectorAll('.slick-dots button');

	// Loop through each button element
	buttons.forEach(function(button) {
		var buttonText = button.textContent;
		var newButtonText = "Project " + buttonText;
		button.textContent = newButtonText;
	});
	// Play button click event
	  $('.play').click(function(){
		$('.gallery-slider').slick('slickPlay'); 
		  $('.play').hide(); 
   		  $('.pause').show(); 
		  
	  });
	// Pause button click event
	  $('.pause').click(function(){
		$('.gallery-slider').slick('slickPause'); 
		$('.pause').hide(); 
    	$('.play').show(); 
	  });
	
});
                   