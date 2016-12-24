@extends('contentSidebar')

@section('content')

	{{-- obsah stranky --}}
	
	{{-- blog --}}
   	<div class="row show-post">

   		<div class="col-lg-12 col-md-12">

       		<h3 class="text-left" >Blog <b style="color: red;">{{ $post->user->name }} </b> </h3>

       	</div>

	</div>

	{{-- nadpis treba potom presunut !!!!!!!!!!!!!!!!!!!!!!!--}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<h2> {{ $post->title }} </h2>

		</div>

	</div>{{-- nadpis --}}

	{{-- foto k clanku --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<img src="http://placehold.it/500x300" class="logo">

		</div>

	</div>{{-- foto k clanku --}}

	<br> {{-- treba nahradit css-kom!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

	{{-- datum autor --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<small> {{ $post->createdAt }} | {{ $post->user->name }}</small>

		</div>

	</div>{{-- datum autor --}}

	<br> {{-- treba nahradit css-kom!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

	{{-- zdielanie na soc. sietach --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<button class="btn btn-primary">Zdielat</button>
			<button class="btn btn-warning">Zdielat</button>

		</div>

	</div>{{-- zdielanie na soc. sietach --}}

	<br>
	<br>

	{{-- clanok --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<p>
				{!! $post->full_text !!}
			</p>

		</div>

	</div>{{-- clanok --}}

	{{-- tagy k clanku --}}
	<div class="row">
		
		<div class="col-lg-12 col-md-12">
			
			<h1>karma clanku</h1>	
			@include('partials/_tags')

		</div>

	</div>{{-- tagy k clanku --}}

@endsection

@section('sidebars')

	{{-- najcitanejsie blogy --}}
	<div class="panel panel-info panel-table">

		<div class="panel-heading panel-table-heading">

	    	Autor clanku

	    </div>

	    <div class="panel-body">
	      					
			Info o autorovi

	    </div>{{-- panel body --}}

	</div>{{-- najcitanejsie blogy --}}

@endsection