{{-- 
	Forma pre lavu a pravu stranu obsahu:
		- lava strana -> uryvky clankov, clanky, kategorie,...
		- prava strana -> rozne typy sidebarov 
--}}

@extends('master')

@section('mainContent')
	
	<div class="row">
		<div class="col-lg-8 col-md-8">
			{{-- breadcrumbs --}}
			<h5>@yield('breadcrumbs')</h5>
		</div>
	</div>

	{{-- buttony na zoradovanie clankov --}}
	@yield('sortingButtons')

	{{-- druhy row: posty + dalsie sidebary --}}
	<div class="row" style="margin-top: 50px;">
			
		{{-- lava strana -> posty --}}
		<div class="col-lg-8 col-md-8 col-sm-8" style="">
			
			{{-- nadpis stranky --}}
			<h1>@yield('pageTitle')</h1>

			{{-- obsah stranky --}}
        	@yield('content')

		</div>{{-- lava strana --}}

		{{-- prava strana -> sidebary --}}
		<div class="col-lg-4  col-md-4 col-sm-4">

			{{-- sidebary --}}
			@yield('sidebars')

		</div>{{-- prava strana -> sidebary --}}

	</div>{{-- druhy row: posty + dalsie sidebary --}}

@endsection