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

       		<h2 class="text-left" style="">Vsetky blogy na portali</h2>

       	</div>

	</div>{{-- nadpis --}}

	@foreach($posts as $post)

		{{-- ukazka clanku --}}
		<div class="row article-excerpt">
				
			{{-- foto clanku --}}
			<div class="col-lg-4">

				<img src="http://placehold.it/200x140" class="logo" style="">
							
			</div>{{-- foto clanku --}}

			{{-- info k clanku --}}
			<div class="col-lg-8">
						
				{{-- meno autora --}}
				<p><a href="">Martin Malik</a></p>

				{{-- nadpis clanku --}}
				<h3 style="margin-top: 0;"><a href="{{ url('post', $post->id) }}">{{ $post->title }}</a></h3>

				{{-- uryvok --}}
				<p>
					{{ substr($post->text, 0, 140) }} <br><a href="{{ url('post', $post->id) }}">viac&raquo;</a>
					</p>

				{{-- doplnkove info --}}
				<small> {{ $post->created_at }} | Prečítané: 30x | Diskusia: 5 komentov</small>

			</div>{{-- info k clanku --}}

   		</div>{{-- ukazka clanku --}}

	@endforeach

@endsection