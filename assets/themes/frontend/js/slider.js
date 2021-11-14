$(document).ready(function(){
  $('#slider1').bxSlider({
	mode: 'fade',
	infiniteLoop: true,
	auto: true,
	autoControls: true
  });

  $('#slider2').bxSlider({
	slideWidth: 140,
    minSlides: 5,
    maxSlides: 5,
	moveSlides:1,
	auto: true,
	controls: true,
	pager:false,
  });
  
});