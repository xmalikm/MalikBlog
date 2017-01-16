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

	{{-- druhy row: posty + dalsie sidebary --}}
	<div class="row" style="margin-top: 50px;">
			
		{{-- lava strana -> posty --}}
		<div class="col-lg-12 col-md-12 col-sm-12" style="">
			
			{{-- nadpis --}}
			<h1>@yield('pageTitle')</h1>

			{{-- obsah --}}
        	@yield('content')

		</div>{{-- lava strana --}}

	</div>{{-- druhy row: posty + dalsie sidebary --}}

@endsection