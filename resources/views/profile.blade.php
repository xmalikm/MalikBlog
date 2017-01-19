@extends('contentWithSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- kategorie clankov --}}
@section('categories')
	@include('partials/_categories')
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('showUser', $user) !!}
@endsection

@section('content')

	{{-- nadpis treba potom presunut !!!!!!!!!!!!!!!!!!!!!!!--}}
   	<div class="row row-title">

   		<div class="col-lg-12 col-md-12">

       		<h2 class="text-left" style=""> {!! $title or "Vsetky blogy na portali" !!}</h2>

       	</div>

	</div>{{-- nadpis --}}

	@foreach($user->posts as $post)

		{{-- ukazka clanku --}}
		<div class="row article-excerpt">
				
			{{-- foto clanku --}}
			<div class="col-lg-4">

				<img src=" {{asset('uploads/blog_photos/'. $post->blog_photo)}}" style="width: 200px; height: 160px; border: 1px solid grey;">
							
			</div>{{-- foto clanku --}}

			{{-- info k clanku --}}
			<div class="col-lg-8">
						
				{{-- nadpis clanku --}}
				<h3 style="margin-top: 0;"><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title }}</a></h3>

				{{-- uryvok --}}
				<p>
					{{ $post->text_teaser }} <br><a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">viac&raquo;</a>
					</p>

				{{-- doplnkove info --}}
				<small> {{ $post->created_at }} | Prečítané: {{ $post->unique_views }}x | Diskusia: 5 komentov</small>

			</div>{{-- info k clanku --}}

   		</div>{{-- ukazka clanku --}}

	@endforeach

@endsection

@section('sidebars')

	<button class="btn btn-info btn-block">Pridaj medzi oblubenych</button><br>
	@include('partials/sidebars/_profileInfo')

@endsection