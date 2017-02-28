$(document).ready(function(){

	// slick.js kniznica -> zabezpecuje slide-ovanie nahladov clankov
	$('.slider').slick({
		// nekonecny slide
		infinite: true,
		// rychlost slidu
		speed: 800,
		// pocet clankov, ktore sa zobrazia v slidery
		slidesToShow: 3,
		// pocet clankov, o kolko sa sliduje
		slidesToScroll: 1,
		// automaticke slide-ovanie
		// autoplay: true,
		// rychlost automatickeho slide-ovania
		// autoplaySpeed: 4000,
		// elementy, ktore su navigacnymi sipkami v slidery
		prevArrow: $('#slide-left'),
		nextArrow: $('#slide-right'),
		// slider pri mobile view
		responsive: [
			{
				// breakpoint, pri ktorom sa zobrazi responzivny slider
			    breakpoint: 768,
			  	settings: {
			  		// pocet clankov, ktore sa zobrazia v slidery
			      	slidesToShow: 1,
			      	// pocet clankov, o kolko sa sliduje
			      	slidesToScroll: 1
			    }
			}
		]
	});

	// zobrazovanie tooltipov
	$('[data-toggle="tooltip"]').tooltip(); 

	// zobrazenie navigacnych sipok pri hovernuti slidera
	$('.slider, #prev, #next').hover(function(){
		$('#prev, #next').css('visibility', 'visible');
	}, function() {
		$('#prev, #next').css('visibility', 'hidden');
	});

	// stmavnutie fotky clanku v slidery pri hovernuti
	$('.highlight-post-image, .highlight-post-content').hover(function(){
		// zvys opacitu tmavej vrstvy na 1
		$(this).parent().find('.image-overlay').css('opacity',1);
	}, function(){
		// zniz opacitu tmavej vrstvy na 0
		$(this).parent().find('.image-overlay').css('opacity',0);
	});
});