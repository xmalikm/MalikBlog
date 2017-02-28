{{-- Zoznam clankov daneho autora --}}

@extends('contentWithSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- kategorie clankov --}}
@section('categories')
	@include('partials/_categories')
@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('showUser', $user) !!}
@endsection

{{-- nadpis stranky --}}
@section('pageTitle')
	<h2 class="title title-marker">{!! $title !!}</h2>
@endsection

{{-- obsah stranky --}}
@section('content')

	<section>
		{{-- zoznam clankov uzivatela --}}
		@foreach($user->posts as $post)

			{{-- wrapper ukazky clanku --}}
			<article class="post-sample-wrapper">
				{{-- fotka clanku --}}
				<div class="col-sm-4">
					<div class="post-thumbnail">
						<a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">
							<img src="{{asset('uploads/blog_photos/'. $post->blog_photo)}}" class="img-responsive">
						</a>
					</div>
				</div>
				{{-- telo ukazky --}}
				<div class="col-sm-8">
					<div class="post-content">
						{{-- wrapper pre informacie o clanku --}}
						<div class="post-sample-info">
							{{-- nazov kategorie --}}
							<a href="{{ url('category', $post->category->id) }}" class="btn btn-warning post-category">{{ $post->category->name }}</a>
							{{-- nadpis clanku --}}
							<h4 class="post-title">
								<a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title_teaser }}</a>
							</h4>
							{{-- meno autora + datum --}}
							<small>
								{{-- autor clanku --}}
								<span class="post-info">
									<span class="glyphicon glyphicon-user" title="Autor článku"></span>
									<a href="{{ url('user', $post->user->id) }}" title="Autor článku"> {{ $post->user->name}} </a>
								</span>
								{{-- datum vydania clanku --}}
								<span class="post-info">
									<span class="glyphicon glyphicon-time" title="Vydanie článku"></span>
									<span title="Vydanie článku">{{ $post->created_at }}</span>
								</span>
							</small>
							{{-- ukazka z textu --}}
							<p class="post-sample-text">
								{{ $post->text_teaser }}
							</p>
							{{-- button pre čátať viac --}}
							<a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="btn btn-default btn-xs read-more">čátať viac</a><br>

							{{-- wrapper pre informacie o clanku --}}
							{{-- info k clanku - pocet videni, komentare, popularita --}}
							<small>
								{{-- pocet videni --}}
								<span class="post-info" data-toggle="tooltip" title="Počet videní">
									<img src="{{asset('images/icons/views.png')}}"> {{ $post->unique_views }}
								</span>
								{{-- popularita --}}
								<span class="post-info" data-toggle="tooltip" title="Popularita článku">
									<img src="{{asset('images/icons/thumb_up.png')}}"> {{ $post->popularity }}
								</span>
								{{-- pocet komentarov --}}
								<span class="post-info" data-toggle="tooltip" title="Počet komentárov">
									<img src="{{asset('images/icons/comments.png')}}"> {{ count($post->comments) }}
								</span>
							</small>
						</div>{{-- wrapper pre informacie o clanku --}}
					</div>
				</div>{{-- telo ukazky --}}

				{{-- vyclearovanie dalsieho obsahu --}}
				<div class="clear-content"></div>
			</article>{{-- wrapper ukazky clanku --}}

		@endforeach
	</section>

@endsection

{{-- sidebary na stranke --}}
@section('sidebars')
	{{-- info o autorovi clanku --}}
	@include('partials/sideBars/_profileInfo')
@endsection