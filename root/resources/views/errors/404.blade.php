{{-- 404 not found stranka --}}
@extends('contentWithoutSidebars')

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('404error') !!}
@endsection

@section('content')
	
	{{-- error content --}}
	<div class="row text-left">

		{{-- error text --}}
		<div class="col-sm-6">
			{{-- nasdpis --}}
			<h2 id="not-found-title">Prepáčte, ale táto stránka neexistuje.</h2>
			{{-- text --}}
			<p>
				Stránka, ktorú hľadáte, nie je k dispozícii alebo bola presunutá.<br>
				Skontrolujte, či ste zadali správnu adresu, alebo si skúste prečítať niektorý z našich 
				<a href="{{ url('/post') }}">ďalších článkov</a>.<br>
				Veľa článkov z rôznych kategorii nájdete aj na našej <a href="{{ url('/') }}">úvodnej stránke</a>.
			</p>
		</div>
		{{-- error image --}}
		<div class="col-sm-6">
			<img src="{{asset('images/icons/404.image.png')}}" style="width: 100%; max-width: 540px;">
		</div>

	</div>{{-- error content --}}
		
@endsection