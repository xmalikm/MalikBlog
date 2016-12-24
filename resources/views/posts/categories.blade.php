@extends('contentSidebar')

@section('content')

	{{-- nadpis treba potom presunut !!!!!!!!!!!!!!!!!!!!!!!--}}
   	<div class="row row-title">

   		<div class="col-lg-12 col-md-12">

       		<h2 class="text-left" style="">Kategórie blogov</h2>

       	</div>

	</div>{{-- nadpis --}}

	{{-- obsah stranky --}}
	<div class="row categories">
		
		<ul>
			<li>politika</li>
			<li>sport</li>
			<li>domov</li>
			<li>zahranicie</li>
			<li>soubinznis</li>
			<li>hobby</li>
		</ul>

		<h2>pridat aj tagy</h2>
	</div>

@endsection