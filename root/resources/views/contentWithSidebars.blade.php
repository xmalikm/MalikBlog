{{-- Stranka so sidebarmi --}}

@extends('master')

@section('mainContent')
			
	{{-- kategorie clankov --}}
	@yield('categories')

	{{-- breadcrumbs --}}
	<div class="row">
		<div class="col-md-12">
			<h5>@yield('breadcrumbs')</h5>
		</div>
	</div>

	{{-- hlavny content --}}
	<div class="row">
		{{-- main wrapper --}}
		<div class="col-md-7 main-content-wrapper">
			{{-- nadpis stranky --}}
			@yield('pageTitle')
			{{-- buttony na zoradovanie clankov --}}
			@yield('sortingButtons')
			{{-- obsah stranky --}}
		    @yield('content')
		</div>{{-- main wrapper --}}

		{{-- sidebary --}}
		<aside>
			<div class="col-md-4 col-md-offset-1 sidebar-wrapper">
				{{-- sidebary --}}
				@yield('sidebars')
			</div>{{-- sidebary --}}
		</aside>

	</div>{{-- hlavny content --}}

@endsection