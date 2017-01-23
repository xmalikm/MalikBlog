<!DOCTYPE html>
<html>
<head>

	<title> @yield('title') | Malik blog </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	{{-- Custom bootstrap css --}}

	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

	{{-- umoznoje pridavanie css suborov na konkretne stranky --}}
	@yield('stylesheets')

</head>
<body>

	<div class="container container-header">

		{{-- logo --}}
		<img src="http://placehold.it/150x100" class="logo">

		 {{--   <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> --}}
		{{-- social media links --}}
		<a href="" class = "pull-right"><img src="{{ asset('images/icons/facebook-icon.png') }}" class = "social-media"></a>
		<a href="" class = "pull-right"><img src="{{ asset('images/icons/google-icon.png') }}" class = "social-media"></a>
		<span class="pull-right">FORM - treba spravit</span>
		<h4>helper metody: url na klikatelne linky, vkladanie obrazkov do clankov</h4>
		<h4>nadpis motto: podelte sa o svoje zazitky</h4>
		<h2>osetrovat metody!!!!</h2>
	</div>

	@include('partials/_headerNavbar')

	{{-- hlavny kontajner --}}	
	<div class="container-fluid container-body">
	@yield('categories')

		{{-- forma, v ktorej sa zobrazuje obsah --}}
		@yield('mainContent')

	</div>{{-- hlavny kontajner --}}

	{{-- umoznoje pridavanie js suborov na konkretne stranky --}}
	@yield('scripts')
</body>
</html>