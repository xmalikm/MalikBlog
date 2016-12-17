<!DOCTYPE html>
<html>
<head>

	<title> @yield('title') </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	{{-- Custom bootstrap css --}}
	<link href="css/bootstrap_custom.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

	<div class="container container-header">
	<div class="row">
		<div class="col-md-12">
		{{-- logo --}}
		<img src="http://placehold.it/100x50" class="logo">
		{{-- social media links --}}
		<a href="" class = "pull-right"><img src="images/icons/facebook-icon.png" class = "social-media"></a>
		<a href="" class = "pull-right"><img src="images/icons/google-icon.png" class = "social-media"></a>
		</div>
</div>
	</div>

	@include('partials/_headerNavbar')

</body>
</html>