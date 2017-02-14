@extends('contentWithSidebars')

@section('categories')
	@include('partials/_categories')
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('showPost', $post) !!}
@endsection

{{-- obsah stranky --}}
@section('content')
	
	{{-- nadpis --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1><a href=""> {{ $post->title }} </a></h1>
		</div>
	</div>{{-- nadpis --}}

	{{-- info k clanku --}}
   	<div class="row">
   		<div class="col-lg-12 post-info-wrapper">
	   		<span>
				<small>
		   			<img src="{{ asset('uploads/profile_photos/'.$post->user->profile_photo) }}" class="img-circle author-avatar">
					<a href=" {{ url('user', $post->user->id) }} "> {{ $post->user->name}} </a>
				</small>				
			</span>
			<span class="post-info">
				<small>
					<img src="{{asset('images/icons/date.png')}}" style="width: 20px; height: 20px;">
					 <a href="">{{ $post->created_at }}</a>
				 </small>
			</span>
			<a href="{{ url('category', $post->category->id) }}" id="post-category" class="btn btn-lg btn-warning">{{ $post->category->name }}</a>
       	</div>
	</div>{{-- info k clanku --}}

	{{-- foto k clanku --}}
	<div class="row">
		<div class="col-lg-12">
			<img src=" {{asset('uploads/blog_photos/'. $post->blog_photo)}}" class="post-image">
		</div>
	</div>{{-- foto k clanku --}}

	{{-- datum autor citanost--}}
	<div class="row">
		<div class="col-lg-12 col-md-12 post-info-wrapper">
			<small>
				{{-- info k clanku - pocet videni, komentare, popularita --}}
				<span id="post-views" class="post-info" data-toggle="tooltip" title="Počet zobrazení">
					<img src="{{asset('images/icons/views.png')}}"  style="width: 20px; height: 20px;">
					Prečítané {{ $post->unique_views }}x 
				</span>
				<span id="post-popularity" class="post-info" data-toggle="tooltip" title="Popularita článku">
					<img src="{{asset('images/icons/thumb_up.png')}}"  style="width: 20px; height: 20px;">
					Popularita <span>{{ $post->popularity }}</span>
				</span>
				<span id="post-comments" class="post-info" data-toggle="tooltip" title="Počet komentárov">
					<img src="{{asset('images/icons/comments.png')}}"  style="width: 20px; height: 20px;">
					Komentare: <span>{{ count($post->comments) }}</span>
				</span>
			</small>
		</div>
	</div>{{-- datum autor --}}

	{{-- zdielanie na soc. sietach --}}
	<div class="row">
		<div class="col-lg-12 post-likes-list">
			<span class="btn btn-success tooltip-likes" data-toggle = "tooltip" title="
				@foreach($likes as $like_user)
					{{$like_user->name}}<br>
				@endforeach
			">Komu sa paci tento clanok</span>
		</div>
	</div>{{-- zdielanie na soc. sietach --}}

	{{-- clanok --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 post-text">
			<p>
				{!! $post->full_text !!}
			</p>
		</div>
	</div>{{-- clanok --}}

	{{-- like button --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 like-post">
			@if(Auth::user())
				@if($post->isLiked)
					{{-- ak uz uzivatel podporil clanok --}}
					<button class="btn btn-info" id="post-liked-btn"><span class="glyphicon glyphicon-ok"></span> Článok sa mi páči</button>
				@else
					{{-- uzivatel este clanok nepodporil --}}
					<div id="like-post">
						<p><b>Páči sa ti článok? Podpor ho!</b></p>
						<button id="like-post-btn" class="btn btn-info">Páči sa mi</button>
						<img id="ajax_loader" src="{{asset('images/loader.gif')}}" style="display: none;">
					</div>
				@endif
				<div id = 'error-post-msg'></div>
			@endif
		</div>
	</div>{{-- like button --}}

	{{-- uprava clanku, zdielanie na soc. sietach --}}
	<div class="row">
		<div class="col-lg-12 by-post">
			{{-- ak je user vlastnikom clanku, zobraz edit button --}}
			@can('updatePost', $post)
				<a href="{{ route('post.edit', $post->id) }}" id="post-edit" class="btn btn-default">Uprav blog</a>
			@endcan
			<a href="" class="btn btn-primary">Zdielat</a>
			<a href="" class="btn btn-warning">Zdielat</a>
		</div>
	</div>{{-- uprava clanku, zdielanie na soc. sietach --}}
		
	<hr>
	{{-- tagy k clanku --}}
	@include('partials/_tags')

	{{-- diskusia s komentarmi --}}
	@include('partials/_commentSystem')

	<div class="row">
		{{-- viac clankov od autora clanku --}}
		@include('partials/_moreAuthorPosts')
		{{-- viac clankov z kategorie daneho clanku --}}
		@include('partials/_moreCatPosts')
	</div>
	
	{{-- dalsie clanky, ktore mozu citatelov zaujat --}}
	@include('partials/_moreMixPosts')

@endsection

@section('sidebars')

	@include('partials/sidebars/_profileInfo')

@endsection

@section('scripts')

	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});
		// v externom js subore potrebujeme id-cka prihlaseneho uzivatela a zobrazeneho postu
		// tieto premenne treba naplnit v blade subore
		var postId = {{$post->id}},
			userId = {{Auth::id()}},
			thumb_up = '{{asset('images/icons/thumb_up_green.png')}}';
	</script>
	<script src=" {{ asset('js/blog-js/show-post.js') }} "></script>

@endsection