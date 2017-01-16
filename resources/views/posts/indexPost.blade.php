@extends('contentWithSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- kategorie clankov --}}
@section('categories')
	@include('partials/_categories')
@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('allPosts') !!}
@endsection

{{-- buttony na zoradovanie clankov --}}
@section('sortingButtons')

	{{-- prvy row: kategorie + pravy sidebar --}}
	@include('partials/_sorting')

@endsection

@section('pageTitle', $title)

@section('content')
	
	@foreach($posts as $post)

		{{-- ukazka clanku --}}
		<div class="row article-excerpt">
				
			{{-- foto clanku --}}
			<div class="col-lg-4">

				{{-- <img src="http://placehold.it/200x160" class="logo"> --}}
				<img src=" {{asset('uploads/blog_photos/'. $post->blog_photo)}}" style="width: 200px; height: 160px; border: 1px solid grey;">
							
			</div>{{-- foto clanku --}}

			{{-- info k clanku --}}
			<div class="col-lg-8">
						
				{{-- meno autora --}}
				<b>Kategoria: </b> {{ $post->category->name }} <br>
				<p>
					<a href=" {{ url('user', $post->user->id) }} " style="color: #797979;"> {{ $post->user->name}} </a>
				</p>

				{{-- nadpis clanku --}}
				<h3 style="margin-top: 0;"><a href="{{ url('post', $post->id) }}">{{ $post->title }}</a></h3>

				{{-- uryvok --}}
				<p>
					{{ $post->text_teaser }} <br><a href="{{ url('post', $post->id) }}">viac&raquo;</a>
					</p>

				{{-- doplnkove info --}}
				<small> {{ $post->created_at }} | Prečítané: {{ $post->unique_views }}x | Diskusia: 5 komentov</small>

			</div>{{-- info k clanku --}}

   		</div>{{-- ukazka clanku --}}

	@endforeach

@endsection

@section('sidebars')

	@include('partials/sideBars/_mostViewed')

@endsection