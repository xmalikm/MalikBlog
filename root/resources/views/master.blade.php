{{-- Master page, hlavna kostra - vsetky stranky aplikacie ju dedia --}}
<!DOCTYPE html>
<html>
<head>

	<title> @yield('title') | Malik blog </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- favicony --}}
	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" href="{{ asset('favicons/favicon-32x32.png') }}" sizes="32x32">
	<link rel="icon" type="image/png" href="{{ asset('favicons/favicon-16x16.png') }}" sizes="16x16">
	<link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
	<link rel="mask-icon" href="{{ asset('favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
	<link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}">
	<meta name="msapplication-config" content="{{ asset('favicons/browserconfig.xml') }}">
	<meta name="theme-color" content="#ffffff">

	<!-- bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{-- ikony --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	{{-- css pre login/registracny formular --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/login-style.css')}}">
	{{-- css pre navigacne menu --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap_navbar.css')}}">
	{{-- Custom bootstrap css --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	{{-- selectize kniznica -> css subor --}}
	<link href="{{ url('selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">

	{{-- umoznoje pridavanie css suborov na konkretne stranky --}}
	@yield('stylesheets')

</head>
<body>

	{{-- header stranky --}}
	@include('header')

	{{-- navigacne menu --}}
	@include('partials/_navbar')

	{{-- kontajner pre slider s postami --}}
	@yield('posts-slider')

	{{-- bootstrap modal dialog - obsahuje form pre vytvorenie novej kategorie --}}
	{{-- musi byt umiestneny v tu - inak dobre nefunguje --}}
  	@include('partials/_newCatModal')
  	
	{{-- wrapper kontajner --}}
	<div class="container-fluid body-wrapper">
		{{-- body kontajner --}}	
		<div class="container container-body">

			{{-- forma, v ktorej sa zobrazuje obsah --}}
			@yield('mainContent')

		</div>{{-- hlavny kontajner --}}
	</div>{{-- wrapper kontajner --}}

	{{-- footer --}}
	<div class="container container-footer" style="background-color: #313131;">
		@include('partials/_footer')
	</div>

	<!-- jQuery kniznica -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	{{-- selectize kniznica -> js subor --}}
	<script type="text/javascript" src='{{ url("selectize/js/standalone/selectize.min.js") }}'></script>
	{{-- premenna potrebna v js skripte pri vyhladavani clankov --}}
	<script>
		var root_dir = '{!!url("/")!!}';
	</script>
	{{-- hlavny js subor --}}
	<script src=" {{ asset('js/blog-js/main.js') }} "></script>

	{{-- umoznoje pridavanie js suborov na konkretne stranky --}}
	@yield('scripts')
</body>
</html>