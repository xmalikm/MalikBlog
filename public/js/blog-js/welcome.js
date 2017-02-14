$(document).ready(function(){
	// alert('ahoj moj')

	$('.slider').slick({
		infinite: true,
		speed: 800,
		slidesToShow: 3,
		slidesToScroll: 1,
		// autoplay: true,
		// autoplaySpeed: 4000,
		prevArrow: $('#slide-left'),
		nextArrow: $('#slide-right'),
		responsive: [
			{
			    breakpoint: 768,
			  	settings: {
			      	slidesToShow: 1,
			      	slidesToScroll: 1
			    }
			}
		]
	});
});

$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});

// zobrazenie navigacnych sipok pri hovernuti
$('.slider, #prev, #next').hover(function(){
	$('#prev, #next').css('visibility', 'visible');
}, function() {
	$('#prev, #next').css('visibility', 'hidden');
});
// stmavnutie obrazku clanku v slidery pri hovernuti
$('.highlight-post-image, .highlight-post-content').hover(function(){
	// zvys opacitu tmavej vrstvy na 1
	$(this).parent().find('.image-overlay').css('opacity',1);
}, function(){
	// zniz opacitu tmavej vrstvy na 0
	$(this).parent().find('.image-overlay').css('opacity',0);
});