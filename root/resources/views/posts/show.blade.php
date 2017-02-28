{{-- stranka clanku --}}

@extends('contentWithSidebars')

{{-- css subory stranky --}}
@section('stylesheets')
	{{-- js validacia formularu --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/parsley.css')}}">
    {{-- css pre login formular pri komentaroch --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/login-style.css')}}">
    {{-- kniznica na tooltip --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('tooltipster/css/tooltipster.bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('tooltipster/css/plugins/tooltipster-sideTip-borderless.min.css') }}" />
    {{-- ikony --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
@endsection

{{-- sekcia pre kategorie clankov --}}
@section('categories')
	@include('partials/_categories')
@endsection

{{-- breadcrumbs --}}
@section('breadcrumbs')
	{!! Breadcrumbs::render('showPost', $post) !!}
@endsection

{{-- obsah stranky --}}
@section('content')
	
	{{-- nadpis clanku --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 text-center post-title">
			<h1><a href=""> {{ $post->title }} </a></h1>
		</div>
	</div>

	{{-- info k clanku --}}
   	<div class="row">
   		<div class="col-lg-12 post-info-wrapper">
	   		<span>
	   			{{-- autor clanku --}}
				<small title="Autor článku">
		   			<img src="{{ asset('uploads/profile_photos/'.$post->user->profile_photo) }}" class="img-circle author-avatar" alt="{{ $post->user->name}}">
					<a href=" {{ url('user', $post->user->id) }} "> {{ $post->user->name}} </a>
				</small>				
			</span>
			{{-- datum vydania clanku --}}
			<span class="post-info">
				<small title="Dátum vydania článku">
					<img src="{{ asset('images/icons/date.png') }}" class="" alt="Dátum vydania článku">
					 <a href="">{{ $post->created_at }}</a>
				 </small>
			</span>
			{{-- kategoria clanku --}}
			<a href="{{ url('category', $post->category->id) }}" id="post-category" class="btn btn-lg btn-warning">{{ $post->category->name }}</a>
       	</div>
	</div>{{-- info k clanku --}}

	{{-- foto k clanku --}}
	<div class="row">
		<div class="col-lg-12">
			<img src=" {{asset('uploads/blog_photos/'. $post->blog_photo)}}" class="post-image" title="{{ $post->title }}" alt="{{ $post->title }}">
		</div>
	</div>{{-- foto k clanku --}}

	{{-- dalsie doplnkove info k clanku: citanost, popularita a pocet komentarov--}}
	<div class="row">
		<div class="col-lg-12 col-md-12 post-info-wrapper">
			<small>
				{{-- pocet videni --}}
				<span id="post-views" class="post-info" data-toggle="tooltip" title="Počet zobrazení">
					<img src="{{asset('images/icons/views.png')}}"  style="width: 20px; height: 20px;">
					Prečítané {{ $post->unique_views }}x 
				</span>
				{{-- popularita --}}
				<span id="post-popularity" class="post-info" data-toggle="tooltip" title="Popularita článku">
					<img src="{{asset('images/icons/thumb_up.png')}}"  style="width: 20px; height: 20px;">
					Popularita <span>{{ $post->popularity }}</span>
				</span>
				{{-- pocet komentarov --}}
				<span class="post-comments" class="post-info" data-toggle="tooltip" title="Počet komentárov">
					<img src="{{asset('images/icons/comments.png')}}"  style="width: 20px; height: 20px;">
					Komentare: <span>{{ count($post->comments) }}</span>
				</span>
			</small>
		</div>
	</div>{{-- dalsie doplnkove info k clanku: citanost, popularita a pocet komentarov--}}

	{{-- span - na hover zobrazuje uzivatelov, ktorym sa paci tento clanok --}}
	<div class="row">
		<div class="col-lg-12 post-likes-list">
			<span class="btn btn-success tooltipster" data-tooltip-content="#tooltip_content">
				Komu sa paci tento clanok
			</span>
		</div>
	</div>{{-- span - na hover zobrazuje uzivatelov, ktorym sa paci tento clanok --}}

	{{-- zozonam uzivatelov, ktorym sa paci tento clanok --}}
	<div class="tooltip_templates" style="display: none;">
	    <span id="tooltip_content">
	        @foreach($likes as $like_user)
				{!!$like_user->name!!}<br>
			@endforeach
	    </span>
	</div>{{-- zozonam uzivatelov, ktorym sa paci tento clanok --}}

	{{-- samotny clanok --}}
	<div class="row">
		<div class="col-lg-12 col-md-12 post-text">
			<p>
				{!! $post->full_text !!}
			</p>
		</div>
	</div>{{-- samotny clanok --}}

	{{-- like button clanku --}}
	{{-- zobrazi sa iba ak je uzivatel prihlaseny --}}
	@if(Auth::user())
		{{-- row --}}
		<div class="row">
			{{-- column --}}
			<div class="col-lg-12 col-md-12 like-post">
					{{-- ak uz uzivatel podporil clanok --}}
					@if($post->isLiked)
						<button class="btn btn-info" id="post-liked-btn"><span class="glyphicon glyphicon-ok"></span> Článok sa mi páči</button>
					{{-- uzivatel este clanok nepodporil --}}
					@else
						<div id="like-post">
							<p><b>Páči sa ti článok? Podpor ho!</b></p>
							<button id="like-post-btn" class="btn btn-info">Páči sa mi</button>
							<img id="ajax_loader" src="{{asset('images/loader.gif')}}" alt="loading animation" style="display: none;">
						</div>
					@endif
					{{-- error message --}}
					<div id = 'error-post-msg'></div>
			</div>{{-- column --}}
		</div>{{-- row --}}
	@endif

	{{-- uprava clanku, zdielanie na soc. sietach --}}
	<div class="row">
		<div class="col-lg-12 by-post">
			{{-- ak je user vlastnikom clanku, zobrazi sa edit button --}}
			@can('updatePost', $post)
				<a href="{{ route('post.edit', $post->id) }}" id="post-edit" class="btn btn-default">Uprav blog</a>
			@endcan
			{{-- socialne siete --}}
			<a href="" class="btn btn-primary">Zdielat</a>
			<a href="" class="btn btn-warning">Zdielat</a>
		</div>
	</div>{{-- uprava clanku, zdielanie na soc. sietach --}}
		
	<hr>
	{{-- tagy k clanku --}}
	@include('partials/_tags')
	<hr>
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

{{-- cast pre sidebary --}}
@section('sidebars')
	{{-- profil autora clanku --}}
	@include('partials/sideBars/_profileInfo')
@endsection

{{-- js subory a skripty --}}
@section('scripts')
	<script>
		$(document).ready(function(){
			// inicializacia tooltip
		    $('[data-toggle="tooltip"]').tooltip(); 
		});
		// v externom js subore potrebujeme id-cka prihlaseneho uzivatela a zobrazeneho postu
		// tieto premenne treba naplnit v blade subore
			// id clanku
		var postId = {{$post->id}},
			// id uzivatela
			userId = {{Auth::id()}},
			// thumb up image
			thumb_up = '{{asset('images/icons/thumb_up_green.png')}}';
	</script>
	{{-- js stranky --}}
	<script src=" {{ asset('js/blog-js/show-post.js') }} "></script>
	{{-- kniznica pre tooltip --}}
	<script type="text/javascript" src="{{ asset('tooltipster/js/tooltipster.bundle.min.js')}}"></script>
@endsection