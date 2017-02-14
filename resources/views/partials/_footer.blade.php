<footer>
	<div class="row footer-content">
		<div class="col-sm-4 text-center about" >
			<h3 class="footer-title">O autorovi</h3>
			<img class="about-image" src="http://img.timeinc.net/time/daily/2010/1011/poy_nomination_agassi.jpg">
			<p class="about-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Errata repellere scripta orestem turma. Poenis multis reprimique erat sollicitudines. Locupletiorem reliquisti.</p>
		</div>
		<div class="col-sm-4 contact">
			<h3 class="footer-title">Kontakt</h3>
			<p><span class="glyphicon glyphicon-envelope"></span>&nbsp xmalikm3@gmail.com</p>
			<hr>
			<h4 class="footer-title">Najdete nas aj na socialnych sietach</h4>
			<p class="social-media">
				<a href=""><img src="{{ asset('images/icons/facebook-icon.png') }}" class = "icon"></a>
				<a href=""><img src="{{ asset('images/icons/google-icon.png') }}" class = "icon"></a>
			</p>
		</div>
		<div class="col-sm-4" >
			{{-- newsletter formular --}}
			@include('partials/_newsletter')
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center copyright">
			<img src="{{ asset('images/malik_sites.png') }}">
		</div>
	</div>
</footer>