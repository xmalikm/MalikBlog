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
		<img src="http://placehold.it/150x100" class="logo">

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

	{{-- hlavny kontajner --}}
	<div class="container container-body" >
	{{-- @include('partials/_blog-categories') --}}

	<div class="row">

		{{-- lava strana kontajnera --}}
		<div class="col-md-8" >

			{{-- nadpis a kategorie --}}
		    <div class="row row-title-categories">
        
        		{{-- nadpis --}}
        		<div class="col-lg-6 col-md-12">
        			<h2 class="text-center" style="">Vsetky blogy na portali</h2>
        		</div>

				{{-- kategorie --}}
        		<div class="col-lg-6 col-md-12 text-center categories">

	        		<div class="btn-group ">

	            		<a href="#" class="btn btn-info">Najnovšie</a>
	  					<a href="#" class="btn btn-info">Najčítanejšie</a>
	  					<a href="#" class="btn btn-info">Najviac komentované</a>

					</div>{{-- btn-group --}}

        		</div>{{-- kategorie --}}

    		</div>{{-- nadpis a kategorie --}}
				<h1>Vsetky blogy</h1>
				<h1>Vsetky blogy</h1>
				<h1>Vsetky blogy</h1>
				<h1>Vsetky blogy</h1>
				<h1>Vsetky blogy</h1>
			</div>

			{{-- sidebary --}}
			<div class="col-md-4" >
				
				<div class="panel panel-info panel-tabulka">
      				<div class="panel-heading panel-tabulka-heading">
      					Najčítanejšie blogy
      				</div>
      				<div class="panel-body">
      					
						<ol>
							<li>nazov clanku</li>
							<li>nazov clanku</li>
							<li>nazov clanku</li>
							<li>nazov clanku</li>
							<li>nazov clanku</li>
						</ol>

      				</div>
    			</div>

			</div>

		</div>	{{-- bootstrap row --}}

	</div>	{{-- hlavny kontajner --}}

</body>
</html>