{{-- Uvodna stranka aplikacie - zobrazuje slider s ukazkami clankov + zoznami dalsich clankov --}}

@extends('contentWithSidebars')

{{-- css subory --}}
@section('stylesheets')
	{{-- slick kniznica --}}
	<link rel="stylesheet" type="text/css" href="{{asset('css/slick-css/slick.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/slick-css/slick-theme.css')}}"/>
@endsection

{{-- slider s clankami --}}
@section('posts-slider')
		@include('partials/_postsSlider')
@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('home') !!}
@endsection

@section('content')
	
	{{-- clanky z vybranej kategorie --}}
	<section class="posts-by">

		<div class="row">
			{{-- nazov kategorie clankov --}}
			<div class="col-md-12">
				<h3 class="title title-marker">{{ \App\Category::find($catPosts[0]->first()->category_id)->name }}</h3>
			</div>

			{{-- prvy clanok z kategorie - highlight clanok --}}
			<div class="col-md-6">
				<article class="highlight-post">
					{{-- link - obrazok clanku --}}
					<a href="{{ route('post.show', ['id' => $catPosts[0]->first()->id, 'slug' => $catPosts[0]->first()->slug]) }}" class="highlight-post-image" style="background: url({{asset('uploads/blog_photos/'. $catPosts[0]->first()->blog_photo)}}) no-repeat center center;">
						{{-- overlay vrstva, ktora sa zobrazi pri hovernuti obrazku --}}
						<span class="image-overlay"></span>
					</a>
					{{-- informacie k clanku --}}
					<div class="highlight-post-content">
						{{-- kategoria --}}
				    	<a href="{{ url('category', $catPosts[0]->first()->category->id) }}" class="btn btn-warning btn-xs">{{ $catPosts[0]->first()->category->name }}</a>
				    	{{-- nadpis --}}
						<h3>
							<a href="{{ route('post.show', ['id' => $catPosts[0]->first()->id, 'slug' => $catPosts[0]->first()->slug]) }}">
								{{ $catPosts[0]->first()->title }}
							</a>
						</h3>
						{{-- autor + datum --}}
						<small>
							{{-- autor clanku --}}
							<span class="glyphicon glyphicon-user"></span>
							<a href="{{ url('user', $catPosts[0]->first()->user->id) }}">{{ $catPosts[0]->first()->user->name}}</a>
							{{-- datum vydania clanku --}}
							<span class="glyphicon glyphicon-time post-date"></span><span>{{ $catPosts[0]->first()->created_at }}</span>
						</small>
					</div>{{-- informacia k clanku --}}
				</article>
			</div>{{-- prvy clanok z kategorie --}}

			{{-- zoznam zostavajucich dalsich clankov z kategorie - mensie ako highlight clanok --}}
			<div class="col-md-6 post-sample-small-list">
				<ul>
					@foreach($catPosts[0] as $catPost)
						{{-- vynechanie prveho - highlight clanku --}}
						@if(!$loop->index)
							@continue
						@endif
						<li>
							<article class="post-sample-small clear-content">
								{{-- foto clanku --}}
								<div class="post-thumbnail">
									<a href="{{ route('post.show', ['id' => $catPost->id, 'slug' => $catPost->slug]) }}">
										<img src="{{asset('uploads/blog_photos/'. $catPost->blog_photo)}}">
									</a>
								</div>
								{{-- info k clanku --}}
								<div class="post-content">
									{{-- nadpis --}}
									<h5 class="title">
										<a href="{{ route('post.show', ['id' => $catPost->id, 'slug' => $catPost->slug]) }}">{{ $catPost->title_teaser }}</a>
									</h5>
									{{-- autor + datum --}}
									<small>
										{{-- autor clanku --}}
										<span class="glyphicon glyphicon-user"></span>
										<a href="{{ url('user', $catPost->user->id) }}">{{ $catPost->user->name}}</a><br>
										{{-- datum vydania clanku --}}
										<span class="glyphicon glyphicon-time"></span>
										<span>{{ $catPost->created_at }}</span>
									</small>
								</div>{{-- info k clanku --}}
							</article>
						</li>
					@endforeach
				</ul>
			</div>{{-- zoznam zostavajucich dalsich clankov z kategorie --}}
		</div>{{-- row --}}

	</section>{{-- clanky z vybranej kategorie --}}

	{{-- zoznam nedavnych clanky --}}
	<section class="post-sample-list">
		{{-- nazov kategorie clankov --}}
		<h3 class="title title-marker">Nedavne clanky</h3>
		{{-- zoznam clankov --}}
		@foreach($newest as $post)
		
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
							{{-- button pre čítať viac --}}
							<a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="btn btn-default btn-xs čítať viac">čítať viac</a><br>

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
				<div class="clear-content"></div>
		   	</article>{{-- wrapper ukazky clanku --}}

		@endforeach
	</section>


	{{-- clanky z vybranej kategorie --}}
	<section class="posts-by">

		<div class="row">
			{{-- nazov kategorie clankov --}}
			<div class="col-md-12">
				<h3 class="title title-marker">{{ \App\Category::find($catPosts[1]->first()->category_id)->name }}</h3>
			</div>

			{{-- prvy clanok z kategorie - highlight clanok --}}
			<div class="col-md-6">
				<article class="highlight-post">
					{{-- link - obrazok clanku --}}
					<a href="{{ route('post.show', ['id' => $catPosts[1]->first()->id, 'slug' => $catPosts[1]->first()->slug]) }}" class="highlight-post-image" style="background: url({{asset('uploads/blog_photos/'. $catPosts[1]->first()->blog_photo)}}) no-repeat center center;">
						{{-- overlay vrstva, ktora sa zobrazi pri hovernuti obrazku --}}
						<span class="image-overlay"></span>
					</a>
					{{-- informacie k clanku --}}
					<div class="highlight-post-content">
						{{-- kategoria --}}
				    	<a href="{{ url('category', $catPosts[1]->first()->category->id) }}" class="btn btn-warning btn-xs">{{ $catPosts[1]->first()->category->name }}</a>
				    	{{-- nadpis --}}
						<h3>
							<a href="{{ route('post.show', ['id' => $catPosts[1]->first()->id, 'slug' => $catPosts[1]->first()->slug]) }}">
								{{ $catPosts[1]->first()->title }}
							</a>
						</h3>
						{{-- autor + datum --}}
						<small>
							{{-- autor clanku --}}
							<span class="glyphicon glyphicon-user"></span>
							<a href="{{ url('user', $catPosts[1]->first()->user->id) }}">{{ $catPosts[1]->first()->user->name}}</a>
							{{-- datum vydania clanku --}}
							<span class="glyphicon glyphicon-time post-date"></span><span>{{ $catPosts[1]->first()->created_at }}</span>
						</small>
					</div>{{-- informacia k clanku --}}
				</article>
			</div>{{-- prvy clanok z kategorie --}}

			{{-- zoznam zostavajucich dalsich clankov z kategorie - mensie ako highlight clanok --}}
			<div class="col-md-6 post-sample-small-list">
				<ul>
					@foreach($catPosts[1] as $catPost)
						{{-- vynechanie prveho - highlight clanku --}}
						@if(!$loop->index)
							@continue
						@endif
						<li>
							<article class="post-sample-small clear-content">
								{{-- foto clanku --}}
								<div class="post-thumbnail">
									<a href="{{ route('post.show', ['id' => $catPost->id, 'slug' => $catPost->slug]) }}">
										<img src="{{asset('uploads/blog_photos/'. $catPost->blog_photo)}}">
									</a>
								</div>
								{{-- info k clanku --}}
								<div class="post-content">
									{{-- nadpis --}}
									<h5 class="title">
										<a href="{{ route('post.show', ['id' => $catPost->id, 'slug' => $catPost->slug]) }}">{{ $catPost->title_teaser }}</a>
									</h5>
									{{-- autor + datum --}}
									<small>
										{{-- autor clanku --}}
										<span class="glyphicon glyphicon-user"></span>
										<a href="{{ url('user', $catPost->user->id) }}">{{ $catPost->user->name}}</a><br>
										{{-- datum vydania clanku --}}
										<span class="glyphicon glyphicon-time"></span>
										<span>{{ $catPost->created_at }}</span>
									</small>
								</div>{{-- info k clanku --}}
							</article>
						</li>
					@endforeach
				</ul>
			</div>{{-- zoznam zostavajucich dalsich clankov z kategorie --}}
		</div>{{-- row --}}

	</section>{{-- clanky z vybranej kategorie --}}

	{{-- zoznampopularnych clankov --}}
	<section class="post-sample-list">
		{{-- nazov kategorie clankov --}}
		<h3 class="title title-marker">Popularne články</h3>
		{{-- zoznam clankov --}}
		@foreach($popular as $post)
		
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
							{{-- button pre čítať viac --}}
							<a href="{{ route('post.show', ['id' => $post->id, 'slug' => $post->slug]) }}" class="btn btn-default btn-xs čítať viac">čítať viac</a><br>

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
				<div class="clear-content"></div>
		   	</article>{{-- wrapper ukazky clanku --}}

		@endforeach
	</section>

	{{-- clanky z vybranej kategorie --}}
	<section class="posts-by">

		<div class="row">
			{{-- nazov kategorie clankov --}}
			<div class="col-md-12">
				<h3 class="title title-marker">{{ \App\Category::find($catPosts[2]->first()->category_id)->name }}</h3>
			</div>

			{{-- prvy clanok z kategorie - highlight clanok --}}
			<div class="col-md-6">
				<article class="highlight-post">
					{{-- link - obrazok clanku --}}
					<a href="{{ route('post.show', ['id' => $catPosts[2]->first()->id, 'slug' => $catPosts[2]->first()->slug]) }}" class="highlight-post-image" style="background: url({{asset('uploads/blog_photos/'. $catPosts[2]->first()->blog_photo)}}) no-repeat center center;">
						{{-- overlay vrstva, ktora sa zobrazi pri hovernuti obrazku --}}
						<span class="image-overlay"></span>
					</a>
					{{-- informacie k clanku --}}
					<div class="highlight-post-content">
						{{-- kategoria --}}
				    	<a href="{{ url('category', $catPosts[2]->first()->category->id) }}" class="btn btn-warning btn-xs">{{ $catPosts[2]->first()->category->name }}</a>
				    	{{-- nadpis --}}
						<h3>
							<a href="{{ route('post.show', ['id' => $catPosts[2]->first()->id, 'slug' => $catPosts[2]->first()->slug]) }}">
								{{ $catPosts[2]->first()->title }}
							</a>
						</h3>
						{{-- autor + datum --}}
						<small>
							{{-- autor clanku --}}
							<span class="glyphicon glyphicon-user"></span>
							<a href="{{ url('user', $catPosts[2]->first()->user->id) }}">{{ $catPosts[2]->first()->user->name}}</a>
							{{-- datum vydania clanku --}}
							<span class="glyphicon glyphicon-time post-date"></span><span>{{ $catPosts[2]->first()->created_at }}</span>
						</small>
					</div>{{-- informacia k clanku --}}
				</article>
			</div>{{-- prvy clanok z kategorie --}}

			{{-- zoznam zostavajucich dalsich clankov z kategorie - mensie ako highlight clanok --}}
			<div class="col-md-6 post-sample-small-list">
				<ul>
					@foreach($catPosts[2] as $catPost)
						{{-- vynechanie prveho - highlight clanku --}}
						@if(!$loop->index)
							@continue
						@endif
						<li>
							<article class="post-sample-small clear-content">
								{{-- foto clanku --}}
								<div class="post-thumbnail">
									<a href="{{ route('post.show', ['id' => $catPost->id, 'slug' => $catPost->slug]) }}">
										<img src="{{asset('uploads/blog_photos/'. $catPost->blog_photo)}}">
									</a>
								</div>
								{{-- info k clanku --}}
								<div class="post-content">
									{{-- nadpis --}}
									<h5 class="title">
										<a href="{{ route('post.show', ['id' => $catPost->id, 'slug' => $catPost->slug]) }}">{{ $catPost->title_teaser }}</a>
									</h5>
									{{-- autor + datum --}}
									<small>
										{{-- autor clanku --}}
										<span class="glyphicon glyphicon-user"></span>
										<a href="{{ url('user', $catPost->user->id) }}">{{ $catPost->user->name}}</a><br>
										{{-- datum vydania clanku --}}
										<span class="glyphicon glyphicon-time"></span>
										<span>{{ $catPost->created_at }}</span>
									</small>
								</div>{{-- info k clanku --}}
							</article>
						</li>
					@endforeach
				</ul>
			</div>{{-- zoznam zostavajucich dalsich clankov z kategorie --}}
		</div>{{-- row --}}

	</section>{{-- clanky z vybranej kategorie --}}

@endsection

{{-- sidebary na stranke --}}
@section('sidebars')
	{{-- nahodne clanky --}}
	@include('partials/sideBars/_random')

	{{-- zoznam kategorii clankov --}}
	@include('partials/sideBars/_categoriesList')

	{{-- najviac diskutovane clanky --}}
	@include('partials/sideBars/_mostCommented')

	{{-- najnovsie komentare od uzivatelov --}}
	@include('partials/sideBars/_usersComments')	

	{{-- zoznam tagov clankov --}}
	@include('partials/sideBars/_tags')
@endsection

{{-- js subory --}}
@section('scripts')
	{{-- js stranky --}}
	<script src=" {{ asset('js/blog-js/welcome.js') }} "></script>
	{{-- slick kniznica --}}
	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
@endsection