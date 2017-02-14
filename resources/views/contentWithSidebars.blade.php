{{-- Hlavny obsah stranky spolu so sidebarmi --}}

@extends('master')

@section('mainContent')
			
	{{-- neviem ci to treba --}}
	<div class="clear-div" style="clear: both"></div>
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
		<div class="col-md-7 main-content-wrapper">

			{{-- nadpis stranky --}}
			@yield('pageTitle')

			{{-- buttony na zoradovanie clankov --}}
			@yield('sortingButtons')

			{{-- obsah stranky --}}
		    @yield('content')

		</div>{{-- hlavny content --}}

		{{-- sidebary - pojdu do partials --}}
		<aside>
			<div class="col-md-4 col-md-offset-1 sidebar-wrapper">

				{{-- sidebary --}}
				@yield('sidebars')

			</div>{{-- sidebar --}}
		</aside>
	</div>

@endsection