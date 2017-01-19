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

			<small> {{ $post->created_at }} | {{ $post->user->name }} | Prečítané: {{ $post->unique_views }}x | Popularita: <span id="popularity">{{ $post->popularity }}</span> </small>

		</div>

	</div>{{-- datum autor --}}

	<br> {{-- treba nahradit css-kom!!!!!!!!!!!!!!!!!!!!!!!!!!!!! --}}

	{{-- zdielanie na soc. sietach --}}
	<div class="row">

		<div class="col-lg-12 col-md-12">
			<span class="btn btn-success tooltip-likes" data-toggle = "tooltip" title="
				@foreach($likes as $like_user)
					{{$like_user->name}}<br>
				@endforeach
			">Komu sa paci tento clanok</span><br><br>
		</div>
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

			@if(Auth::user())
				<button class="btn btn-info" onclick="likePost()">Článok sa mi páči</button><img id="ajax_loader" src="{{asset('images/loader.gif')}}" style="display: none;">
				<div id = 'msg'></div>
			@endif
			@include('partials/_tags')

		</div>

	</div>{{-- tagy k clanku --}}

@endsection

@section('sidebars')

	@include('partials/sidebars/_profileInfo')

@endsection

@section('scripts')

	<script>
		function likePost(){
            $.ajax({
            	type:'POST',
               	headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  				},
               	url:'/post/like/{{ $post->id }}',
               	data:'_token = <?php echo csrf_token() ?>',
               	success:function(data){
               	   $("#msg").html(data.msg);
               	   $('#popularity').html(data.popularity);
               	   $('#avg_popularity').html(data.avg_popularity);
               	}
            });
         }

        $('.tooltip-likes').tooltip({html: true});

        $(document).on({
		    ajaxStart: function() { $("#ajax_loader").css('display', 'inline'); },
		     ajaxStop: function() { $("#ajax_loader").css('display', 'none'); }    
		});
	</script>

@endsection