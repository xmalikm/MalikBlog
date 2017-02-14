@extends('contentWithSidebars')

{{-- title stranky --}}
@section('title', $title)

{{-- kategorie clankov --}}
@section('categories')
	@include('partials/_categories')
@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('category', $category) !!}
@endsection

@section('pageTitle')
<h2 class="title title-marker">{!! $title !!}</h2>
@endsection

@section('content')
	
	{{-- zoznam clankov danej kategorie --}}
	<section>
		@foreach($category->posts as $post)

			{{-- wrapper ukazky clanku --}}
			<article class="post-sample-wrapper">
				{{-- fotka clanku --}}
				<div class="col-sm-4">
					<div class="post-thumbnail">
						<a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}"><img src="{{asset('uploads/blog_photos/'. $post->blog_photo)}}" class="img-responsive"></a>
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
								<span class="post-info">
									<span class="glyphicon glyphicon-user" title="Autor článku"></span>
									<a href="{{ url('user', $post->user->id) }}" title="Autor článku"> {{ $post->user->name}} </a>
								</span>
								<span class="post-info">
									<span class="glyphicon glyphicon-time" title="Vydanie článku"></span>
									<span title="Vydanie článku">{{ $post->created_at }}</span>
								</span>
							</small>
							{{-- ukazka z textu --}}
							<p class="post-sample-text">
								{{ $post->text_teaser }}
							</p>
							{{-- button pre read more --}}
							<a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="btn btn-info btn-xs read-more">Read more</a><br>

							{{-- wrapper pre informacie o clanku --}}
							{{-- info k clanku - pocet videni, komentare, popularita --}}
							<small>
								<span class="post-info" data-toggle="tooltip" title="Počet videní">
									<img src="{{asset('images/icons/views.png')}}"> {{ $post->unique_views }}
								</span>
								<span class="post-info" data-toggle="tooltip" title="Popularita článku">
									<img src="{{asset('images/icons/thumb_up.png')}}"> {{ $post->popularity }}
								</span>
								<span class="post-info" data-toggle="tooltip" title="Počet komentárov">
									<img src="{{asset('images/icons/comments.png')}}"> {{ count($post->comments) }}
								</span>
							</small>
						</div>{{-- wrapper pre informacie o clanku --}}
					</div>
				</div>{{-- telo ukazky --}}
				<div class="clear-content"></div>
			</article>{{-- wrapper ukazky clanku --}}

		@endforeach
	</section>

@endsection

@section('sidebars')

	@include('partials/sideBars/_newAndPopular')

@endsection