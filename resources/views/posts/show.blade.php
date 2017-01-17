@extends('contentWithSidebars')

@section('categories')
	@include('partials/_categories')
@endsection

@section('breadcrumbs')
	{!! Breadcrumbs::render('showPost', $post) !!}
@endsection

{{-- obsah stranky --}}
@section('content')
	
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
			<img src=" {{asset('uploads/blog_photos/'. $post->blog_photo)}}" style="width: 500; height: 300px; border: 1px solid grey;">

		</div>

	</div>{{-- foto k clanku --}}

	<br> {{-- treba nahradit css-kom!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

	{{-- datum autor citanost--}}
	<div class="row">

		<div class="col-lg-12 col-md-12">

			<small> {{ $post->created_at }} | {{ $post->user->name }} | Prečítané: {{ $post->unique_views }}x | Popularita: {{ $post->popularity }} </small>

		</div>

	</div>{{-- datum autor --}}

	<br> {{-- treba nahradit css-kom!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

	{{-- zdielanie na soc. sietach --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">
			{{-- ak je user vlastnikom clanku, zobraz edit button --}}
			@can('updatePost', $post)
				<a href="{{ route('post.edit', $post->id) }}" class="btn btn-default">Uprav blog</a>
			@endcan
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

			<a href=" {{ url('post/like', $post->id) }} " class="btn btn-info">Článok sa mi páči</a>
			{{$post->isLiked}}
			
			@include('partials/_tags')

		</div>

	</div>{{-- tagy k clanku --}}

@endsection

@section('sidebars')

	@include('partials/sidebars/_profileInfo')

@endsection