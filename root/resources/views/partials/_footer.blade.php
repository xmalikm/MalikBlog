{{-- footer stranky --}}
<footer>

	<div class="row footer-content">
		{{-- info o mne :) --}}
		<div class="col-sm-4 text-center about" >
			<h3 class="footer-title ">O autorovi</h3>
			{{-- foto --}}
			<img class="about-image" src="{{ asset('images/martin.jpg') }}">
			{{-- nieco o mne --}}
			<p class="about-text">
				Volám sa Martin Malík a mám 23 rokov. Programovaniu stránok sa venujem zhruba 2 roky.
				Prioritne programujem backend ale viem spraviť aj frontend aplikácie.
				Študujem aplikovanú informatiku na FEI STU v Bratislave.
			</p>
		</div>{{-- info o mne :) --}}

		{{-- kontakt --}}
		<div class="col-sm-4 contact">
			<h3 class="footer-title ">Kontakt</h3>
			{{-- email --}}
			<p><span class="glyphicon glyphicon-envelope"></span>&nbsp <a href="mailto:xmalikm3@gmail.com">xmalikm3@gmail.com</a></p>
			{{-- tel cislo --}}
			<p><span class="glyphicon glyphicon-earphone"></span>&nbsp <span itemprop="telephone"><a href="tel:+421915057615">+421 915 057 615</a></span>
			<hr>
			{{-- linky na socialne siete --}}
			<h4 class="footer-title">Najdete nas aj na socialnych sietach</h4>
			<p class="social-media">
				{{-- fb --}}
				<a href="https://www.facebook.com/martin.malik.14?ref=bookmarks" title="Martin Malík Facebook" target="_blank">
					<img src="{{ asset('images/icons/facebook-icon.png') }}" class = "icon">
				</a>
				{{-- g+ --}}
				<a href="https://plus.google.com/u/0/104749510764663008968" title="Martin Malík Google+" target="_blank">
					<img src="{{ asset('images/icons/google-icon.png') }}" class = "icon">
				</a>
			</p>{{-- linky na socialne siete --}}
			<hr>
			{{-- link na info o projekte --}}
			<h5 class="footer-title"> Prečítajte si <a href="{{ url('info') }}">informácie o projekte</a></h5>
			<hr>
			<p>Tento web používa súbory cookies. Prehliadaním webu vyjadrujete súhlas s ich používaním.<br> <a href="{{ url('cookies') }}">Viac informácií</a>.</p>
		</div>{{-- kontakt --}}

		{{-- newsletter --}}
		<div class="col-sm-4" >
			{{-- newsletter formular --}}
			@include('partials/_newsletter')
		</div>{{-- newsletter --}}
	</div>

	{{-- dodatocne footer info --}}
	<div class="row text-center copyright" style=" display: flex; align-items: center;">
		<div class="col-sm-6">
			<img src="{{ asset('images/malik_sites.png') }}">
		</div>
		<div class="col-sm-6">
			<span>Copyright © malikweb.sk, 2017 </span>
		</div>
	</div>{{-- dodatocne footer info --}}

</footer>