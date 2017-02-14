<!DOCTYPE html>
<html>
<head>

	<title> @yield('title') | Malik blog </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	{{-- font --}}
	<link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">
	{{-- Custom bootstrap css --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	{{-- umoznoje pridavanie css suborov na konkretne stranky --}}
	@yield('stylesheets')

</head>
<body>

	{{-- header stranky --}}
	<header>
		{{-- header kontajner --}}
		<div class="container-fluid container-header">

			<div class="row">

				{{-- social media ikony --}}
				<div class="col-md-4 social-media text-center">
					<a href=""><img src="{{ asset('images/icons/facebook-icon.png') }}" class = "icon"></a>
					<a href=""><img src="{{ asset('images/icons/google-icon.png') }}" class = "icon"></a>
				</div>

				{{-- logo --}}
				<div class="col-md-4 text-center logo">
					<a href=""><img src="{{ asset('images/malikblog.png') }}" class="blog-logo"></a>
				</div>

				{{-- formular na vyhladavanie --}}
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-0 search-input">
					    <div class="input-group">
					    	<input type="text" class="form-control" placeholder="Search for...">
					    	<span class="input-group-btn" style="line-height: 0;">
					        	<button class="btn btn-secondary" type="button">Go!</button>
					    	</span>
						</div>
				</div>

			</div>

				{{-- <h6>helper metody: url na klikatelne linky, vkladanie obrazkov do clankov</h6>
				<h6>nadpis motto: podelte sa o svoje zazitky</h6>
				<h5>osetrovat metody!!!!</h5> --}}

		</div>{{-- header kontajner --}}
	</header>

	{{-- menu --}}
	@include('partials/_navbar')

	{{-- kontajner pre slider s postami --}}
	@yield('posts-slider')

	<div class="container-fluid body-wrapper">
		{{-- hlavny kontajner --}}	
		<div class="container container-body">
		{{-- @yield('categories') --}}

			{{-- forma, v ktorej sa zobrazuje obsah --}}
			@yield('mainContent')

		</div>{{-- hlavny kontajner --}}
	</div>

	{{-- footer --}}
	<div class="container container-footer" style="background-color: #313131;">
		@include('partials/_footer')
	</div>

	{{-- umoznoje pridavanie js suborov na konkretne stranky --}}
	@yield('scripts')
	<script>
		$(document).ready(function(){
			var blogNavbar = $('.navbar-blog');

			stickNavbar();

			$(window).scroll(stickNavbar);

			function stickNavbar(){
				if($(this).scrollTop() > 230) {
					$('header').css('display', 'none');
					blogNavbar.addClass('navbar-scrolled');
				}
				else {
					blogNavbar.removeClass('navbar-scrolled');
					$('header').css('display', 'block');
				}
			}

			// dynamicka zmena aktivneho linku v navbare
			var url = window.location;
			// Will only work if string in href matches with location
			$('ul.nav a[href="'+ url +'"]').parent().addClass('active');
			// Will also work for relative and absolute hrefs
			$('ul.nav a').filter(function() {
			    return this.href == url;
			}).parent().addClass('active');
		});
	</script>
</body>
</html>