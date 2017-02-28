{{-- Stranka bez sidebarov --}}

@extends('master')

{{-- obsah stranky --}}
@section('mainContent')
	
	{{-- breadcrumbs --}}
	<div class="row">
		<div class="col-md-12">
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