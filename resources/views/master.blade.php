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

	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

	<div class="container container-header">

		{{-- logo --}}
		<img src="http://placehold.it/100x50" class="logo">

		 {{--   <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> --}}
		{{-- social media links --}}
		<a href="" class = "pull-right"><img src="images/icons/facebook-icon.png" class = "social-media"></a>
		<a href="" class = "pull-right"><img src="images/icons/google-icon.png" class = "social-media"></a>
		<span class="pull-right">FORM - treba spravit</span>
	</div>

	@include('partials/_headerNavbar')

</body>
</html>