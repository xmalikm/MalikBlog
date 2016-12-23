@extends('contentSidebar')

{{-- title stranky --}}
@section('title', $title)

{{-- buttony na zoradovanie clankov --}}
@section('sortingButtons')

	{{-- prvy row: kategorie + pravy sidebar --}}
	@include('partials/_blog-categories')

@endsection


@section('content')

	{{-- nadpis treba potom presunut !!!!!!!!!!!!!!!!!!!!!!!--}}
   	<div class="row row-title">

   		<div class="col-lg-12 col-md-12">

       		<h2 class="text-left" style=""> {!! $title or "Vsetky blogy na portali" !!}</h2>

       	</div>

	</div>{{-- nadpis --}}

	@foreach($posts as $post)

		{{-- ukazka clanku --}}
		<div class="row article-excerpt">
				
			{{-- foto clanku --}}
			<div class="col-lg-4">

				<img src="http://placehold.it/200x160" class="logo">
							
			</div>{{-- foto clanku --}}

			{{-- info k clanku --}}
			<div class="col-lg-8">
						
				{{-- meno autora --}}
				<p>
					<a href=" stranka autora {{-- {{ url('user', $post->user->id) }} --}} " style="color: #797979;"> {{ $post->user->name}} </a>
				</p>

				{{-- nadpis clanku --}}
				<h3 style="margin-top: 0;"><a href="{{ url('post', $post->id) }}">{{ $post->title }}</a></h3>

				{{-- uryvok --}}
				<p>
					{{ $post->text_teaser }} <br><a href="{{ url('post', $post->id) }}">viac&raquo;</a>
					</p>

				{{-- doplnkove info --}}
				<small> {{ $post->created_at }} | Prečítané: 30x | Diskusia: 5 komentov</small>

			</div>{{-- info k clanku --}}

   		</div>{{-- ukazka clanku --}}

	@endforeach

@endsection

@section('sidebars')

	{{-- najcitanejsie blogy --}}
	<div class="panel panel-info panel-table">

		<div class="panel-heading panel-table-heading">

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

	    </div>{{-- panel body --}}

	</div>{{-- najcitanejsie blogy --}}

@endsection