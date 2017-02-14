{{-- Hlavny obsah stranky bez sidebarov --}}

@extends('master')

@section('mainContent')
	
	<div class="row">
		<div class="col-md-12">
			{{-- breadcrumbs --}}
			<h5>@yield('breadcrumbs')</h5>
		</div>
	</div>

	{{-- hlavny content --}}
	<div class="col-md-12 main-content-wrapper">

		{{-- nadpis stranky --}}
		@yield('pageTitle')

		{{-- obsah stranky --}}
	    @yield('content')

	</div>{{-- hlavny content --}}

@endsection